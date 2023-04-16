<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\Product;
use App\Discount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function addToCart(Request $request){
       $cart =  $request->all();
    //    echo "<pre>";
    //    print_r($cart);die;
        $session_id = Session::get('session_id');
        if (empty($session_id)) {
            $session_id = Session::getId();
            Session::put('session_id', $session_id);
        }

        if($cart['product_quantity'] > 5){
            return back()->with('error_msg', 'Please Contact with Us If Product Quantity is more than 5 !!');
        }else{
            if(Cart::where('session_id', Session::get('session_id'))->where('product_id', $cart['product_id'])->exists()){
                Cart::where('session_id', Session::get('session_id'))->where('product_id', $cart['product_id'])->increment('product_quantity', $cart['product_quantity']);
                $product_name = Product::where('id', $cart['product_id'])->value('product_name');
                return back()->with('success', $product_name);
            }else{
                //Save Product in Cart
                if(!empty($cart['emi'])){
                    Cart::create([
                        'product_id' => $cart['product_id'],
                        'category_id' => $cart['category_id'],
                        'product_quantity' => $cart['product_quantity'],
                        'session_id' => Session::get('session_id'),
                        'emi' => $cart['emi'],
                        'created_at' => Carbon::now()->toDateString(),
                    ]);
                    $product_name = Product::where('id', $cart['product_id'])->value('product_name');
                    return back()->with('success', $product_name);
                }else{
                    Cart::create([
                        'product_id' => $cart['product_id'],
                        'category_id' => $cart['category_id'],
                        'product_quantity' => $cart['product_quantity'],
                        'session_id' => Session::get('session_id'),
                        'created_at' => Carbon::now()->toDateString(),
                    ]);
                    $product_name = Product::where('id', $cart['product_id'])->value('product_name');
                    return back()->with('success', $product_name);
                }

            }

        }

    }

    public function viewCart($coupon_name="")
    {
       $all_cart_product = Cart::all();
       foreach($all_cart_product as $all){
            $all::where('created_at', '!=', Carbon::now()->toDateString())->delete();
       }

        if($coupon_name){
            if (Discount::where('coupon', $coupon_name)->exists()) {
                if (Discount::where('coupon', $coupon_name)->first()->end_date >= Carbon::now()->format('Y-m-d')) {
                    //check if $coupon_name is on total or product
                    if (Discount::where('coupon', $coupon_name)->value('type') == "total") {
                        $emi_product = 0;
                        foreach (cart_all_product() as $item) {
                            if ($item->emi != null) {
                                $emi_product++;
                            }
                        }
                        if ($emi_product == 0) {
                            $coupon_percentage = Discount::where('coupon', $coupon_name)->value('percentage');

                            //check if $coupon_percentage has null percentage value
                            if ($coupon_percentage == Null) {
                                $discount_max_amount = Discount::where('coupon', $coupon_name)->value('max_amount'); // max reduced amount 60 TK
                                $discount_by_total = cart_subtotal() - $discount_max_amount; // if cartSubtotal() 100 tk, then discount_by_total = 100-60 = 40TK

                                return view('Frontend.layouts.cart.view_cart', compact('discount_by_total', 'discount_max_amount', 'coupon_name'));
                            } else {
                                $discount_percentage = Discount::where('coupon', $coupon_name)->value('percentage'); //discount = 10%
                                $discount_max_amount = Discount::where('coupon', $coupon_name)->value('max_amount'); // discount_max_amount 60 TK
                                $discount_by_total = cart_subtotal() - (($discount_percentage / 100) * cart_subtotal()); // if cartSubtotal() 1000 tk, then discount_by_total = 1000 - 10% = 900TK
                                $total_percentage_amount = ($discount_percentage / 100) * cart_subtotal(); //Discount total_percentage_amount = 100TK

                                //check if product total percentage amount exceeds max discount amount or not
                                if ($total_percentage_amount > $discount_max_amount) {
                                    $subtract_amount = $total_percentage_amount - $discount_max_amount; //subtract_amount will reduce more of the discount_max_amount => 100-60 = 40TK
                                    $discount_by_total = $discount_by_total + $subtract_amount; //final total price = 900+40 = 940TK with 10% discount max 60TK

                                    return view('Frontend.layouts.cart.view_cart', compact('discount_by_total', 'discount_percentage', 'coupon_name'));
                                } else {

                                    return view('Frontend.layouts.cart.view_cart', compact('discount_by_total', 'discount_percentage', 'coupon_name'));
                                }
                            }
                        }else{
                            return back()->with("error", "Coupon is invalid for EMI product");
                        }

                    }
                    elseif(Discount::where('coupon', $coupon_name)->value('type') == "product type"){
                        $discount_product_id = Discount::where('coupon', $coupon_name)->value('product_id'); //get the id of discounted product from discount table
                        foreach (cart_all_product() as $item) {
                            //checks if discounted product matches with the cart products or not
                            if(Cart::where('product_id', $discount_product_id)->value('emi') == null){
                                if ($discount_product_id == $item->product_id) {
                                    $coupon_percentage = Discount::where('coupon', $coupon_name)->value('percentage');

                                    //check if $coupon_percentage has null percentage value or not
                                    if ($coupon_percentage == Null) {
                                        $product_quantity = Cart::where('product_id', $item->product_id)->value('product_quantity');    // 10 pieces
                                        $product_rate = Product::where('id', $item->product_id)->value('price');                 // 20 TK
                                        $discount_max_amount = Discount::where('coupon', $coupon_name)->value('max_amount');      // 50 TK
                                        $discount_percentage = Discount::where('coupon', $coupon_name)->value('percentage');      // Error resolution
                                        $product_id = $item->product_id;                                                        // id cross matching
                                        $total = ($product_quantity * $product_rate) - $discount_max_amount;                    // $total = (10 * 20) - 50 = 150 TK
                                        return view('Frontend.layouts.cart.view_cart', compact('total', 'product_id', 'discount_max_amount', 'coupon_name'));
                                    }

                                    //now $coupon_percentage has value
                                    else {
                                        $product_quantity = Cart::where('product_id', $item->product_id)->value('product_quantity');    // 10 pieces
                                        $product_rate = Product::where('id', $item->product_id)->value('price');                 // 200 Tk
                                        $discount_max_amount = Discount::where('coupon', $coupon_name)->value('max_amount');      // 100 TK
                                        $discount_percentage = Discount::where('coupon', $coupon_name)->value('percentage');      // 10%
                                        $product_id = $item->product_id;                                                        // id cross matching

                                        //$total = (10 * 200) - ((10/100) * (10 * 200)) = 1800
                                        $total = ($product_quantity * $product_rate) - (($discount_percentage / 100) * ($product_quantity * $product_rate));

                                        //$product_percentage_amount = (10/100) * (10 * 200) = 200
                                        $product_percentage_amount = ($discount_percentage / 100) * ($product_quantity * $product_rate);

                                        //check if total percentage amount exceeds max discount amount or not, here it exceeds
                                        if ($product_percentage_amount > $discount_max_amount) {
                                            $subtract_amount = $product_percentage_amount - $discount_max_amount;           // $subtract_amount = 200 - 100 = 100TK
                                            $total = $total + $subtract_amount;
                                            // $total = 1800 + 100 = 1900TK

                                            return view('Frontend.layouts.cart.view_cart', compact('total', 'product_id', 'discount_percentage', 'coupon_name'));
                                        } else {

                                            return view('Frontend.layouts.cart.view_cart', compact('total', 'product_id', 'discount_percentage', 'coupon_name'));
                                        }
                                    }
                                }
                            }else{
                                return back()->with('error', 'This Coupon is not valid for EMI Product');
                            }

                        }
                        if (empty($total)) {
                            return back()->with('error', 'This Coupon is not availabel in these product');
                        }
                    }
                    //category coupon end
                } else {
                    return back()->with("error", "Coupon Date is Over");
                }
            } else {
                return back()->with("error", "Invalid coupon");;
            }
        }else{
            $count = count(cart_all_product());
            if ($count > 0) {
                return view('Frontend.layouts.cart.view_cart');
            } else {
                return redirect('/cart/item/empty');
            }
        }




    }

    public function updateCartItem(Request $request){
        foreach($request->cart_id as $key=>$id){
            Cart::find($id)->update([
                'product_quantity'=>$request->product_quantity[$key]
            ]);
        }
        return back();
    }


    public function deleteCartItem($id){

        Cart::find($id)->delete();
        return back()->with('success', 'Cart item deleted successfully !!');
    }

    public function emptyCart(){
        return view('Frontend.layouts.cart.empty_cart');
    }


}
