<?php

namespace App;

use App\Section;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function subcategories(){
        return $this->hasMany('App\Category', 'parent_id')->where('status',1);
    }

    public function section(){
        return $this->belongsTo('App\Section','section_id')->select('id','section_name');
    }
    public function itemTypes(){
        return $this->hasMany('App\ProductType', 'category_id');
    }
    public function itemParts()
    {
        return $this->hasMany('App\ItemPart', 'category_id');
    }

    public function parentcategory(){
        return $this->belongsTo('App\Category','parent_id')->select('id','category_name','section_id');
    }
    public static function categoryDetails($slug)
    {
        $categoryDetails = Category::with('subcategories')->with('itemTypes')->where('slug', $slug)->first()->toArray();

        if($categoryDetails['parent_id']==0){
            $breadcrumbs = '<i class="fa fa-caret-right" aria-hidden="true"></i><a href="' . route('section-menu', Section::where('id', $categoryDetails['section_id'])->value('slug')) . '">' . strtolower(Section::where('id', $categoryDetails['section_id'])->value('section_name')) . '</a><li><i class="fa fa-caret-right" aria-hidden="true"></i><a href="'. route('header-menu', $categoryDetails['slug']).'">'. strtolower($categoryDetails['category_name']).'</a></li>';
        }else{
            $parentCategory = Category::select('category_name', 'slug', 'section_id')->where('id', $categoryDetails['parent_id'])->first()->toArray();

            $breadcrumbs = '<a href="' . route('section-menu', Section::where('id', $parentCategory['section_id'])->value('slug')) . '">' . strtolower(Section::where('id', $parentCategory['section_id'])->value('section_name')) . '</a><li><i class="fa fa-caret-right" aria-hidden="true"></i><a href="' . route('header-menu', $parentCategory['slug']) . '">' . strtolower($parentCategory['category_name']) . '</a></li> <li><i class="fa fa-caret-right" aria-hidden="true"></i><a href="' . route('header-menu', $categoryDetails['slug']) . '">' . strtolower($categoryDetails['category_name']) . '</a></li>';
        }

        $catIds = array();
        $catIds[] = $categoryDetails['id'];
        foreach($categoryDetails['subcategories'] as $key => $subcat){
            $catIds[] = $subcat['id'];
        }
        return array('catIds'=>$catIds, 'categoryDetails'=> $categoryDetails, 'breadcrumbs' => $breadcrumbs);
    }
}
