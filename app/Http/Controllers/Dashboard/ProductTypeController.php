<?php

namespace App\Http\Controllers\Dashboard;

use App\Section;
use App\ItemPart;
use App\ProductType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductTypeController extends Controller
{
    public function productType(){
        //Section with Categories and SubCategories
        $categories = Section::with('categories')->get();
        $allItemNames = ProductType::get();
        $title = "Add Item Type";
        return view('backend.layouts.filtering.product_type', compact('categories', 'allItemNames', 'title'));
    }

    public function addProductType(Request $request){
        if (ProductType::where('category_id', $request->category_id)->where('item_type_name', $request->item_type_name)->exists()) {
            return back()->with('status', 'This Item is alrady included in this category!!');
        }else{
            ProductType::create([
                'category_id' => $request->category_id,
                'item_type_name' => $request->item_type_name
            ]);
            $message = "Product Type Created Successfully !!";
            return back()->with('success', $message);

        }

    }

    public function deleteitemTypeDelete($id){
        if (ItemPart::where('item_type_id', '=', $id)->exists()) {
            $message = "Sorry You Can't delete this coz Already Some Parts are Connected with This Item";
            return back()->with('error', $message);
        }else{

            ProductType::find($id)->delete();
           $message = "Product Type Deleted Successfully !!";
           return back()->with('success', $message);
        }
    }

    public function editType($id){
        $itemType = ProductType::find($id);
          //Section with Categories and SubCategories
          $categories = Section::with('categories')->get();
          $title = "Edit Item Type";
          return view('backend.layouts.filtering.edit_Item_type', compact('categories','itemType','title'));
    }

    public function itemTypeUpdate(Request $request){
        ProductType::find($request->itemType_id)->update([
            'category_id'=> $request->category_id,
            'item_type_name'=>$request->item_type_name,
        ]);
        $message = "Item Type Updated Successfully !!";
           return back()->with('success', $message);

    }
}
