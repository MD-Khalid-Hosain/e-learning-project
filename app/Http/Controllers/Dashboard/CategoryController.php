<?php

namespace App\Http\Controllers\Dashboard;

use App\Product;
use App\Section;
use App\Category;
use Carbon\Carbon;
use App\ProductType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{

    public function categories(){
        $categories = Category::with(['section', 'parentcategory'])->get();
        $categories = json_decode(json_encode($categories));
        // print_r($categories);
        // die();
        return view('backend.layouts.category.categories', compact('categories'));
    }

    public function updateCategoryStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }

    public function addCategoryForm(){
        $title = "Add Category";
        //Get all sections
        $getSections = Section::get();
        $getCategories = Category::with('subcategories')->where('parent_id', 0)->get();
        $getCategories = json_decode(json_encode($getCategories), true);
        return view('backend.layouts.category.add_category', compact('getSections', 'title', 'getCategories'));

    }
    public function addCategory(CategoryRequest $request){

            $category_id = Category::insertGetId([
                'parent_id' => $request->parent_id,
                'section_id' => $request->section_id,
                'category_name' => $request->category_name,
                'description' => $request->description,
                'slug' => Str::slug($request->slug),
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'status' => 1,
            ]);


        //if we have file or not
        if ($request->hasFile('category_image')) {
            //Generate new image name
            $uploaded_category_img = $request->file('category_image');
            //get image extension
            $new_category_img_name = rand(111, 99999) . "." . $uploaded_category_img->extension();
            //set image location
            $category_img_location = base_path('public/backend/uploads/category/' . $new_category_img_name);
            //Upload the image
            Image::make($uploaded_category_img)->resize(300, 300)->save($category_img_location);
            //update the image name in database
            Category::find($category_id)->update([
                'category_image'=> $new_category_img_name
            ]);
        }
        return redirect('/admin/categories')->with('success', "Category Added Successfully !!");

    }
    public function updateCategory(Request $request){
        $category = Category::find($request->category_id);
        $data = $request->all();
        if(!empty($request->hasFile('category_image'))){
            //Generate new image name
            $uploaded_category_img = $request->file('category_image');
            //get image extension
            $new_category_img_name = rand(111, 99999) . "." . $uploaded_category_img->extension();
            //set image location
            $category_img_location = base_path('public/backend/uploads/category/' . $new_category_img_name);
            //Upload the image
            Image::make($uploaded_category_img)->resize(300, 300)->save($category_img_location);
            //update the image name in database
            $category->category_image = $new_category_img_name;
        }
            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->description = $data['description'];
            $category->slug = Str::slug($data['slug']);
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();
        return redirect('/admin/categories')->with('success', "Category Updated Successfully !!");

    }
    public function editCategory($id){

            //Edid Category Functionality
            $title = "Edit Category";
            $categorydata = Category::where('id',$id)->first();
            $categorydata = json_decode(json_encode($categorydata),true);
            $getCategories = Category::with('subcategories')->where(['parent_id'=>0, 'section_id'=> $categorydata['section_id']])->get();
            $getCategories = json_decode(json_encode($getCategories), true);
            // print_r($getCategories);die;

        //Get all sections
        $getSections = Section::get();

    return view('backend.layouts.category.edit_category',compact('title', 'getSections', 'categorydata', 'getCategories'));
  }

    public function appendCategoryLevel(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $getCategories = Category::with('subcategories')->where(['section_id'=>$data['section_id'],'parent_id'=>0, 'status'=>1])->get();

            $getCategories = json_decode(json_encode($getCategories), true);

            return view('backend.layouts.category.append_categories_level',compact('getCategories'));
        }

    }

    public function deleteCategoryImage($id){
        //get category image
        $categoryImage = Category::select('category_image')->where('id', $id)->first();

        //get category image path
        $categoryImagePath = 'backend/uploads/category/';

        //delete category image from category_images folder if exists
        if(file_exists($categoryImagePath.$categoryImage->category_image)){
          unlink($categoryImagePath . $categoryImage->category_image);
        }

        //delete category image from categories table
        Category::where('id', $id)->update(['category_image'=>'']);
        return redirect()->back()->with('delete_success', 'Category Image Deleted Successfully !!');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if(Product::where('category_id', $id)->exists()){
            return back()->with('error', 'You Can Not Delete Becouse Category ID is Already in Product Table');
        }elseif(ProductType::where('category_id', $id)->exists()){
            return back()->with('error', 'You Can Not Delete Becouse Category ID is Already in Item Type Table');
        }

        if (file_exists(base_path() . '/public/backend/uploads/category/' . $category->category_image)) {
            @unlink(base_path() . '/public/backend/uploads/category/' . $category->category_image);
            $category->delete();
            $message = "Category Delete Successfully !!";
            return redirect()->back()->with('success', $message);
        }else{
            $category->delete();
            $message = "Category Delete Successfully !!";
            return redirect()->back()->with('success', $message);
        }
    }

}
