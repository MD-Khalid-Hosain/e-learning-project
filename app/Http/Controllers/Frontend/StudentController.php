<?php

namespace App\Http\Controllers\Frontend;

use App\Course;
use App\CourseEnroll;
use App\CourseReview;
use App\ExamDetails;
use App\ExamEvent;
use App\ExamResult;
use App\Http\Controllers\Controller;
use App\PaymentDetails;
use App\Question;
use App\Student;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Frontend.elearning.Auth.registration');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'number' => 'required|unique:students,number|numeric|digits:11',
            'email' => 'required|email|unique:students,email',
            'city' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
            'date_of_birth' => 'required',
        ]);
        if($data['password'] == $data['password_confirmation']){
            $random_number = rand(1000, 9999);

            $student_id = Student::insertGetId([
                'first_name'         =>   $data['first_name'],
                'last_name'         =>   $data['last_name'],
                'number'         =>   $data['number'],
                'email'        =>   $data['email'],
                'city'        =>   $data['city'],
                'country'        =>   'Bangladesh',
                'otp_code'     =>   $random_number,
                'password'     =>   bcrypt($data['password']),
                'created_at'   =>   Carbon::now(),
                'date_of_birth'   =>   Carbon::parse($request->date_of_birth)->format('Y-m-d'),
            ]);

            $url = "http://66.45.237.70/api.php";
            $number = $data['number'];
            $text = "Welcome to Learn Academy your verification code is ". $random_number . " Hot line number +8801760822926";
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

            return view('Frontend.elearning.Auth.verification', compact('student_id'));
        }
        else{
            return redirect()->route('student.index')->with('error', 'password and confirm password does not mathc!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        Student::findOrFail($id)->update([
           'first_name'=> $request->first_name,
           'last_name'=> $request->last_name,
           'number'=> $request->number,
        ]);
        return back()->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function verificationPage(){
        return view('Frontend.elearning.Auth.verification');
    }

    public function otpVerification(Request $request)
    {
        $data = $request->all();
        if($data['otp_verification'] == Student::where(['otp_code'=> $data['otp_verification'], 'id' => $data['student_id']])->value('otp_code')){
            Student::where('id', $data['student_id'])->update(['otp_verification' => $data['otp_verification']]);
            return redirect()->route('student-profile');
        }else{
            return redirect()->route('otp-verification-page')->with('error_message', 'Invalid code');
        }
    }
    public function studentLoginPage(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
//            print_r($data);
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
            if(Student::where('email', $data['email'])->value('otp_code') == Student::where('email', $data['email'])->value('otp_verification')){
                if (Auth::guard('student')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    return redirect()->intended(route('elearning-home'));
                    // return redirect()->back();
                } else {
                    return redirect('login/students')->with('error_message', 'Invalid Email or Password');
                }
            }else{
                return back()->with('error_message', 'your account is not verified');
            }

        }
        if(Auth::guard('student')->check()){
            return redirect()->route('elearning-home');
        }else{
            return view('Frontend.elearning.Auth.login');
        }



    }
    public function studentLogout(){
        Auth::guard('student')->logout();
        return redirect()->route('elearning-home');
    }

    public function studentProfile(){
        return view('Frontend.elearning.users.user-profile');
    }
    public function studentExams(){
        $allExamsIds = PaymentDetails::where('student_id', Auth::guard('student')->id())->where('exam_confirmation_status', 'confirmed')->pluck('exam_id');
        $allExams = ExamEvent::whereIn('id', $allExamsIds)->where('exam_date', '>=', Carbon::now()->format('Y-m-d'))->get();
        return view('Frontend.elearning.users.my_exams', compact('allExams'));

    }

    public function examStart($exam_id){

        $examDetails = ExamEvent::find($exam_id);
        $carbonTime = Carbon::now()->format('Y-m-d g:i A');
        $examTime = $examDetails->time;
        $todayTime = $carbonTime;
        $timeDiff = Carbon::parse($todayTime)->diffInMinutes(Carbon::parse($examTime));
        $toDate = Carbon::parse($examDetails->exam_date);
        $fromDate = Carbon::now()->format('Y-m-d');

        $daysDiff = $toDate->diffInDays($fromDate);

        if($examDetails->exam_date == Carbon::now()->format('Y-m-d') && Carbon::parse($examTime)->lte(Carbon::parse($todayTime))){
            if($examDetails->duration > $timeDiff){
                return redirect()->route('student-exams')->with('message', 'Exam time is over!!');
            }
            if(ExamResult::where('student_id', Auth::guard('student')->id())->where('exam_id',$exam_id)->count() < 2){
                if(ExamResult::where('student_id', Auth::guard('student')->id())->where('exam_id',$exam_id)->count() == 0){
                    $questions = Question::where('exam_id', $exam_id)->get();
                    $totalMarks = Question::where('exam_id', $exam_id)->sum('point');
                    return view('Frontend.elearning.users.attend_exam', compact('examDetails', 'questions', 'totalMarks'));
                }elseif($daysDiff < 30){
                    return redirect()->route('student-exams')->with('message', 'Your first attempt is done and you and you can give exam again after 1 Month. (Max 2 attempt)');
                }else{
                    $questions = Question::where('exam_id', $exam_id)->get();
                    $totalMarks = Question::where('exam_id', $exam_id)->sum('point');
                    return view('Frontend.elearning.users.attend_exam', compact('examDetails', 'questions', 'totalMarks'));
                }
            }else{
                return redirect()->route('student-exams')->with('message', 'You already given this exam two times!!');
            }

        }else{
            return redirect()->route('student-exams')->with('message', 'This exam will be started on '.$examDetails->exam_date.' at Time: '.Carbon::parse($examDetails->time)->format('g:i A'));
        }


    }
    public function storeQuestionAnswer(Request $request){
        $data = $request->all();
        $yes = 0;
        $no = 0;
        $totalMarks = 0;
        for ($i=1; $i <= $data['index']; $i++){
            $question = Question::where('id', $data['question_id'.$i])->get()->first();
            $examDetails = new ExamDetails();
            if($question->right_answer == $data['ans'.$i]){
                $yes++;
                $totalMarks += $question->point;
            }else{
                $no++;
            }
            $examDetails->exam_id = $request->exam_id;
            $examDetails->student_id = Auth::guard('student')->id();
            $examDetails->question_id = $question->id;
            $examDetails->given_answer = $data['ans'.$i];
            $examDetails->right_answer = $question->right_answer;
            $examDetails->marks = $question->point;
            $examDetails->save();
        }
        $result = new ExamResult();
        $result->student_id = Auth::guard('student')->id();
        $result->exam_id = $request->exam_id;
        $result->total_right_ans = $yes;
        $result->total_wrong_ans = $no;
        $result->total_mark = $totalMarks;
        $result->status = 'pending';
        $result->save();
        return redirect()->route('student-exams')->with('success', 'Your exam submitted successfully and your result will publish soon.. ');
    }

    public function studentDashboard(){
        $allExamResult = ExamResult::where('student_id', Auth::guard('student')->id())->get();
        return view('Frontend.elearning.users.student_dashboard', compact('allExamResult'));
    }
    public function accountPage(){
        return view('Frontend.elearning.users.user-credentials');
    }
    public function StudentChangePassword(Request $request){

            if($request->isMethod('post')){
                $data = $request->all();
                $hashPwd = Auth::guard('student')->user()->password;
                //if current password is currect
                if (Hash::check($data['current_pwd'], $hashPwd)) {
                    //if new and confirm password is matching
                    if($data['new_pwd'] == $data['confirm_pwd']){
                        Student::where('id', Auth::guard('student')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                        return back()->with('success', 'Your password has been changed successfully !!');
                    }else{
                        return back()->with('error_message', 'New Password and Confirm Password not Match');
                    }

                }else{
                    return back()->with('error_message', 'Your Current Password is Incorrect');
                }
                return back();
            }
    }
    public function forgetPassword(){
       return view('Frontend.elearning.users.forget_password');
    }
    public function sendPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;

            if(!Student::where('number', $data['number'])->exists()){

                return redirect()->back()->with('error_message', 'Mobile number does not exists');
            }

            //Generate Random Password
            $random_password = rand(100000, 1000000);
            $new_password = bcrypt($random_password);
            //update password
            Student::where('number', $data['number'])->update(['password'=> $new_password]);
            $userName = Student::select('first_name','last_name','email')->where('number', $data['number'])->first();
            //send forgot password email
            $mobile = $data['number'];
            $name = $userName->first_name .' '. $userName->last_name;

            $messageData = [
                'mobile'=> $mobile,
                'name'=>$name,
                'password'=>$random_password,
            ];
            $url = "http://66.45.237.70/api.php";
            $number = $data['number'];
            $text =  "Hello ".$name." your new password is =" .$random_password;
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
            return redirect('/login/students')->with('success', $message);
        }
        return view('Frontend.elearning.users.forget_password');
    }

    public function invoicePage(){
        $allPayment = PaymentDetails::where('student_id', Auth::guard('student')->user()->id)->orderBy('id', 'DESC')->get();
        return view('Frontend.elearning.users.student_invoice', compact('allPayment'));
    }
    public function studentInvoiceDownload($id){
        $paymentDetails = PaymentDetails::findOrFail($id);

        $order_pdf = PDF::loadView('Frontend.elearning.users.student_invoice_pdf', compact('paymentDetails'))->setPaper('a4', 'portrait');;

        return $order_pdf->download('myInvoice.pdf');
    }
    public function StudentCourseEnroll($id)
    {
        $dateOfBirth = Auth::guard('student')->user()->date_of_birth;
        $years = Carbon::parse($dateOfBirth)->age;
        if($years >= 18){
            if(CourseEnroll::where('course_id', $id)->where('student_id', Auth::guard('student')->id())->exists()){
                return redirect()->route('student-courses')->with('error', 'You already enrolled this course !!');
            }
            CourseEnroll::create([
                'student_id'=> Auth::guard('student')->id(),
                'course_id'=> $id,
            ]);
            return redirect()->route('student-courses')->with('success', 'Course enrolled successfully');
        }
        else{
                return back()->with('message', 'You are not eligible for the exam, because your age is below 18!!');
            }

    }
    public function studentCourses(){
        $enrolls = CourseEnroll::where('student_id', Auth::guard('student')->id())->get();
        return view('Frontend.elearning.users.courses', compact('enrolls'));
    }

    public function courseReview(Request $request){
        $request->validate([
            'comment'=> 'required',
            'ratting'=> 'required'
        ]);
        if(CourseEnroll::where('course_id', $request->course_id)->where('student_id', Auth::guard('student')->id())->exists()){
            CourseReview::create([
                'comment'=> $request->comment,
                'ratting'=> $request->ratting,
                'student_id'=> Auth::guard('student')->id(),
                'course_id'=> $request->course_id
            ]);
            return back()->with('success', 'Your Review Submitted successfully');
        }

        return back()->with('message', 'You have to enrolled first this course');
    }



}
