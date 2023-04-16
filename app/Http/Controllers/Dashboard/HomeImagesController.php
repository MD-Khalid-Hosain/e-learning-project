<?php

namespace App\Http\Controllers\Dashboard;

use App\HomeImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeImagesController extends Controller
{
    public function imageDetails(){
        $allImages = HomeImage::get();
        return view('backend.layouts.homeImage.homeImage',compact('allImages'));
    }

    public function HomeImageCreate(Request $request){
        $request->validate([
            'image_link' => 'required',
            'type' => 'required',
            'image_alter' => 'required',
            'home_image' => 'required',
        ]);
        $image_id = HomeImage::insertGetId([
            'image_link' => $request->image_link,
            'type' => $request->type,
            'image_alter' => $request->image_alter,
            'home_image' => 'image.jpg',
            'status' => 1,
        ]);

        // main photo upload start
        $uploaded_home_img = $request->file('home_image');
        $img_format = imagecreatefromjpeg($uploaded_home_img);
        imagepalettetotruecolor($img_format);
        imagealphablending($img_format, true);
        imagesavealpha($img_format, true);
        $home_image_name = $image_id  . '.webp';
        $home_img_location = base_path('public/backend/uploads/homeImage/' . $home_image_name);
        imagewebp($img_format, $home_img_location, 70);
        imagedestroy($img_format);
        // Image::make($uploaded_home_img)->save($home_img_location);

        HomeImage::find($image_id)->update([
            'home_image' => $home_image_name,
        ]);
            $message = "Home Image Created Successfully !!";
            return back()->with('success', $message);
    }

    /*========================================================
    ||     HomeImage active or inactive status  start       ||
    ==========================================================*/
    public function updateHomeImageStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            HomeImage::where('id', $data['image_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'image_id' => $data['image_id']]);
        }
    }
    /*========================================================
    ||     HomeImage active or inactive status  End        ||
    ==========================================================*/

    public function homeImageEdit($id){
        $homeImage = HomeImage::find($id);
        return view('backend.layouts.homeImage.editHomeImage', compact('homeImage'));
    }

    public function homeImageUpdate(Request $request){
        $homeImage = HomeImage::find($request->homeImage_id);
        // echo $homeImage->id; die;

        if(!empty($request->hasFile('home_image'))){
            // main photo upload start
            $uploaded_home_img = $request->file('home_image');
            $img_format = imagecreatefromjpeg($uploaded_home_img);
            imagepalettetotruecolor($img_format);
            imagealphablending($img_format, true);
            imagesavealpha($img_format, true);
            $home_image_name = $request->homeImage_id  . '.webp';
            $home_img_location = base_path('public/backend/uploads/homeImage/' . $home_image_name);
            imagewebp($img_format, $home_img_location, 70);
            imagedestroy($img_format);

            HomeImage::find($homeImage->id)->update([
                'home_image' => $home_image_name,
            ]);
        }

        $homeImage->image_link = $request->image_link;
        $homeImage->type = $request->type;
        $homeImage->image_alter = $request->image_alter;
        $homeImage->save();

        $message = "Home Image Updated Successfully !!";
        return back()->with('success', $message);
    }

}
