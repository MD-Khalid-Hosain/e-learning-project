<?php

namespace App\Http\Controllers\Dashboard;


use App\Admin;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AdminValidation;

class AdminController extends Controller
{

    public function createUser(AdminValidation $request)
    {

        $admin_id = Admin::insertGetId([
            'name'         =>   $request->first_name." ".$request->last_name,
            'email'        =>   $request->email,
            'mobile'       =>   $request->mobile,
            'type'         =>  'user',// $request->role_name,
            'password'     =>   bcrypt($request->confirm_pwd),
            'status'       =>   1,
            'image'        =>   'khlaid.jpg',
            'created_at'   =>   Carbon::now(),
        ]);

        if ($request->hasFile('image')) {
            //Generate new image name
            $uploaded_admin_img = $request->file('image');
            //get image extension
            $new_admin_img_name = rand(111, 99999) . "." . $uploaded_admin_img->extension();
            //set image location
            $admin_img_location = base_path('public/backend/uploads/admin/' . $new_admin_img_name);
            //Upload the image
            Image::make($uploaded_admin_img)->resize(180, 180)->save($admin_img_location);
            //update the image name in database
            Admin::find($admin_id)->update([
                'image' => $new_admin_img_name
            ]);
        }
        $message = "User Created Successfully !!";
        return back()->with('success', $message);
    }
    /*==========Admin Login=========*/

    public function login(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'email'=> 'required|email',
                'password'=> 'required',
            ];
            $customMessages =[
                'email.required'=>'Please Give Your Email Address',
                'email.email'=> 'Please Give Your Valid Email Address',
                'password.required'=>'Please Give Your Password',
            ];
            $this->validate($request, $rules, $customMessages);
           if(Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password'], 'status'=>1])){
               return redirect('/dashboard');
           }else{
               return redirect('/admin/login')->with('status', 'Invalid Email or Password');
           }
        }

        return view('backend.layouts.admin.admin_login');
    }

    /*==========Admin Logout=========*/
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
    /*==========Current password is checking =========*/
    public function checkCurrentPassword(Request $request){
        $data = $request->all();
        $hashPwd = Auth::guard('admin')->user()->password;
        if(Hash::check($data['current_pwd'], $hashPwd)){
            echo "true";
        }else{
            echo "false";
        }
    }
 /*==========Update Admin Password =========*/
    public function updateCurrentPwd(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $hashPwd = Auth::guard('admin')->user()->password;
            //if current password is currect
            if (Hash::check($data['current_pwd'], $hashPwd)) {
                //if new and confirm password is matching
                if($data['new_pwd'] == $data['confirm_pwd']){
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                    Session::flash('success', 'Your password has been changed successfully !!');
                }else{
                    return redirect()->back()->with('error_message', 'New Password and Confirm Password not Match');
                }

            }else{
                return redirect()->back()->with('error_message', 'Your Current Password is Incorrect');
            }
            return redirect()->back();
        }
    }

/*==========Update Admin Details =========*/
public function updateAdminDetails(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric|digits:11',
                'image'=> 'image',
            ];
            $customMessages = [
                'name.required' => 'Please Give Your Name',
                'name.alpha' => 'Shoud be alphabet',
                'mobile.required' => 'Please Give Your Mobile Number',
                'mobile.digits' => 'Moblie Number should be 11 digits',
                'image.image' => 'Please select a valid image',
            ];
            $this->validate($request, $rules, $customMessages);

            //upload Image
            //if we have file or not
            if (!empty($request->hasFile('image'))) {
                //is your old photo default photo or not
                if (Auth::guard('admin')->user()->image != null) {
                    //delete the old photo
                    $location = base_path() . "/public/backend/uploads/admin/" . Auth::guard('admin')->user()->image;
                    unlink($location);
                }
                //Generate new image name
                $uploaded_admin_img = $request->file('image');
                //get image extension
                $new_admin_img_name = rand(111, 99999) . "." . $uploaded_admin_img->extension();
                //set image location
                $admin_img_location = base_path('public/backend/uploads/admin/' . $new_admin_img_name);
                //Upload the image
                Image::make($uploaded_admin_img)->resize(180, 180)->save($admin_img_location);
                //update the image name in database
                Admin::where('email', Auth::guard('admin')->user()->email)->update(['image' => $new_admin_img_name]);
            }
            //update admin details
            Admin::where('email', Auth::guard('admin')->user()->email)->update(['name'=>$data['name'], 'mobile' => $data['mobile']]);
            return redirect()->back()->with('success', 'Admin Details updated successfully !!');
        }
        $adminDetails = Admin::where('email', auth('admin')->user()->email)->first();
        return view('backend.layouts.admin.admin_update_details', compact('adminDetails'));
}



    public function settings(){

        $adminDetails = Admin::where('email', auth('admin')->user()->email)->first();
        return view('backend.layouts.admin.admin_change_password',compact('adminDetails'));
    }

    public function updateAdmintStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Admin::where('id', $data['admin_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'admin_id' => $data['admin_id']]);
        }
    }

    public function forgetPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;

            if(!Student::where('number', $data['mobile'])->exists()){

                return redirect()->back()->with('error_message', 'Mobile number does not exists');
            }

            //Generate Random Password
             $random_password = rand(100000, 1000000);
            $new_password = bcrypt($random_password);
            //update password
            Student::where('number',$data['mobile'])->update(['password'=> $new_password]);
            $userName = Student::select('first_name','last_name','email')->where('number', $data['mobile'])->first();
            //send forgot password email
            $mobile =$data['mobile'];
            $name = $userName->first_name . $userName->first_name;
            $email = $userName->email;

            $messageData = [
                'mobile'=> $mobile,
                'name'=>$name,
                'password'=>$random_password,
            ];
            $url = "http://66.45.237.70/api.php";
            $number = $data['mobile'];
            $text =  "Hello ".$name." your new password is =" .$random_password. " Hot line number +880 1760-822926";
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
            return redirect('/admin/login')->with('success', $message);
        }
        return view('backend.layouts.admin.forget_password');
    }

}
