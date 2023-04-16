<?php

namespace App\Http\Controllers\Frontend;

use App\Order;
use App\Review;
use App\Discount;
use App\EcomUser;
use App\OrderDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\UserQuestion;

class CustomerController extends Controller
{
    public function myAccount(){
        return view('Frontend.layouts.customer.myaccount');
    }

    public function invoice($oredr_id){
        $order_no = Order::findOrFail($oredr_id);
        $coupon_name = Discount::where('coupon',$order_no->discount_code)->first();

        $order_details = OrderDetail::where('order_id',$oredr_id)->where('user_id', Auth::guard('ecomUser')->user()->id)->get();
        return view('Frontend.layouts.customer.invoice',compact('order_details','order_no', 'coupon_name'));
    }

    public function pdfDownload($oredr_id){
        $order_no = Order::findOrFail($oredr_id);
        $coupon_name = Discount::where('coupon', $order_no->discount_code)->first();

        $order_details = OrderDetail::where('order_id', $oredr_id)->where('user_id', Auth::guard('ecomUser')->user()->id)->get();

        $order_pdf = PDF::loadView('Frontend.layouts.customer.invoicePdf', compact('order_details', 'order_no', 'coupon_name'))->setPaper('a4', 'portrait');;

        return $order_pdf->download('myInvoice.pdf');

    }
    public function orderHistory(){
        $allOrders = Order::where('user_id', Auth::guard('ecomUser')->user()->id)->where('status', '!=','Cancelled')->orderBy('id', 'DESC')->get();
        // print_r($allOrders); die;
        return view('Frontend.layouts.customer.order_history', compact('allOrders'));
    }
    public function cancelldeOrder(){
        $allCancelledOrders = Order::where('user_id', Auth::guard('ecomUser')->user()->id)->where('status', 'Cancelled')->orderBy('id', 'DESC')->get();
        // print_r($allOrders); die;
        return view('Frontend.layouts.customer.cancelled', compact('allCancelledOrders'));
    }
    public function transectionHistory(){
        $allOrders = Order::where('user_id', Auth::guard('ecomUser')->user()->id)->where('status', 'Delivered')->orderBy('id', 'DESC')->get();
        // print_r($allOrders); die;
        return view('Frontend.layouts.customer.transectionHistory', compact('allOrders'));
    }

    public function orderDetails(){
        return view('Frontend.layouts.customer.thankYou');
    }

    public function ecomUserDetails(){
        return view('Frontend.layouts.customer.userDetails');
    }

    public function changePassword(){
        return view('Frontend.layouts.customer.change_password');
    }
    /*==========Current password is checking =========*/
    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        $hashPwd = Auth::guard('ecomUser')->user()->password;
        if (Hash::check($data['current_pwd'], $hashPwd)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    /*==========Update Admin Password =========*/
    public function updateCurrentPwd(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $hashPwd = Auth::guard('ecomUser')->user()->password;
            //if current password is currect
            if (Hash::check($data['current_pwd'], $hashPwd)) {
                //if new and confirm password is matching
                if ($data['new_pwd'] == $data['confirm_pwd']) {
                    EcomUser::where('id', Auth::guard('ecomUser')->user()->id)->update(['password' => bcrypt($data['new_pwd'])]);
                    Session::flash('success', 'Your password has been changed successfully !!');
                } else {
                    return redirect()->back()->with('error_message', 'New Password and Confirm Password not Match');
                }
            } else {
                return redirect()->back()->with('error_message', 'Your Current Password is Incorrect');
            }
            return redirect()->back();
        }
    }

    public function orderStatus()
    {
        return view('Frontend.layouts.customer.thankYou');
    }

    public function unsuccessStatus(){
        return view('Frontend.layouts.customer.sorry');
    }

    public function reviewCreate(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'comment'=>'required',
            'rating'=>'required',
        ]);
        Review::create([
            'name' => $request->name,
            'product_id' => $request->product_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'status' => 0,
        ]);
        return back()->with('review_success', 'Thnak you for your feedback !!');
    }


    //User Question start
    public function questionCreate(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all()); die;

        $request->validate([
            'customer_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'customer_number' => 'required|numeric|digits:11',
            'question' => 'required',
        ]);
        UserQuestion::create([
            'customer_name'     => $request->customer_name,
            'customer_number'   => $request->customer_number,
            'product_id'        => $request->product_id,
            'question'        => $request->question,
        ]);

        return back()->with('review_success', 'Thank you for your question. You will get answer by sms very soon');
    }
}
