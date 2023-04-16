<?php

namespace App\Http\Controllers\Dashboard;

use App\Answer;
use App\Course;
use App\CourseLesson;
use App\ExamEvent;
use App\ExamResult;
use App\Http\Controllers\Controller;
use App\PaymentDetails;
use App\Question;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allExam = ExamEvent::orderBy('id', 'DESC')->get();
        return view('backend.layouts.exam.show_all_exam', compact('allExam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.layouts.exam.add_exam_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $time = Carbon::createFromFormat('m/d/Y', $request->exam_date)->format('Y-m-d') .' '. $request->time;
        $request->validate([
            'exam_title'=> 'required',
            'exam_date'=> 'required',
            'exam_duration'=> 'required',
            'exam_fee'=> 'required',
            'slug'=> 'required',
            'time'=> 'required',
        ]);
        ExamEvent::create([
            'exam_title'=> $request->exam_title,
            'exam_date'=> Carbon::createFromFormat('m/d/Y', $request->exam_date)->format('Y-m-d'),
            'exam_duration'=> $request->exam_duration,
            'exam_fee'=> $request->exam_fee,
            'slug'=> $request->slug,
            'time'=> $time,
        ]);
        return redirect()->route('exam-event.index')->with('success', 'Exam Created Successfully');
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
        $examDetails = ExamEvent::find($id);
        return view('backend.layouts.exam.edit_exam', compact('examDetails'));
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
        $time = Carbon::createFromFormat('m/d/Y', $request->exam_date)->format('Y-m-d') .' '. $request->time;
         ExamEvent::find($id)->update([
            'exam_title'=> $request->exam_title,
            'slug'=> $request->slug,
            'exam_date'=> Carbon::createFromFormat('m/d/Y', $request->exam_date)->format('Y-m-d'),
            'exam_duration'=> $request->exam_duration,
            'exam_fee'=> $request->exam_fee,
            'time'=> $time,
        ]);
        $message = 'Exam Updated Successfully !!';
        return redirect()->route('exam-event.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ExamEvent::find($id);
        if(PaymentDetails::where('exam_id', $id)->exists()){
            return back()->with('error_message', 'You can not delete this exam because already given this by student');
        }elseif(Question::where('exam_id', $id)){
            return back()->with('error_message', 'Please at first delete all questions related with this exam');
        }
        else{
            $data->delete();
            $message = "Exam Deleted Successfully !!";
            return back()->with('error_message', $message);
        }
    }
    public function questionForm($exam_id){
        $examTitle = ExamEvent::find($exam_id);
        $allQuestions = Question::where('exam_id', $exam_id)->orderBy('id', 'DESC')->get();
        return view('backend.layouts.exam.exam_questions', compact('allQuestions', 'examTitle'));

    }
    public function questionStore(Request $request){
        $request->validate([
            'question'=> 'required',
            'point'=> 'required|numeric',
            'right_answer'=>'required',
            'exam_id'=> 'required'
        ]);
        Question::create([
            'question'=>$request->question,
            'point'=>$request->point,
            'right_answer'=>strtolower($request->right_answer),
            'exam_id'=>$request->exam_id,
        ]);
        return back()->with('success', 'Question Created Successfully');
    }
    public function questionEdit($exam_id, $question_id){
        $questionDetails = Question::find($question_id);
        return view('backend.layouts.exam.edit_question', compact('questionDetails', 'exam_id'));
    }
    public function questionUpdate(Request $request){
        Question::find($request->question_id)->update([
            'question'=>$request->question,
            'point'=>$request->point,
            'right_answer'=>strtolower($request->right_answer),
        ]);
        return redirect()->route('exam-question',$request->exam_id)->with('success', 'Question Updated Successfully');

    }
    public function questionDelete($exam_id, $question_id){
        $data = Question::find($question_id);
        if(Answer::where('question_id', $question_id)->exists()){
            return redirect()->route('exam-question', $exam_id)->with('error', 'You can not delete this question because question related with answer');
        }
        else{
                $data->delete();
                $message = "Question Deleted Successfully !!";
                return back()->with('delete_message', $message);
            }
    }
    public function answer($exam_id, $question_id){
        $examTitle = ExamEvent::find($exam_id);
        $question = Question::find($question_id);
        $allAnswer = Answer::where(['exam_id'=> $exam_id, 'question_id'=> $question_id])->orderBy('id', 'DESC')->get();
        return view('backend.layouts.exam.exam_answer', compact('exam_id', 'question_id', 'examTitle', 'question', 'allAnswer'));
    }
    public function answerStore(Request $request){
        $request->validate([
           'answer'=> 'required',
            'exam_id'=>'required',
            'question_id'=>'required',
        ]);
        $count = Answer::where(['exam_id'=> $request->exam_id, 'question_id'=> $request->question_id])->count();
        if($count < 4){
            Answer::create([
                'answer'=> strtolower($request->answer),
                'exam_id'=>$request->exam_id,
                'question_id'=>$request->question_id,
            ]);
            return back()->with('success', 'Answer Created Successfully');
        }else{
            return back()->with('error', '4 Answer Already Created for this Question');
        }

    }
    public function answerEdit($answer_id){
        $answerDetails = Answer::find($answer_id);
        return view('backend.layouts.exam.edit_answer', compact('answerDetails'));
    }
    public function answerUpdate(Request $request){
        Answer::find($request->answer_id)->update([
            'answer'=> strtolower($request->answer)
        ]);
        return redirect()->route('exam-question-answer',[$request->exam_id, $request->question_id])->with('success', 'Option Updated Successfully');

    }
    public function answerDelete($id){
        Answer::find($id)->delete();
        $message = "Option Deleted Successfully !!";
        return back()->with('delete_message', $message);
    }
    public function examRequest(){
        $allPendingExams = PaymentDetails::get();
        return view('backend.layouts.requested_exam.all_requested_exam', compact('allPendingExams'));
    }
    public function examConfirm(Request $request){
        $data = PaymentDetails::find($request->payment_id)->update([
            'exam_confirmation_status'=> $request->confirm
        ]);
        $examId = PaymentDetails::find($request->payment_id);
        $examData = ExamEvent::find($examId->exam_id);
        $studentData = Student::find($examId->student_id);
        $url = "http://66.45.237.70/api.php";
        $number = $studentData->number;
        $text = "Your Exam  ". $examData->exam_title . " Registration is confirmed". " Exam Date: ". $examData->exam_date. " Exam Time: ".$examData->time;
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
        ExamEvent::where('id', $examId->exam_id)->increment('total_participants');

        return back()->with('success', 'Exam Confirmed successfully');
    }

    public function examReport(){
        return view('backend.layouts.exam_report.searchExamReport');
    }
    public function showSearchData(Request $request){
        if($request->order_date){
            $date = $request->order_date;
            $allOrders = PaymentDetails::whereDate('created_at', date($date))->get();
            $sum = PaymentDetails::whereDate('created_at', date($date))->sum('amount');
            return view('backend.layouts.exam_report.showSearchResult', compact('allOrders', 'sum', 'date'));
        }
        else if($request->order_month && $request->order_year){
            $month = $request->order_month;
            $year = $request->order_year;
            $allOrders = PaymentDetails::where('month', $month)->where('year', $year)->get();
            $sum = PaymentDetails::where('month', $month)->where('year', $year)->sum('amount');
            return view('backend.layouts.exam_report.showSearchResult', compact('allOrders', 'sum', 'month', 'year'));
        }
        else if($request->from && $request->to){
            $from = $request->from;
            $to = $request->to;
            $allOrders = PaymentDetails::whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->get();
            $allId = PaymentDetails::whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->pluck('id');

            $order = PaymentDetails::whereIn('id', $allId)->get();

            // $allOrders = Order::where('status', 'Delivered')->where('created_at', '>=', $from)->where('created_at', '<=', $to)->get();
            // $sum = Order::where('status', 'Delivered')->whereBetween('created_at', [date($from),date($to)])->sum('amount');
            $sum = PaymentDetails::whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->sum('amount');
            // echo "<pre>";
            // print_r($sum); die;
            // echo "<pre>";
            return view('backend.layouts.exam_report.showSearchResult', compact('allOrders', 'from', 'to','sum'));
        }
        else{
            $year = $request->order_year;
            $allOrders = PaymentDetails::where('year', $year)->get();
            $sum = PaymentDetails::where('year', $year)->sum('amount');
            return view('backend.layouts.exam_report.showSearchResult', compact('allOrders', 'sum', 'year'));
        }
    }
    public function allExamResult(){
        $allResult = ExamResult::get();
        return view('backend.layouts.exam_result.allExamResult', compact('allResult'));
    }
    public function publishExamResult(Request $request){
        ExamResult::find($request->result_id)->update([
           'status' => $request->status
        ]);
        $data = ExamResult::find($request->result_id);
        $examData = ExamEvent::find($data->exam_id);
       $studentData = Student::find($data->student_id);
        if($request->status == 'passed'){
            $url = "http://66.45.237.70/api.php";
            $number = $studentData->number;
            $text = "Congratulations you passed in ". $examData->exam_title . " you got ". $data->total_mark. " Marks and Total Right ans:". $data->total_right_ans. " Total wrong ans:".$data->total_wrong_ans;
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
        }else{
            $url = "http://66.45.237.70/api.php";
            $number = $studentData->number;
            $text = "Sorry you failed in ". $examData->exam_title . " you got ". $data->total_mark. " Marks and Total Right ans:". $data->total_right_ans. " Total wrong ans:".$data->total_wrong_ans;
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
        }


        return back()->with('success', 'Result Published Successfully');
    }

}
