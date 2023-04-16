<?php

namespace App\Http\Controllers\Frontend;

use App\EcomUser;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\EcomUserRequest;
use Illuminate\Contracts\Session\Session;

class EcomUserController extends Controller
{
    public function registration(EcomUserRequest $request)
    {
        $data = $request->all();
        if($data['password'] == $data['confirm_password']){
            $random_number = rand(1000, 9999);

            $user_id = EcomUser::insertGetId([
                    'name'         =>   $data['name'],
                    'email'        =>   $data['email'],
                    'mobile'       =>   $data['mobile'],
                    'otp_code'     =>   $random_number,
                    'address'      =>   $data['address'],
                    'password'     =>   bcrypt($data['password']),
                    'created_at'   =>   Carbon::now(),
                ]);

            $url = "http://66.45.237.70/api.php";
            $number = $data['mobile'];
            $text = "Welcome to Original Store Ltd your varification code is ". $random_number . " Hot line number +880 173 9438877";
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

             return view('Frontend.layouts.Auth.verification_code', compact('user_id'));
        }
        else{
            return redirect('/ecom/user/registration')->with('message', 'password and confirm password does not mathc!!');
        }

    }

    public function registrationPage(){
        return view('Frontend.layouts.Auth.registration');
    }
    /*==========Admin Login=========*/

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'email' => 'required|email',
                'password' => 'required',
            ];
            $customMessages = [
                'email.required' => 'Please Give Your Email Address',
                'email.email' => 'Please Give Your Valid Email Address',
                'password.required' => 'Please Give Your Password',
            ];
            $this->validate($request, $rules, $customMessages);
            if(EcomUser::where('email', $data['email'])->value('otp_code') == EcomUser::where('email', $data['email'])->value('otp_verification')){
                if (Auth::guard('ecomUser')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    return redirect()->route('my.account');
                    // return redirect()->back();
                } else {
                    return redirect('/ecom/user/login')->with('status', 'Invalid Email or Password');
                }
            }else{
                return back()->with('status', 'your account is not verified');
            }

        }

        return view('Frontend.layouts.Auth.login');
    }

    /*==========Admin Logout=========*/
    public function logout()
    {
        Auth::guard('ecomUser')->logout();
        return redirect('/');
    }

    public function forgotPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;

            if(!EcomUser::where('mobile', $data['mobile'])->exists()){

                return redirect()->back()->with('error_message', 'Mobile number does not exists');
            }

            //Generate Random Password
             $random_password = rand(100000, 1000000);
            $new_password = bcrypt($random_password);
            //update password
            EcomUser::where('mobile', $data['mobile'])->update(['password'=> $new_password]);
            $userName = EcomUser::select('name','mobile','email')->where('mobile', $data['mobile'])->first();
            //send forgot password email
            $mobile = $data['mobile'];
            $name = $userName->name;
            $email = $userName->email;

            $messageData = [
                'mobile'=> $mobile,
                'name'=>$name,
                'password'=>$random_password,
            ];
            $url = "http://66.45.237.70/api.php";
            $number = $data['mobile'];
            $text = "Welcome to Original Store Ltd  your new password is =" .$random_password. " Hot line number +880 173 9438877";
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
            // Mail::send('Frontend.layouts.emails.forget_password', $messageData, function($message)use($email){
            //     $message->to($email)->subject('New Password - www.originalstorebd.com');
            // });


            //redirect to login page
            $message = "Please check your mobile for new password";
            return redirect('/ecom/user/login')->with('success', $message);
        }
        return view('Frontend.layouts.Auth.forgotPassword');
    }

    public function updateEcomUserDetails(Request $request){
        $data = $request->all();
        $rules = [
            'email' => 'required|email',
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'mobile' => 'required|numeric|digits:11',
            'address' => 'required',

        ];
        $customMessages = [
            'email.required' => 'Please Give Your Email Address',
            'email.email' => 'Please Give Your Valid Email Address',
            'mobile.digits' => 'Moblie Number should be 11 digits',
        ];
        $this->validate($request, $rules, $customMessages);

        //update admin details
        EcomUser::where('email', Auth::guard('ecomUser')->user()->email)->update(['name' => $data['name'], 'mobile' => $data['mobile'],'address' => $data['address'], 'email' => $data['email']]);
        return redirect()->back()->with('success', 'User Details updated successfully !!');
    }

    public function verificationCode(){
        return view('Frontend.layouts.Auth.verification_code');
    }

    public function mobileOtp(Request $request){
        $data = $request->all();
        if($data['otp_verification'] == EcomUser::where('otp_code', $data['otp_verification'])->value('otp_code')){
            EcomUser::where('id', $data['user_id'])->update(['otp_verification' => $data['otp_verification']]);
            return redirect()->route('my.account');
        }else{
            return redirect()->route('verification-code');
        }
    }


}
