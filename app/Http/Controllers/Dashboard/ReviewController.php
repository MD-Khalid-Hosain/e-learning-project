<?php

namespace App\Http\Controllers\Dashboard;

use App\Review;
use App\UserQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Question\Question;

class ReviewController extends Controller
{
    public function review(){
        $allReviews= Review::all();
        return view('backend.layouts.question_and_review.review', compact('allReviews'));
    }
    public function updateReviewStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Approved") {
                $status = 0;
            } else {
                $status = 1;
            }
            Review::where('id', $data['review_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'review_id' => $data['review_id']]);
        }
    }

    public function deleteReview($id){
        Review::find($id)->delete();
        return back()->with('success', 'Review is deleted successfully!!');
    }


    //question part satrt
    public function questionList(){
        $allQuestions = UserQuestion::all();
        return view('backend.layouts.question_and_review.question', compact('allQuestions'));
    }

    public function deleteQuestion($id){

        UserQuestion::find($id)->delete();
        return back()->with('success', 'Question Deleted Successfully !!');
    }

    public function editAnswer($id){
        $question = UserQuestion::find($id);
        return view('backend.layouts.question_and_review.send_answer',compact('question'));
    }

    public function questionAnswer(Request $request){
        $request->validate([
            'answer'=>'required'
        ]);
        UserQuestion::where('id', $request->question_id)->update([
            'answer'=> $request->answer,
            'admin_id'=> Auth::guard('admin')->user()->id
        ]);

        $customer_number = UserQuestion::where('id', $request->question_id)->value('customer_number');
        $answer = UserQuestion::where('id',$request->question_id)->where('answer', $request->answer)->value('answer');

        $url = "http://66.45.237.70/api.php";
        $number = $customer_number;
        $text = "Your Answer \n#" . $answer . "\nThank you for your question". "\nHotline+8801739438877";
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

        return redirect()->route('all.question')->with('success', 'Answer given successfully');
    }

}
