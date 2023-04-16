<?php

namespace App\Http\Controllers\Dashboard;

use App\Banner;
use App\BannerRight;
use App\BannerSlider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    public function bannerDetails(){
        $allSliders = BannerSlider::get();
        $rightSideImages = BannerRight::get();
        $rightSideCount = BannerRight::get()->count();
        return view('backend.layouts.banner.banner', compact('allSliders', 'rightSideImages', 'rightSideCount'));
    }

    public function sliderCreate(Request $request){
        $slider_id = BannerSlider::insertGetId([
            'slider_link' => $request->slider_link,
            'details' => $request->details,
            'alt' => $request->alt,
            'slider_image' => 'slider.jpg',
        ]);

        if ($request->hasFile('slider_image')) {
            // main photo upload start
            $uploaded_slider_img = $request->file('slider_image');
            $img_format = imagecreatefromjpeg($uploaded_slider_img);
            imagepalettetotruecolor($img_format);
            imagealphablending($img_format, true);
            imagesavealpha($img_format, true);
            $slider_image_name = $slider_id . ".webp";
            $slider_img_location = base_path('public/backend/uploads/banners/slider/' . $slider_image_name);
            imagewebp($img_format, $slider_img_location, 70);
            imagedestroy($img_format);
            // Image::make($uploaded_slider_img)->save($slider_img_location);

            BannerSlider::find($slider_id)->update([
                'slider_image' => $slider_image_name,
            ]);
        }

            $message = "Slider Created Successfully !!";
            return back()->with('success', $message);
    }

    public function rightSideCreate(Request $request){
        $rightside_img_id = BannerRight::insertGetId([
            'right_side_link' => $request->right_side_link,
            'right_image' => 'right_image.jpg',
        ]);

        // main photo upload start
        $uploaded_rightSide_img = $request->file('right_image');
        $rightSide_img_name = $rightside_img_id . "." . $uploaded_rightSide_img->extension();
        $rightSide_img_location = base_path('public/backend/uploads/banners/rightSideImage/' . $rightSide_img_name);
        Image::make($uploaded_rightSide_img)->save($rightSide_img_location);

        BannerRight::find($rightside_img_id)->update([
            'right_image' => $rightSide_img_name,
        ]);
            $message = "Right Image Created Successfully !!";
            return back()->with('rightSide', $message);
    }

    public function sliderEdit($id){
        $slider = BannerSlider::find($id);
        return view('backend.layouts.banner.edit_slider', compact('slider'));
    }

    public function sliderUpdate(Request $request){
        $slider = BannerSlider::find($request->slider_id);

        if(!empty($request->hasFile('slider_image'))){
            // main photo upload start
            $uploaded_slider_img = $request->file('slider_image');
            $img_format = imagecreatefromjpeg($uploaded_slider_img);
            imagepalettetotruecolor($img_format);
            imagealphablending($img_format, true);
            imagesavealpha($img_format, true);
            $slider_image_name = $request->slider_id . ".webp";
            $slider_img_location = base_path('public/backend/uploads/banners/slider/' . $slider_image_name);
            imagewebp($img_format, $slider_img_location, 70);
            imagedestroy($img_format);

            BannerSlider::find($slider->id)->update([
                'slider_image' => $slider_image_name,
            ]);
        }

        $slider->slider_link = $request->slider_link;
        $slider->details = $request->details;
        $slider->alt = $request->alt;
        $slider->save();

        $message = "Slider Image Updated Successfully !!";
        return back()->with('success', $message);
    }

    public function sliderDelete($id){
        $slider = BannerSlider::find($id);

        if (file_exists(base_path() . '/public/backend/uploads/banners/slider/' . $slider->slider_image)) {
            @unlink(base_path() . '/public/backend/uploads/banners/slider/' . $slider->slider_image);

            $slider->delete();
            $message = "Slider Image Deleted Successfully !!";
            return back()->with('deletesuccess', $message);
        }
    }





    public function rightSideEdit($id){
        $rightSide = BannerRight::find($id);
        return view('backend.layouts.banner.edit_rightSide', compact('rightSide'));
    }

    public function rightSideUpdate(Request $request){
        $rightSide = BannerRight::find($request->rightSide_id);

        if(!empty($request->hasFile('right_image'))){
            // main photo upload start
            $uploaded_rightSide_img = $request->file('right_image');
            $rightSide_img_name = $rightSide->id . "." . $uploaded_rightSide_img->extension();
            $rightSide_img_location = base_path('public/backend/uploads/banners/rightSideImage/' . $rightSide_img_name);
            Image::make($uploaded_rightSide_img)->save($rightSide_img_location);

            BannerRight::find($rightSide->id)->update([
                'right_image' => $rightSide_img_name,
            ]);
        }

        $rightSide->right_side_link = $request->right_side_link;
        $rightSide->save();

        $message = "Right Side Image Updated Successfully !!";
        return back()->with('success', $message);
    }

    public function rightSideDelete($id){

        $rightSide = BannerRight::find($id);
        if (file_exists(base_path() . '/public/backend/uploads/banners/rightSideImage/' . $rightSide->right_image)) {
            @unlink(base_path() . '/public/backend/uploads/banners/rightSideImage/' . $rightSide->right_image);
            $rightSide->delete();
            $message = "Slider Image Deleted Successfully !!";
            return back()->with('deletesuccess', $message);
        }
    }
}
