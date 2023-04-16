<?php

namespace App\Http\Controllers;

use App\PaymentDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {

        Stripe\Stripe::setApiKey('sk_test_51MOPz8AD7h9HoabHNc2267zpkI8o381rHUiqJl2b2aUNM2annZK6w15lTLDde6YiHRI7F7CdQbK8qq7rLZPxe62K003XOBWCU3');

        Stripe\Charge::create ([
            "amount" => $request->total * 100,
            "currency" => "bdt",
            "source" => $request->stripeToken,
            "description" => "Payment from Learn Academy"
        ]);

        PaymentDetails::create([
            'student_id'=> Auth::guard('student')->id(),
            'exam_id'=> $request->exam_id,
            'payment_status'=> 'Success',
            'amount'=> $request->total,
            'exam_confirmation_status'=> 'pending',
            'year' => Carbon::now()->translatedFormat('Y'),
            'month' => Carbon::now()->translatedFormat('F'),
        ]);


        return redirect()->route('student-invoice-page')->with('success', 'Exam fee paid successfully');
    }
}
