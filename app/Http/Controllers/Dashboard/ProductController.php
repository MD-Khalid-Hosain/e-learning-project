<?php

namespace App\Http\Controllers\Dashboard;

use App\Brand;
use App\Product;
use App\Section;
use App\Category;
use Carbon\Carbon;
use App\PCComponent;
use App\ProductType;
use App\FilteringItem;
use App\ProductFetures;
use Illuminate\Support\Str;
use App\SpecificationHeader;
use Illuminate\Http\Request;
use App\TitleDescOfSpecification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Offer;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /*========================================================
    ||              showing all product list                ||
    ==========================================================*/
    public function products(){
        $products = Product::with(['category'=>function($query){ $query->select('id','category_name');},
        'section' => function ($query) {$query->select('id', 'section_name');}])->get();
        return view('backend.layouts.product.products',compact('products'));
    }
    /*========================================================
    ||           Product active or inactive status          ||
    ==========================================================*/
    public function updateProductStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }
    /*========================================================
    ||       add product and upload with images start       ||
    ==========================================================*/

    /*========================================================
    ||         product add form and pass categories start   ||
    ==========================================================*/
    public function addProduct()
    {
        $title = "Add Product";
        //Section with Categories and SubCategories
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories), true);
        $brands = Brand::where('status', 1)->get();
        $brands = json_decode(json_encode($brands, true), true);
        $allComponents = PCComponent::get();
        $offers = Offer::get();
        return view('backend.layouts.product.add_product', compact('title', 'categories', 'brands', 'allComponents', 'offers'));
    }
    /*========================================================
    ||         product add form and pass categories end     ||
    ==========================================================*/
    public function addProductPost(ProductRequest $request)
    {
        // echo "<pre>";print_r($request->all()); die;
        // multiple photo upload start
        $images = [];
        if ($request->hasFile('product_multiple_image')) {
            $flag = 0;
            foreach ($request->file('product_multiple_image') as $file) {
                //get image extension
                $new_product_img_name = rand(111, 99999) . $flag . "." . $file->extension();
                //set image location
                $product_img_location = base_path('public/backend/uploads/product/' . $new_product_img_name);
                //Upload the image
                Image::make($file)->resize(480, 480)->save($product_img_location);
                //update the image name in database
                $images[] = $new_product_img_name;

                $flag++;
            }
        }
        $product_id = Product::insertGetId([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'category_slug' => Category::find($request->category_id)->slug,
            'section_id' => Category::find($request->category_id)->section_id,
            'admin_id' => Auth::guard('admin')->user()->id,
            'product_multiple_image' => json_encode($images),
            'product_description' => $request->product_description,
            'brand_id' => $request->brand_id,
            'slug' => $request->slug,
            'price' => $request->price,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'product_code' => $request->product_code,
            'product_mpn' => $request->product_mpn,
            'regular_price' => $request->regular_price,
            'product_stock' => $request->product_stock,
            'component_id' => $request->component_id,
            'support' => $request->support,
            'processor' => $request->processor,
            'offer_id' => $request->offer_id,
            'offer_percent' => $request->offer_percent,
            'previous_price' => $request->previous_price,
            'created_at' => Carbon::now(),
            'status' => 1,
        ]);
        foreach ($request->header as $value) {
            if (!empty($value)) {
                $header = new SpecificationHeader;
                $header->product_id = $product_id;
                $header->header = $value;
                $header->save();
            }
        }

        // main photo upload start
        $uploaded_main_product_img = $request->file('main_image');
        $product_main_img_name = $product_id . "." . $uploaded_main_product_img->extension();
        $product_main_img_location = base_path('public/backend/uploads/product_main_image/' . $product_main_img_name);
        Image::make($uploaded_main_product_img)->resize(480, 480)->save($product_main_img_location);

        Product::find($product_id)->update([
            'main_image' => $product_main_img_name
        ]);

        return redirect('/admin/products')->with('success', "Product Added Successfully !!");
    }
    /*========================================================
    ||       add product and upload with images end         ||
    ==========================================================*/

    /*==============================================================
    ||                 single product view start                  ||
    ================================================================*/
    public function ProductDetails($id){
        $productDetails = Product::with('productFetures')->with('filterItems')->find($id);
        $productDetails = json_decode(json_encode($productDetails, true), true);

        $specification_header = SpecificationHeader::where('product_id', $id)->with('titeldescription')->get();

        $multiple_images = json_decode($productDetails['product_multiple_image']);
        return view('backend.layouts.product.product_details', compact('productDetails', 'multiple_images', 'specification_header'));
    }
    /*==============================================================
    ||                 single product view end                    ||
    ================================================================*/

    /*==============================================================
    ||         product edit form and pass categories start        ||
    ================================================================*/

    public function ProductEdit($id){
        //Section with Categories and SubCategories
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories), true);
        $product_edit = Product::find($id);
        $brands = Brand::where('status', 1)->get();
        $brands = json_decode(json_encode($brands, true), true);
        $allComponents = PCComponent::get();
        $offers = Offer::get();
        return view('backend.layouts.product.product_edit', compact('product_edit', 'categories', 'brands', 'allComponents', 'offers'));
    }
    /*==============================================================
    ||         product edit form and pass categories end          ||
    ================================================================*/

    /*==============================================================
    ||                   product update start                     ||
    ================================================================*/
    public function ProductUpdate(Request $request){

        $product = Product::find($request->product_id);
        $multiple_images = json_decode($product->product_multiple_image);
        //main photo upload start
        if(!empty($request->hasFile('main_image'))){
            $uploaded_main_product_img = $request->file('main_image');
            $product_main_img_name = $request->product_id . "." . $uploaded_main_product_img->extension();
            $product_main_img_location = base_path('public/backend/uploads/product_main_image/' . $product_main_img_name);
            Image::make($uploaded_main_product_img)->resize(480, 480)->save($product_main_img_location);

            Product::find($request->product_id)->update([
                'main_image' => $product_main_img_name
            ]);
        }
        // multiple photo upload start
        if (!empty($request->hasFile('product_multiple_image'))){

            //delete previous multiple images
            foreach ($multiple_images as $image) {
                @unlink(base_path() . '/public/backend/uploads/product/' . $image);
            }
            $images = [];

                $flag = 0;
                foreach ($request->file('product_multiple_image') as $file) {
                    //get image extension
                    $new_product_img_name = rand(111, 99999) . $flag . "." . $file->extension();
                    //set image location
                    $product_img_location = base_path('public/backend/uploads/product/' . $new_product_img_name);
                    //Upload the image
                    Image::make($file)->resize(480, 480)->save($product_img_location);
                    //update the image name in database
                    $images[] = $new_product_img_name;

                    $flag++;
                }
                Product::find($request->product_id)->update(['product_multiple_image' => json_encode($images)]);
            }
        // multiple photo upload end
        if(!empty($request->header)){
            foreach ($request->header as $value) {
                if (!empty($value)) {
                    $header = new SpecificationHeader;
                    $header->product_id = $request->product_id;
                    $header->header = $value;
                    $header->save();
                }
            }
        }


        Product::find($request->product_id)->update([
        'product_name'=> $request->product_name,
        'category_id'=> $request->category_id,
        'category_slug'=>Category::find($request->category_id)->slug,
        'section_id' => Category::find($request->category_id)->section_id,
        'product_description' => $request->product_description,
        'updated_admin_id' => Auth::guard('admin')->user()->id,
        'brand_id' => $request->brand_id,
        'price'=> $request->price,
        'slug'=> $request->slug,
        'meta_description'=> $request->meta_description,
        'meta_title' => $request->meta_title,
        'meta_keywords'=> $request->meta_keywords,
        'product_code'=>$request->product_code,
        'product_mpn'=>$request->product_mpn,
        'regular_price'=>$request->regular_price,
        'product_stock'=>$request->product_stock,
        'component_id' => $request->component_id,
        'support' => $request->support,
        'processor' => $request->processor,
        'offer_id' => $request->offer_id,
        'offer_percent' => $request->offer_percent,
        'previous_price' => $request->previous_price,
        ]);

        $message = 'Product Updated Successfully !!';
        return back()->with('success', $message);
    }
    /*==============================================================
    ||                   product update end                       ||
    ================================================================*/

    /*==============================================================
    ||  product and image delete using jquery sweet alert start   ||
    ================================================================*/
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $multiple_images = json_decode($product->product_multiple_image);

        $productFiltering = FilteringItem::where('product_id', $id)->get();
        $productFiltering = json_decode(json_encode($productFiltering, true), true);

        $productFeature = ProductFetures::where('product_id', $id)->get();
        $productFeature = json_decode(json_encode($productFeature, true), true);

        $specificationHeader = SpecificationHeader::where('product_id', $id)->get();
        $specificationHeader = json_decode(json_encode($specificationHeader, true), true);

        $specification = TitleDescOfSpecification::where('product_id', $id)->get();
        $specification = json_decode(json_encode($specification, true), true);

        $multiple_images = json_decode($product->product_multiple_image);

        if (file_exists(base_path() . '/public/backend/uploads/product_main_image/' . $product->main_image)) {
            @unlink(base_path() . '/public/backend/uploads/product_main_image/' . $product->main_image);
            foreach ($multiple_images as $image) {
                @unlink(base_path() . '/public/backend/uploads/product/' . $image);
            }
            foreach($productFiltering as $value){
                FilteringItem::where('product_id', $value['product_id'])->delete();
            }

            foreach ($productFeature as $value) {
                ProductFetures::where('product_id', $value['product_id'])->delete();
            }
            foreach ($specification as $value) {
                TitleDescOfSpecification::where('product_id', $value['product_id'])->delete();
            }
            foreach ($specificationHeader as $value) {
                SpecificationHeader::where('product_id', $value['product_id'])->delete();
            }

            $product->delete();
            $message = "Product Delete Successfully !!";
            return back()->with('success', $message);
        }
    }
    /*==============================================================
    ||  product and image delete using jquery sweet alert end     ||
    ================================================================*/

    /*=======================================================================
    ||add product attributes like short desc, features, specification start||
    ========================================================================*/
    public function addProductAllSpecification(Request $request, $id){

        if($request->isMethod('post')){
            $data = $request->all();

            if(!empty($data['variant_id'])){
                if (FilteringItem::where('product_id', $id)->where('variant_id', $data['variant_id'])->exists()) {
                    $message = 'This item is alrady exists in this product !!';
                    return back()->with('error', $message);
                }else{
                    foreach ($data['variant_id'] as $value) {
                        if (!empty($value)) {

                            $filtering_item = new FilteringItem;
                            $filtering_item->product_id = $id;
                            $filtering_item->category_id = $data['category_id'];;
                            $filtering_item->category_slug = $data['category_slug'];
                            $filtering_item->variant_id = $value;
                            $filtering_item->save();
                        }
                    }

                }

                foreach ($data['title'] as $key => $value) {
                    if (!empty($value)) {
                        $short_description = new TitleDescOfSpecification;
                        $short_description->product_id = $id;
                        $short_description->header_id = $data['header_id'];
                        $short_description->title = $data['title'][$key];
                        $short_description->description = $data['description'][$key];
                        $short_description->save();
                    }
                }

                foreach ($data['fetures'] as $key => $value) {
                    if (!empty($value)) {
                        $product_fetures = new ProductFetures;
                        $product_fetures->product_id = $id;
                        $product_fetures->fetures = $data['fetures'][$key];
                        $product_fetures->status = 1;
                        $product_fetures->save();
                    }
                }

                $message = 'Product Attributes added Successfully !!';
                return back()->with('features', $message);
            }else{
                foreach ($data['title'] as $key => $value) {
                    if (!empty($value)) {
                        $short_description = new TitleDescOfSpecification;
                        $short_description->product_id = $id;
                        $short_description->header_id = $data['header_id'];
                        $short_description->title = $data['title'][$key];
                        $short_description->description = $data['description'][$key];
                        $short_description->save();
                    }
                }
                foreach ($data['fetures'] as $key => $value) {
                    if (!empty($value)) {
                        $product_fetures = new ProductFetures;
                        $product_fetures->product_id = $id;
                        $product_fetures->fetures = $data['fetures'][$key];
                        $product_fetures->status = 1;
                        $product_fetures->save();
                    }
                }
                $message = 'Product Attributes added Successfully !!';
                return back()->with('features', $message);
            }

        }

        $productDetails = Product::select('id','product_name','category_id','category_slug')->with('productFetures')->with('filterItems')->find($id);
        $productDetails = json_decode(json_encode($productDetails, true), true);

        // echo "<pre>"; print_r($productDetails); die;
        $get_product_category_id = Product::select('category_id')->find($id);

        $get_ItemType_and_variant = ProductType::where('category_id', $get_product_category_id->category_id)->with('itemParts')->get();

        $specification_header = SpecificationHeader::where('product_id', $id)->get();

        return view('backend.layouts.product.product_all_specification', compact('productDetails', 'get_ItemType_and_variant','id', 'specification_header'));
    }
    /*=======================================================================
    ||add product attributes like short desc, features, specification end  ||
    ========================================================================*/

    /*==============================================================
    ||              product specification edit start              ||
    ================================================================*/
    public function editSpecificationHeader(Request $request, $id) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach ($data['header'] as $key => $specificationHeader) {
                if (!empty($specificationHeader)) {
                    SpecificationHeader::where(['id' => $data['header_id'][$key]])->update([
                        'header' => $data['header'][$key],
                    ]);
                }
            }
            $message = 'Specification Header Updated Successfully !!';
            return back()->with('features', $message);
        }
    }
    /*==============================================================
    ||              product specification edit end                ||
    ================================================================*/

    /*==============================================================
    ||              product specification edit start              ||
    ================================================================*/
    public function editSpecification(Request $request, $id) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach ($data['title'] as $key => $productSpecification) {
                if (!empty($productSpecification)) {
                    TitleDescOfSpecification::where(['id' => $data['specificatation_id'][$key]])->update([
                        'title' => $data['title'][$key],
                        'description' => $data['description'][$key]
                    ]);
                }
            }
            $message = 'Product Specification Updated Successfully !!';
            return back()->with('features', $message);
        }
    }
    /*==============================================================
    ||              product specification edit end                ||
    ================================================================*/

    /*==============================================================
    ||                 product feature edit start                 ||
    ================================================================*/
    public function editFeture(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach ($data['product_feture_id'] as $key => $productFeture) {
                if (!empty($productFeture)) {
                    ProductFetures::where(['id' => $data['product_feture_id'][$key]])->update([
                        'fetures' => $data['fetures'][$key]
                    ]);
                }
            }
            $message = 'Product Feature Updated Successfully !!';
            return back()->with('features', $message);
        }
    }
    /*==============================================================
    ||                     product feature edit end               ||
    ================================================================*/


    /*=================================================================
    ||   product Feature delete using jquery sweet alert start       ||
    ====================================================================*/
    public function deleteProductFeature($id)
    {
        $productFeature = ProductFetures::find($id);

        $productFeature->delete();
        $message = "Feature Deleted Successfully !!";
        return back()->with('features', $message);
    }
    /*===============================================================
    ||   product Feature delete using jquery sweet alert end       ||
    =================================================================*/
    /*=================================================================
    ||   product Feature delete using jquery sweet alert start       ||
    ====================================================================*/
    public function deleteProductSpecification($id)
    {
        $specification = TitleDescOfSpecification::find($id);

        $specification->delete();
        $message = "Specification Deleted Successfully !!";
        return back()->with('features', $message);
    }
    /*===============================================================
    ||   product Feature delete using jquery sweet alert end       ||
    =================================================================*/

    public function deleteProductFilterItem($id){
        $productFilterItem = FilteringItem::find($id);
        $productFilterItem->delete();
        $message = "Variant Deleted Successfully !!";
        return back()->with('features', $message);
    }

    public function deleteHeader($id){
        if (TitleDescOfSpecification::where('header_id', '=', $id)->exists()) {
            $message = "Sorry you can't delete this coz this header dconected with some specification !!";
            return back()->with('error', $message);
        }else{
            $header = SpecificationHeader::find($id);
            $header->delete();
            $message = "Header Deleted Successfully !!";
            return back()->with('features', $message);
        }
    }
}
