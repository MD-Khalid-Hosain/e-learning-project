<?php

namespace App\Http\Controllers\Dashboard;

use App\Order;
use App\Discount;
use App\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;

class OrderController extends Controller
{
    public function onlinePayment(){
        $allOrders = Order::where('status', 'Processing')->where('payment_method', 1)->get();
        return view('backend.layouts.order.onliePaymentOrderList', compact('allOrders'));
    }

    public function cashOnDelivery(){
        $allOrders = Order::where('status', 'Processing')->where('payment_method', 2)->get();
        return view('backend.layouts.order.offlinePaymentOrderList', compact('allOrders'));
    }

    public function confirmdOrder()
    {
        $allOrders = Order::where('status', 'Confirmed')->get();
        return view('backend.layouts.order.confirmdOrderList', compact('allOrders'));
    }

    public function cacelledOrder(){
        $allOrders = Order::where('status', 'Cancelled')->get();
        return view('backend.layouts.order.cancelledOrderList', compact('allOrders'));
    }
    public function deliveredOrder(){
        $allOrders = Order::where('status', 'Delivered')->get();
        return view('backend.layouts.order.deliveredOrderList', compact('allOrders'));
    }

    public function viewOrderDetails($id){
        $order = Order::find($id);
        $coupon_name = Discount::where('coupon', $order->discount_code)->first();
        $order_details = OrderDetail::where('order_id', $id)->get();
        return view('backend.layouts.order.viewOrder', compact('order', 'order_details', 'coupon_name'));
    }
    public function onlineEditOrder($id){
        $order = Order::find($id);
        $coupon_name = Discount::where('coupon', $order->discount_code)->first();
        $order_details = OrderDetail::where('order_id', $id)->get();

        return view('backend.layouts.order.onlineEditOrder', compact('order', 'order_details', 'coupon_name'));
    }
    public function editConfirmedOrder($id){
        $order = Order::find($id);
        $coupon_name = Discount::where('coupon', $order->discount_code)->first();
        $order_details = OrderDetail::where('order_id', $id)->get();

        return view('backend.layouts.order.editConfirmedOrder', compact('order', 'order_details', 'coupon_name'));
    }

    public function orderUpdate(Request $request){
        $request->validate([
            'status'=> 'required',
        ]);
        $order = Order::find($request->order_id);
        $order->status= $request->status;
        $order->cancel_note = $request->cancel_note;
        $order->save();

        $Order_mobile = Order::where('id', $request->order_id)->value('phone');
        $Order_no = Order::where('id', $request->order_id)->value('transaction_id');
        $status = Order::where('id', $request->order_id)->value('status');
        $url = "http://66.45.237.70/api.php";
        $number = $Order_mobile;
        $text = "Your Order Status Updated. \nOrder No# " . $Order_no . "\nOrder Status: " . $status . "\nHotline+8801739438877";
        $data = array(
            'username' => "oslbd",
            'password' => "GKXMYQ7P",
            'number' => "$number",
            'message' => "$text"
        );

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|", $smsresult);
        $sendstatus = $p[0];

        return back()->with('success', 'Order Confirmed');
    }
    public function confirmedOrderUpdate(Request $request){
        $request->validate([
            'status'=> 'required',
        ]);
        $order = Order::find($request->order_id);
        $order->status= $request->status;
        $order->cancel_note = $request->cancel_note;
        $order->save();

        $Order_mobile = Order::where('id', $request->order_id)->value('phone');
        $Order_no = Order::where('id', $request->order_id)->value('transaction_id');
        $status = Order::where('id', $request->order_id)->value('status');
        $url = "http://66.45.237.70/api.php";
        $number = $Order_mobile;
        $text = "Your Order Status Updated. \nOrder No# " . $Order_no . "\nOrder Status: " . $status . "\nHotline+8801739438877";
        $data = array(
            'username' => "oslbd",
            'password' => "GKXMYQ7P",
            'number' => "$number",
            'message' => "$text"
        );

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|", $smsresult);
        $sendstatus = $p[0];


        return back()->with('success', 'Order Delivered');
    }

    public function pdfDownload($oredr_id)
    {
        $order_no = Order::findOrFail($oredr_id);
        $coupon_name = Discount::where('coupon', $order_no->discount_code)->first();

        $order_details = OrderDetail::where('order_id', $oredr_id)->get();

        $order_pdf = PDF::loadView('Frontend.layouts.customer.invoicePdf', compact('order_details', 'order_no', 'coupon_name'))->setPaper('a4', 'portrait');;

        return $order_pdf->download('myInvoice.pdf');
    }




}
