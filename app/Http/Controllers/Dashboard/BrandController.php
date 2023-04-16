<?php

namespace App\Http\Controllers\Dashboard;

use App\Brand;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function brands(){
        $brands = Brand::get();
        return view('backend.layouts.brand.show_all_brands', compact('brands'));
    }
    public function addBrandForm(){
        return view('backend.layouts.brand.add_brand_form');
    }

    public function createBrand(Request $request){

        $brand = Brand::insertGetId([
            'name'=>$request->name,
            'slug' => $request->slug,
            'status'=>1,
        ]);

        //custom validation
        $rules = [
            // 'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'name' => 'required',
        ];
        $customMessages = [
            'name.required' => 'Brand name is required',
            'name.unique' => 'This Brand is already created',
        ];
        $this->validate($request, $rules, $customMessages);
        //main photo upload start
        if (!empty($request->hasFile('image'))) {
            $uploaded_brand_img = $request->file('image');
            $brand_img_name = $brand . "." . $uploaded_brand_img->extension();
            $brand_img_location = base_path('public/backend/uploads/brand_image/' . $brand_img_name);
            Image::make($uploaded_brand_img)->resize(480, 480)->save($brand_img_location);

            Brand::find($brand)->update([
                'image' => $brand_img_name
            ]);
        }

        return redirect('admin/brands')->with('success', 'Brand added succesfully!!');
    }

    public function editBrand($id){
        $brand = Brand::find($id);
        return view('backend.layouts.brand.edit_brand', compact('brand'));
    }

    public function updateBrand(Request $request){
        Brand::find($request->brand_id)->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => 1,
        ]);
        if (!empty($request->hasFile('image'))) {
            $uploaded_brand_img = $request->file('image');
            $brand_img_name = $request->brand_id . "." . $uploaded_brand_img->extension();
            $brand_img_location = base_path('public/backend/uploads/brand_image/' . $brand_img_name);
            Image::make($uploaded_brand_img)->resize(480, 480)->save($brand_img_location);

            Brand::find($request->brand_id)->update([
                'image' => $brand_img_name
            ]);
        }

        return back();
    }


    public function updateBrandStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Brand::where('id', $data['brand_id'])->update(['Status' => $status]);
            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }

    public function deleteBrand($id){
        if (Product::where('brand_id', $id)->exists()) {
            return back()->with('error', 'You Can Not Delete Becouse Brand ID is Already in Product Table');
        }
        Brand::find($id)->delete();
        $message = "Brand Deleted Successfully !!";
        return back()->with('success', $message);
    }


}
