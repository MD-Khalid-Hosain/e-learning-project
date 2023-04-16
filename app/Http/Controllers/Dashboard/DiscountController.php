<?php

namespace App\Http\Controllers\Dashboard;

use App\Product;
use App\Section;
use App\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponValidation;

class DiscountController extends Controller
{
    public function discountDetails(){
        //Section with Categories and SubCategories
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories), true);
        $allProducts = Product::get();
        $allCoupons = Discount::get();
        return view('backend.layouts.discount.discount', compact('categories', 'allProducts', 'allCoupons'));
    }


    public function couponCreate(CouponValidation $request){

        if($request->type == 'total'){
            Discount::create([
                'coupon' => strtoupper($request->coupon),
                'type'=> $request->type,
                'percentage'=> $request->percentage,
                'max_amount'=> $request->max_amount,
                'start_date'=> $request->start_date,
                'end_date'=> $request->end_date,
                'city'=> $request->city,
                'status'=> 1,

            ]);
            return back()->with('success', 'Coupon Created Successfully !!');
        }else if($request->type == 'product type'){
            Discount::create([
                'coupon' => strtoupper($request->coupon),
                'type' => $request->type,
                'percentage' => $request->percentage,
                'max_amount' => $request->max_amount,
                'product_id' => $request->product_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'city' => $request->city,
                'status' => 1,

            ]);
            return back()->with('success', 'Coupon Created Successfully !!');
        }else{
            Discount::create([
                'coupon' => strtoupper($request->coupon),
                'type' => $request->type,
                'percentage' => $request->percentage,
                'max_amount' => $request->max_amount,
                'category_id' => $request->category_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'city' => $request->city,
                'status' => 1,

            ]);

            return back()->with('success', 'Coupon Created Successfully !!');
        }
    }

    public function editCoupon($id){
        $discounts = Discount::find($id);
        //Section with Categories and SubCategories
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories), true);
        $allProducts = Product::get();

        return view('backend.layouts.discount.edit_discount', compact('categories', 'allProducts','discounts'));
    }

    public function updateCoupon(Request $request){
        $discount = Discount::find($request->discount_id);
        if ($request->type == 'total') {
            $discount->coupon = strtoupper($request->coupon);
            $discount->type = $request->type;
            $discount->percentage = $request->percentage;
            $discount->max_amount = $request->max_amount;
            $discount->start_date = $request->start_date;
            $discount->end_date = $request->end_date;
            $discount->city = $request->city;
            $discount->save();
            return back()->with('success', 'Coupon Updated Successfully !!');
        } else if ($request->type == 'product_type') {
            $discount->coupon = strtoupper($request->coupon);
            $discount->type = $request->type;
            $discount->percentage = $request->percentage;
            $discount->max_amount = $request->max_amount;
            $discount->product_id = $request->product_id;
            $discount->start_date = $request->start_date;
            $discount->end_date = $request->end_date;
            $discount->city = $request->city;
            $discount->save();
            return back()->with('success', 'Coupon Updated Successfully !!');

        } else {

            $discount->coupon = strtoupper($request->coupon);
            $discount->type = $request->type;
            $discount->percentage = $request->percentage;
            $discount->max_amount = $request->max_amount;
            $discount->category_id = $request->category_id;
            $discount->start_date = $request->start_date;
            $discount->end_date = $request->end_date;
            $discount->city = $request->city;
            $discount->save();
            return back()->with('success', 'Coupon Updated Successfully !!');
        }
    }


    public function couponDelete($id){
        Discount::find($id)->delete();
        return back()->with('deletesuccess', 'Coupon Deleted Successfully !!');
    }
}
