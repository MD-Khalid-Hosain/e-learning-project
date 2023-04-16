<?php

namespace App\Http\Controllers;

use App\Cart;
use App\ExamEvent;
use App\Order;
use App\Product;
use App\Discount;
use Carbon\Carbon;
use App\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Requests\Checkout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Library\SslCommerz\SslCommerzNotification;

class SslCommerzPaymentController extends Controller
{


    public function exampleHostedCheckout(Request $request)
    {
        $examDetails = ExamEvent::find($request->exam_id);
        return view('Frontend.layouts.checkout.exampleHosted', compact('examDetails'));

    }



    public function index(Request $request)
    {
//        print_r($request->all()); die;

             # Here you have to receive all the order data to initate the payment.
            # Let's say, your oder transaction informations are saving in a table called "orders"
            # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

            $post_data = array();
            $post_data['total_amount'] = $request->amount; # You cant not pay less than 10
            $post_data['currency'] = "BDT";




            # CUSTOMER INFORMATION
            $post_data['cus_name'] = $request->full_name;
            $post_data['cus_email'] = $request->email;
            $post_data['cus_add1'] = "aaa";
            $post_data['cus_add2'] = "aa";
            $post_data['cus_city'] = $request->city;
            $post_data['cus_postcode'] = "dddd";
            $post_data['cus_country'] = "Bangladesh";
            $post_data['cus_phone'] = $request->number;
            $post_data['cus_fax'] = "";
            $post_data['cus_state'] = "";
            $post_data['coupon'] = "";
            $post_data['payment_method'] = "";

            # SHIPMENT INFORMATION
            $post_data['ship_name'] = "Store Test";
            $post_data['ship_add1'] = "Dhaka";
            $post_data['ship_add2'] = "Dhaka";
            $post_data['ship_city'] = "Dhaka";
            $post_data['ship_state'] = "Dhaka";
            $post_data['ship_postcode'] = "1000";
            $post_data['ship_phone'] = "";
            $post_data['ship_country'] = "Bangladesh";

            $post_data['shipping_method'] = "NO";
            $post_data['product_name'] = "Computer";
            $post_data['product_category'] = "Goods";
            $post_data['product_profile'] = "physical-goods";

            # OPTIONAL PARAMETERS
            $post_data['value_a'] = "ref001";
            $post_data['value_b'] = "ref002";
            $post_data['value_c'] = "ref003";
            $post_data['value_d'] = "ref004";

            #Before  going to initiate the payment order status need to insert or update as Pending.
            $update_product = DB::table('orders')
                ->insertGetId([
                    'user_id' => Auth::guard('student')->user()->id,
                    'name' => $post_data['cus_name'],
                    'email' => $post_data['cus_email'],
                    'phone' => $post_data['cus_phone'],
                    'amount' => $post_data['total_amount'],
                    'status' => 'Pending',
                    'billing_address' => $post_data['cus_add1'],
                    'delivery_address' => $post_data['cus_add2'],
                    'city' => $post_data['cus_city'],
                    'post_code' => $post_data['cus_postcode'],
                    'country' => $post_data['cus_country'],
                    'transaction_id' => 123,
                    'currency' => $post_data['currency'],
                    'created_at' => Carbon::now(),
                    'discount_code' => $post_data['coupon'],
                    'payment_method' => $post_data['payment_method'],
                    'privacy_policy' => 'yes',
                    'terms_and_conditions' => 'yes',
                    'year' => Carbon::now()->translatedFormat('Y'),
                    'month' => Carbon::now()->translatedFormat('F'),

                ]);
//                foreach (cart_all_product() as $cart_product) {
//
//                    OrderDetail::insert([
//                        'user_id' => Auth::guard('student')->user()->id,
//                        'order_id' => $update_product,
//                        'product_id' => $cart_product->product_id,
//                        'quantity' => $cart_product->product_quantity,
//                        'price' => Product::where('id', $cart_product->product_id)->value('price'),
//                        'created_at' => Carbon::now()
//                    ]);
//                    //insert in order_list table end
//
//                    //delete from cart table
//                    Cart::find($cart_product->id)->delete();
//                }
//
//                $order = Order::find($update_product);
//                $order_details = OrderDetail::where('order_id', $order->id)->get();

                // Mail::to(auth()->user()->email)->send(new OrderMail($order, $order_details));

            $sslc = new SslCommerzNotification();
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
            $payment_options = $sslc->makePayment($post_data, 'hosted');

            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            }

    }


    public function success(Request $request)
    {
        // echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');



        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                $Order_mobile = Order::where('transaction_id', $tran_id)->value('phone');

                $status = Order::where('transaction_id', $tran_id)->value('status');
                $url = "http://66.45.237.70/api.php";
                $number = $Order_mobile;
                $text = "Thank you for your order. \nOrder No# " . $tran_id . "\nOrder Status: " . $status . "\nHotline+8801739438877";
                $data = array(
                    'username' => "oslbd",
                    'password' => "GKXMYQ7P",
                    'number' => "$number",
                    'message' => "$text"
                );

                $ch = curl_init(); // Initialize cURL
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch,
                    CURLOPT_POSTFIELDS,
                    http_build_query($data)
                );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $smsresult = curl_exec($ch);
                $p = explode("|", $smsresult);
                $sendstatus = $p[0];

                return redirect()->route('user-thankyou')->with('message', $tran_id);
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);

                return redirect()->route('user-sorry')->with('message', $tran_id . '   validation Fail');
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            $Order_mobile = Order::where('transaction_id', $tran_id)->value('phone');

            $status = Order::where('transaction_id', $tran_id)->value('status');
            $url = "http://66.45.237.70/api.php";
            $number = $Order_mobile;
            $text = "Thank you for your order. \nOrder No# " . $tran_id . "\nOrder Status: " . $status . "\nHotline+8801739438877";
            $data = array(
                'username' => "oslbd",
                'password' => "GKXMYQ7P",
                'number' => "$number",
                'message' => "$text"
            );

            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt(
                $ch,
                CURLOPT_POSTFIELDS,
                http_build_query($data)
            );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $smsresult = curl_exec($ch);
            $p = explode("|", $smsresult);
            $sendstatus = $p[0];

            return redirect()->route('user-thankyou')->with('message', $tran_id);
            // echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.

            return redirect()->route('user-sorry')->with('message', $tran_id . '   Invalid Transaction');
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
            return redirect()->route('user-sorry')->with('message', $tran_id . '  Your Transaction is Falied');
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            return redirect()->route('user-sorry')->with('message', $tran_id . '  Transaction is Invalid');
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);

            return redirect()->route('user-sorry')->with('message',$tran_id . '  Your Order is Canceled');
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            return redirect()->route('user-sorry')->with('message', $tran_id . '  Your Transaction is Invalid');
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    // echo "Transaction is successfully Completed";
                    $Order_mobile = Order::where('transaction_id', $tran_id)->value('phone');

                    $status = Order::where('transaction_id', $tran_id)->value('status');
                    $url = "http://66.45.237.70/api.php";
                    $number = $Order_mobile;
                    $text = "Thank you for your order. \nOrder No# " . $tran_id . "\nOrder Status: " . $status . "\nHotline+8801739438877";
                    $data = array(
                        'username' => "oslbd",
                        'password' => "GKXMYQ7P",
                        'number' => "$number",
                        'message' => "$text"
                    );

                    $ch = curl_init(); // Initialize cURL
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt(
                        $ch,
                        CURLOPT_POSTFIELDS,
                        http_build_query($data)
                    );
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $smsresult = curl_exec($ch);
                    $p = explode("|", $smsresult);
                    $sendstatus = $p[0];

                    return redirect()->route('user-thankyou')->with('message', $tran_id);
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);


                    return redirect()->route('user-sorry')->with('message', $tran_id . '   validation Fail');
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                return redirect()->route('user-sorry')->with('message', $tran_id . '   Invalid Transaction');
            }
        } else {
            return redirect()->route('user-sorry')->with('message', 'Invalid Date');
        }
    }

}
