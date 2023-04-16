<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\HomeImage;
use Carbon\Carbon;
use App\BannerRight;
use App\BannerSlider;
use App\FrontPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use App\Product;
use App\About;
use App\Brand;
use App\ContactUs;
use App\DeliveryPolicy;
use App\EMIInformation;
use App\JobCircular;
use App\MissionVision;
use App\Offer;
use App\PaymentPolicy;
use App\PrivacyPolicy;
use App\ReturnRefund;
use App\Scroll;
use App\TermsAndCondition;

class FrontendController extends Controller
{
    // $allScrollStatus = Scroll::get();
    //     $scrollStatus =0;
    //     foreach ($allScrollStatus as $scroll){
    //         if($scroll->day == Carbon::now()->format('l')){
    //             $scrollStatus= $scroll->scroll_status;
    //         }
    //     }
    public function index(){

        $all_cart_product = Cart::all();
        foreach ($all_cart_product as $all) {
            $all::where('created_at', '!=', Carbon::now()->toDateString())->delete();
        }
        $allSliders = BannerSlider::get();
        $rightSideImages = BannerRight::get();
        $allImages = HomeImage::where('status',1)->get();
        $description = FrontPage::find(1);
        return view('Frontend.layouts.index', compact('allSliders', 'rightSideImages','allImages', 'description'));
    }



    public function allSearchResult(){

        $search_product = QueryBuilder::for(Product::class)
            ->allowedFilters('product_name', 'category_id')
            ->get();
        $search_count = $search_product->count();
        return view('Frontend.layouts.search.search_result', compact('search_product', 'search_count'));
    }

    public function aboutUs(){
        $about = About::find(1);
        return view('Frontend.layouts.information.about_us',compact('about'));
    }
    public function emiInformation(){
        $emi = EMIInformation::find(1);
        return view('Frontend.layouts.information.emi_policy',compact('emi'));
    }
    public function privacyInformation(){
        $privacy = PrivacyPolicy::find(1);
        return view('Frontend.layouts.information.privacy_policy',compact('privacy'));
    }
    public function missionVision(){
        $missionVision = MissionVision::find(1);
        return view('Frontend.layouts.information.mission_and_vision',compact('missionVision'));
    }
    public function returnRefund(){
        $returnRefund = ReturnRefund::find(1);
        return view('Frontend.layouts.information.return_and_refund',compact('returnRefund'));
    }
    public function jobCircular(){
        $jobCircular = JobCircular::find(1);
        return view('Frontend.layouts.information.job_circular',compact('jobCircular'));
    }
    public function termsConditon(){
        $termsCondition = TermsAndCondition::find(1);
        return view('Frontend.layouts.information.terms_and_condition',compact('termsCondition'));
    }
    public function contactWithUs(){
        $allContact = ContactUs::where('status', 1)->orderBy('serial', 'ASC')->get();
        return view('Frontend.layouts.information.contact_us', compact('allContact'));
    }

    public function paymentPolicy()
    {
        $payment = PaymentPolicy::find(1);
        return view('Frontend.layouts.information.payment_policy', compact('payment'));
    }
    public function deliveryPolicy()
    {
        $delivery = DeliveryPolicy::find(1);
        return view('Frontend.layouts.information.delivery_policy', compact('delivery'));
    }
    public function allBrands()
    {
        $allBrands = Brand::where('status', 1)->where('image', '!=', null)->get();
        return view('Frontend.layouts.information.all_brand', compact('allBrands'));
    }
    public function siteMap()
    {
        return view('Frontend.layouts.information.site_map');
    }

    public function bannerPage($id)
    {
        $bannerDetail = BannerSlider::find($id);
        return view('Frontend.layouts.information.banner_details', compact('bannerDetail'));
    }

    public function service(){
        return view('Frontend.layouts.information.service');
    }
    //offer function start
    public function offers(){
        $allOffers = Offer::Offers()->get(); //local query scop
        return view('Frontend.layouts.information.offers', compact('allOffers'));
    }

    public function offerDetails($slug){
        $offerDetails = Offer::where('slug', $slug)->first();
        $offerProducts = Product::where('offer_id', $offerDetails->id)->get();
        $countProduct = count($offerProducts);
        return view('Frontend.layouts.information.offer_details', compact('offerDetails', 'offerProducts','countProduct'));
    }

    public function blog(){
        return view('Frontend.layouts.information.blog');
    }
    public function siteMapXml(){
        return response()->view('Frontend.layouts.information.sitemap')->header('Content-Type', 'text/xml');
    }





}
