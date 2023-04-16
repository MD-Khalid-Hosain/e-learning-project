<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

function total_cart_product(){

        return App\Cart::where('session_id', Session::get('session_id'))->count();
}
function cart_all_product()
{

    return App\Cart::where('session_id', Session::get('session_id'))->get();
}

function total_product(){
    return App\Product::all()->count();
}
function today_total_product(){
    return App\Product::whereDate('created_at', Carbon::today())->count();
}

function cart_subtotal()
{
    $total_price = 0;
    foreach (cart_all_product() as $cart_product) {
        if($cart_product->emi != null){

            $total_price = $total_price + ($cart_product->product_quantity * App\Product::find($cart_product->product_id)->regular_price);
        }else{
            $total_price = $total_price + ($cart_product->product_quantity * App\Product::find($cart_product->product_id)->price);
        }
    }
    return $total_price;
}
function question_acomment_count(){
    $questions = App\UserQuestion::where('answer', null)->count();
    $review = App\Review::where('status', 0)->count();
    return $questions + $review;
}

//compare
function compareCount()
{
    return App\Compare::all()->count();
}

// scroll function
 function scrollStatus(){

    if(App\Scroll::where('day', Carbon::now()->format('l'))->value('status') ==1){
        return App\Scroll::where('day', Carbon::now()->format('l'))->value('scroll_status');
    }else{
        return App\Scroll::where('day', null)->where('status', 1)->value('scroll_status');
    }


}

//total earn money

function totalEarning(){
    $allDelivered = App\Order::where('status', 'Delivered')->get();
    $total = 0;
    foreach($allDelivered as $order){
        $total = $total + $order->amount;
    }

    return $total;
}

//this month earn money
function thisMonthEarning(){
    $allDelivered = App\Order::where('status', 'Delivered')->whereMonth('updated_at', Carbon::now()->month)->get();
    $total = 0;
    foreach($allDelivered as $order){
        $total = $total + $order->amount;
    }

    return $total;
}

//all Category list
function allCategory(){
    $allCategory = App\CourseCategory::get();
    return $allCategory;
}
//course count
function allCourse(){
    $coursesCount = App\Course::get()->count();
    return $coursesCount;
}

