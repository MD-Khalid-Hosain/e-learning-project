<?php

namespace App\Http\Controllers\Dashboard;

use App\About;
use App\Scroll;
use App\ContactUs;
use App\FrontPage;
use App\JobCircular;
use App\ReturnRefund;
use App\MissionVision;
use App\PaymentPolicy;
use App\PrivacyPolicy;
use App\DeliveryPolicy;
use App\EMIInformation;
use App\TermsAndCondition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InformationController extends Controller
{
    public function about(){
        $about = About::find(1);
        $count = count(About::all());

        return view('backend.layouts.information.about', compact('about', 'count'));
    }
    public function aboutCreate(Request $request){
        About::create([
            'about_description' => $request->about_description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,

        ]);
        return back();
    }
    public function updateAbout(Request $request){
        About::find(1)->update([
            'about_description' => $request->about_description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);
        return back();
    }

    public function frontPageSeo(){
        $frontPage = FrontPage::find(1);
        $count = count(FrontPage::all());

        return view('backend.layouts.information.front_page_seo', compact('frontPage', 'count'));
    }
    public function frontPageSeoCreate(Request $request){
        FrontPage::create([
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,

        ]);
        return back();
    }
    public function updateFrontPage(Request $request){
        FrontPage::find(1)->update([
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);
        return back();
    }

    public function termsCondition(){
        $terms = TermsAndCondition::find(1);
        $count = count(TermsAndCondition::all());

        return view('backend.layouts.information.terms_and_conditions', compact('terms', 'count'));
    }
    public function termsConditionCreate(Request $request){
        TermsAndCondition::create([
            'terms_description' => $request->terms_description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,

        ]);
        return back();
    }
    public function updateTermsConditionPage(Request $request){
        TermsAndCondition::find(1)->update([
            'terms_description' => $request->terms_description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);
        return back();
    }



    public function payment(){
        $paymentInformation = PaymentPolicy::find(1);
        $count = count(PaymentPolicy::all());

        return view('backend.layouts.information.payment_policy', compact('paymentInformation', 'count'));
    }
    public function paymentCreate(Request $request){
        PaymentPolicy::create([
            'payment_policy' => $request->payment_policy,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,

        ]);
        return back();
    }
    public function updatePayment(Request $request){
        PaymentPolicy::find(1)->update([
            'payment_policy' => $request->payment_policy,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);
        return back();
    }

    public function emiInformation(){
        $emi = EMIInformation::find(1);
        $count = count(EMIInformation::all());

        return view('backend.layouts.information.emi_information', compact('emi', 'count'));
    }
    public function emiCreate(Request $request){
        EMIInformation::create([
            'emi_information' => $request->emi_information,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,

        ]);
        return back();
    }
    public function emiUpdate(Request $request){
        EMIInformation::find(1)->update([
            'emi_information' => $request->emi_information,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);
        return back();
    }



    public function privacyInformation(){
        $privacy = PrivacyPolicy::find(1);
        $count = count(PrivacyPolicy::all());

        return view('backend.layouts.information.privacy_policy', compact('privacy', 'count'));
    }
    public function privacyCreate(Request $request){
        PrivacyPolicy::create([
            'privacy_information' => $request->privacy_information,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,

        ]);
        return back();
    }
    public function privacyUpdate(Request $request){
        PrivacyPolicy::find(1)->update([
            'privacy_information' => $request->privacy_information,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);
        return back();
    }


    public function returnRefundInformation(){
        $returnRefund = ReturnRefund::find(1);
        $count = count(ReturnRefund::all());

        return view('backend.layouts.information.return_refund', compact('returnRefund', 'count'));
    }
    public function returnRefundCreate(Request $request){
        ReturnRefund::create([
            'return_refund_information' => $request->return_refund_information,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,

        ]);
        return back();
    }
    public function returnRefundUpdate(Request $request){
        ReturnRefund::find(1)->update([
            'return_refund_information' => $request->return_refund_information,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);
        return back();
    }



    public function deliveryPolicy(){
        $deliveryPolicy = DeliveryPolicy::find(1);
        $count = count(DeliveryPolicy::all());

        return view('backend.layouts.information.delivery_policy', compact('deliveryPolicy', 'count'));
    }
    public function deliveryPolicyCreate(Request $request){
        DeliveryPolicy::create([
            'delivery_policy' => $request->delivery_policy,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,

        ]);
        return back();
    }
    public function deliveryPolicyUpdate(Request $request){
        DeliveryPolicy::find(1)->update([
            'delivery_policy' => $request->delivery_policy,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);
        return back();
    }


    public function jobCircularInformation(){
        $jobCircular = JobCircular::find(1);
        $count = count(JobCircular::all());

        return view('backend.layouts.information.job_circular', compact('jobCircular', 'count'));
    }
    public function jobCircularCreate(Request $request){
        JobCircular::create([
            'job_circular_information' => $request->job_circular_information,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,

        ]);
        return back();
    }
    public function jobCircularUpdate(Request $request){
        JobCircular::find(1)->update([
            'job_circular_information' => $request->job_circular_information,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);
        return back();
    }


    public function missionVisionInformation(){
        $missionVision = MissionVision::find(1);
        $count = count(MissionVision::all());

        return view('backend.layouts.information.mission_vision', compact('missionVision', 'count'));
    }
    public function missionVisionCreate(Request $request){
        MissionVision::create([
            'mission_vision_information' => $request->mission_vision_information,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,

        ]);
        return back();
    }
    public function missionVisionUpdate(Request $request){
        MissionVision::find(1)->update([
            'mission_vision_information' => $request->mission_vision_information,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);
        return back();
    }


    public function contactAdd(){
        return view('backend.layouts.information.add_contact');
    }
    public function contactInformation(){
        $allContact = ContactUs::all();
        return view('backend.layouts.information.contact_us', compact('allContact'));
    }
    public function contactEdit($id){
        $contact = ContactUs::find($id);
        return view('backend.layouts.information.edit_contact', compact('contact'));
    }
    public function contactCreate(Request $request){

        ContactUs::create([
            'branch_name' => $request->branch_name,
            'address' => $request->address,
            'location_map' => $request->location_map,
            'close_day' => $request->close_day,
            'status' => 1,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'serial' => $request->serial,
        ]);
        return redirect('admin/contact/information')->with('success', "Branch Added Successfully !!");
    }
    public function contactUpdate(Request $request){

        ContactUs::find($request->contact_id)->update([
            'branch_name' => $request->branch_name,
            'address' => $request->address,
            'location_map' => $request->location_map,
            'close_day' => $request->close_day,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'serial' => $request->serial,
        ]);
        return redirect('admin/contact/information')->with('success', "Branch Updated Successfully !!");
    }

    public function contactStatusUpdate(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            ContactUs::where('id', $data['contact_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'contact_id' => $data['contact_id']]);
        }
    }

    public function contactDelete($id){
         ContactUs::find($id)->delete();
        return back()->with('success', "Branch Delete Successfully !!");
    }


    //scroling function

    public function scrollAdd()
    {
        return view('backend.layouts.information.add_scroll');
    }
    public function scrollInformation()
    {
        $allScroll = Scroll::all();
        return view('backend.layouts.information.scroll_bar', compact('allScroll'));
    }
    public function scrollCreate(Request $request)
    {
        if(Scroll::where('day', $request->day)->exists()){
            return back()->with('error', "Scroll Status Already Exists in This Day !!");
        }

        Scroll::create([
            'scroll_status' => $request->scroll_status,
            'day' => $request->day,
            'status' => 1,

        ]);
        return redirect('admin/scroll/information')->with('success', "Scroll Status Successfully !!");
    }
    public function scrollEdit($id)
    {
        $scroll = Scroll::find($id);
        return view('backend.layouts.information.edit_scroll', compact('scroll'));
    }
    public function scrollUpdate(Request $request)
    {

        Scroll::find($request->scroll_id)->update([
            'scroll_status' => $request->scroll_status,
            'day' => $request->day,
        ]);
        return redirect('admin/scroll/information')->with('success', "Scroll Updated Successfully !!");
    }

    public function scrollStatusUpdate(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Scroll::where('id', $data['scroll_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'scroll_id' => $data['scroll_id']]);
        }
    }

    public function scrollDelete($id)
    {
        Scroll::find($id)->delete();
        return back()->with('success', "Scroll Delete Successfully !!");
    }


}
