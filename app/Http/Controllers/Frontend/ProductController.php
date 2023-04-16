<?php

namespace App\Http\Controllers\Frontend;

use App\Brand;
use App\Product;
use App\Section;
use App\Category;
use App\FilteringItem;
use App\ProductFetures;
use App\ProductAttributes;
use App\SpecificationHeader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{
    public function listing(Request $request, $slug)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // $slug = Route::getFacadeRoot()->current()->uri();
            $slug = $data['slug'];
            $categoryCount = Category::where(['slug' => $slug, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $categoryDetails = Category::categoryDetails($slug);
                // echo "<pre>"; print_r($categoryDetails); die;
                $categoryProducts = Product::whereIn('category_id', $categoryDetails['catIds'])->where('status', 1)->with('brand')->with('productFetures')->with('filterItems');
                if(isset($data['filter_id']) && !empty($data['filter_id'])){
                   $filterItem = FilteringItem::whereIn('variant_id', $data['filter_id'])->get();

                   $collect = collect($filterItem);
                //    $filterItem_collect = $collect->unique('product_id');
                    // print_r($collect->pluck('product_id')); die;

                    // $allid = "";
                    // foreach($collect as $getproduct_id){
                    //      $allid .=  $getproduct_id->product_id;
                    //     }

                    // $product_all_id  = array_map('intval', str_split($allid));
                    $categoryProducts->whereIn('id', $collect->pluck('product_id'))->get();

                }
                //if Sort option selected by user
                if (isset($data['sort']) && !empty($data['sort'])) {
                    if ($data['sort'] == "latest_products") {
                        $categoryProducts->orderBy('id', 'Desc');
                    } elseif ($data['sort'] == "product_name_a_z") {
                        $categoryProducts->orderBy('product_name', 'Asc');
                    } elseif ($data['sort'] == "product_name_z_a") {
                        $categoryProducts->orderBy('product_name', 'Desc');
                    } elseif ($data['sort'] == "lowest_to_highest") {
                        $categoryProducts->orderBy('price', 'Asc');
                    } elseif ($data['sort'] == "highest_to_highest") {
                        $categoryProducts->orderBy('price', 'Desc');
                    }
                } else {
                    $categoryProducts->orderBy('id', 'Asc');
                }
                $categoryProductCount = $categoryProducts->count();
                $categoryProducts = $categoryProducts->paginate(2000);

                return view('Frontend.layouts.product.ajax_product_list', compact('categoryDetails', 'categoryProducts', 'categoryProductCount', 'slug'));
            } else {
                abort(404);
            }
        } else {
            // $slug = Route::getFacadeRoot()->current()->uri();
            $categoryCount = Category::where(['slug' => $slug, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $categoryDetails = Category::categoryDetails($slug);

                $categoryProducts = Product::whereIn('category_id', $categoryDetails['catIds'])->where('status', 1)->with('brand')->with('productFetures')->with('filterItems');

                $categoryProductCount = $categoryProducts->count();
                $categoryProducts = $categoryProducts->paginate(2000);

                $category_id = Category::where('slug', $slug)->value('id');
                $subcategories = Category::where('parent_id', $category_id )->where('status',1)->get();

                return view('Frontend.layouts.product.all_product_list', compact('categoryDetails', 'categoryProducts', 'categoryProductCount', 'slug', 'subcategories'));
            } else {
                abort(404);
            }
        }
    }


    public function productDetails($slug){
        $product_info = Product::where('slug', $slug)->first();
        $multiple_image = json_decode($product_info->product_multiple_image);
        // print_r($multiple_image); die;
        $related_product = Product::where('category_id', $product_info->category_id)->where('id', '!=', $product_info->id)->limit(3)->get();
        // echo "<pre>"; print_r($related_product); die;
        $specification_header = SpecificationHeader::where('product_id', $product_info->id)->with('titeldescription')->get();
        $product_features = ProductFetures::where('product_id', $product_info->id)->get();
        $productReviews = Review::where('product_id', $product_info->id)->where('status', 1)->orderBy('id', 'DESC')->get();
        $review_count= count($productReviews);

        //array variable initialization
        $allStars= [];
        $flag=0;
        //geting this product review rating
        foreach($productReviews as $review){
            $allStars[] = $review->rating;
            $flag++;
        }
        // highest value in all rating
        $print_star = 0;
        foreach($allStars as $key=>$val){
            if($val > $print_star){
                $print_star = $val;
            }
        }

        return view('Frontend.layouts.product.product_details', compact('product_info', 'multiple_image', 'specification_header', 'product_features', 'related_product', 'productReviews', 'review_count', 'print_star'));
    }

    public function sectionProduct($section_slug)
    {
        $section_id = Section::where('slug', $section_slug)->value('id');
        $section_description = Section::where('slug', $section_slug)->first();
        $allProducts = Product::where('section_id', $section_id)->get();
        $productCount = $allProducts->count();
        $sectionUnderCategories = Category::where('section_id', $section_id)->where('parent_id', 0)->get();
        return view('Frontend.layouts.product.sectionUnderProduct', compact('allProducts', 'productCount', 'sectionUnderCategories', 'section_id', 'section_description'));
    }

    public function brandProduct($slug){
        $brand_id = Brand::where('slug', $slug)->value('id');
        $allProducts = Product::where('status', 1)->where('brand_id', $brand_id)->get();
        $productCount = $allProducts->count();
        return view('Frontend.layouts.product.brand_product',compact('allProducts', 'productCount'));
    }

}
