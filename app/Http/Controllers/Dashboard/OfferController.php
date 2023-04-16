<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Offer;
use App\Product;
use App\Review;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function offers(){
        $allProducts = Product::OfferProduct()->get(); //local scop query
        $allOffers = Offer::get();
        return view('backend.layouts.offers.all_offers', compact('allProducts', 'allOffers'));
    }

    public function createOffer(Request $request){
        // echo "<pre>";
        // print_r($request->all());

        // die;
        $request->validate([
            'offer_name'=>'required',
            'slug'=>'required',
            'offer_type'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'description'=>'required',
            'product_id'=>'required',
            'offer_title'=>'required',
            'meta_title'=>'required',
            'meta_description'=>'required',
            'image'=>'image',
        ]);
        $offer_id = Offer::insertGetId([
            'offer_name'    => $request->offer_name,
            'slug'          => $request->slug,
            'offer_type'    => $request->offer_type,
            'offer_title'       => $request->offer_title,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'description'   => $request->description,
            'meta_title'   => $request->meta_title,
            'meta_description'   => $request->meta_description,
            'product_id'    => json_encode($request->product_id),
            'image'         => 'image.jpg',
            'status'        => 1,
        ]);
        // main photo upload start
        $uploaded_offer_img = $request->file('image');
        $img_format = imagecreatefromjpeg($uploaded_offer_img);
        imagepalettetotruecolor($img_format);
        imagealphablending($img_format, true);
        imagesavealpha($img_format, true);
        $offer_image_name = $offer_id  . '.webp';
        $offer_img_location = base_path('public/backend/uploads/offer/' . $offer_image_name);
        imagewebp($img_format, $offer_img_location, 70);
        imagedestroy($img_format);


        Offer::find($offer_id)->update([
            'image' => $offer_image_name,
        ]);

        return back()->with('success', 'offer create successfully!!');
    }

    public function editOffer($offer_id){
        $allProducts = Product::OfferProduct()->get(); //local scop query
        $offer = Offer::find($offer_id);
        $offerProducts = Product::whereIn('id', json_decode($offer->product_id))->get();
        return view('backend.layouts.offers.edit_offer', compact('offer', 'offerProducts', 'allProducts'));
    }

    public function updateofferStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Offer::where('id', $data['offer_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'offer_id' => $data['offer_id']]);
        }
    }

    public function updateOffer(Request $request){
        $offer = Offer::find($request->offer_id);
        if (!empty($request->hasFile('image'))) {
            $uploaded_offer_img = $request->file('image');
            $img_format = imagecreatefromjpeg($uploaded_offer_img);
            imagepalettetotruecolor($img_format);
            imagealphablending($img_format, true);
            imagesavealpha($img_format, true);
            $offer_image_name = $request->offer_id  . '.webp';
            $offer_img_location = base_path('public/backend/uploads/offer/' . $offer_image_name);
            imagewebp($img_format, $offer_img_location, 70);
            imagedestroy($img_format);


            Offer::find($request->offer_id)->update([
                'image' => $offer_image_name,
            ]);
        }
        $offer->offer_name = $request->offer_name;
        $offer->slug = $request->slug;
        $offer->offer_type = $request->offer_type;
        $offer->offer_title = $request->offer_title;
        $offer->start_date = $request->start_date;
        $offer->end_date = $request->end_date;
        $offer->description = $request->description;
        $offer->meta_title = $request->meta_title;
        $offer->meta_description = $request->meta_description;
        $offer->product_id = json_encode($request->product_id);
        $offer->save();

        return back()->with('success', 'offer updated successfully!!');
    }

    public function deleteOffer($id){
        $offer = Offer::find($id);
        if(Product::where('offer_id', $id)->exists()){
            return back()->with('error', 'You Can Not Delete Becouse Offer ID is Already in a Product');
        }
        if (file_exists(base_path() . '/public/backend/uploads/offer/' . $offer->image)) {
            @unlink(base_path() . '/public/backend/uploads/offer/' . $offer->image);
            $offer->delete();
            $message = "Offer Delete Successfully !!";
            return back()->with('success', $message);
        }
    }
}








