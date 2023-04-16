<?php

namespace App\Http\Controllers\Frontend;

use App\Course;
use App\CourseCategory;
use App\ExamEvent;
use App\ExamResult;
use App\Http\Controllers\Controller;
use App\PaymentDetails;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function eHome(){
        $allCourse = Course::inRandomOrder()->get();
        return view('Frontend.elearning.home', compact('allCourse'));
    }
    public function allExam(){
        $allExams = ExamEvent::where('exam_date', '>', Carbon::now()->format('Y-m-d'))->get();
        return view('Frontend.elearning.exam_list', compact('allExams'));
    }
    public function checkoutPage($slug){
        $examDetails = ExamEvent::where('slug',$slug)->first();
//        echo "<pre>";
//        print_r($examDetails);
        return view('Frontend.elearning.exam_details', compact('examDetails'));
    }
    public function searchCourseCategory($slug){
        $category = CourseCategory::where('slug', $slug)->first();
        $allCourses = Course::where('category_id', $category->id)->get();
        return view('Frontend.elearning.courses_by_category', compact('allCourses',  'category'));
    }
    public function searchCourse(Request $request){
        // Get the search value from the request
        $search = $request->search_string;

        // Search in the title and body columns from the posts table
        $posts = Course::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('short_description', 'LIKE', "%{$search}%")
            ->get();
        return view('Frontend.elearning.search_result', compact('posts'));
    }
    public function checkoutConfirm(Request $request){
        $dateOfBirth = Auth::guard('student')->user()->date_of_birth;
        $years = Carbon::parse($dateOfBirth)->age;
        $slug = ExamEvent::where('id', $request->exam_id)->value('slug');
        $todayTime = Carbon::now()->format('Y-m-d g:i A');
        $timeDiff = Carbon::parse($todayTime)->diffInSeconds(Carbon::parse(ExamEvent::where('id', $request->exam_id)->value('time')));
       if($years >= 18){
           if(PaymentDetails::where('student_id', Auth::guard('student')->id())->where('exam_id',$request->exam_id)->count() < 2){
               if(PaymentDetails::where('student_id', Auth::guard('student')->id())->where('exam_id',$request->exam_id)->count() == 0){
                   $exam_id = $request->exam_id;
                   $exam_fee = $request->exam_fee;
                   return view('Frontend.elearning.payment', compact('exam_id', 'exam_fee'));
               }elseif (Carbon::parse(PaymentDetails::where('student_id', Auth::guard('student')->id())->where('exam_id',$request->exam_id)->value('created_at'))->diffInDays(Carbon::now()->format('Y-m-d')) < 30){
                   return redirect()->route('checkout-page',$slug)->with('message', 'Your first attempt is done and you and you can give exam again after 1 Month. (Max 2 attempt)');
               }else{
                   $exam_id = $request->exam_id;
                   $exam_fee = $request->exam_fee;
                   return view('Frontend.elearning.payment', compact('exam_id', 'exam_fee'));
               }

           }else{
               return redirect()->route('checkout-page', $slug)->with('message', 'You already given this exam two times');
           }
       }else{
           return redirect()->route('checkout-page', $slug)->with('message', 'You are not eligible for the exam, because your age is below 18!!');
       }

    }
    public function courseDetails($slug){
        $course = Course::where('slug', $slug)->first();
        return view('Frontend.elearning.course_details', compact('course'));
    }
    public function examPolicy(){
        return view('Frontend.elearning.exam_policy');
    }
}
