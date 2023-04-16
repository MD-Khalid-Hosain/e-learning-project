<?php

namespace App\Http\Controllers\Dashboard;

use App\Product;
use App\Section;
use App\ItemPart;
use App\ProductType;
use App\FilteringItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemPartsController extends Controller
{
    public function productTypeParts(){
        $allParts = ItemPart::get();
        $categories = Section::with('categories')->get();
        $allItemNames = ProductType::get();
        $title = "Add Item Parts Variant";
        return view('backend.layouts.filtering.itemParts', compact('categories', 'allItemNames', 'title', 'allParts'));
    }

    public function addProductTypeParts(Request $request){
        if (ItemPart::where('category_id', $request->category_id)->where('item_type_id', $request->item_type_id)->where('item_parts_variant', $request->item_parts_variant)->exists()) {
            return back()->with('status', 'This variant is alrady included in this category!!');
        }else{
            ItemPart::create([
                'category_id' => $request->category_id,
                'item_type_id' => $request->item_type_id,
                'item_parts_variant' => $request->item_parts_variant
            ]);

            $message = "Product Type Parts Created Successfully !!";
            return back()->with('success', $message);

        }

    }

    public function editItemParts($id){
        $itemParts = ItemPart::find($id);
          //Section with Categories and SubCategories
          $categories = Section::with('categories')->get();
          $title = "Edit Item Parts";
          return view('backend.layouts.filtering.edit_Item_parts', compact('categories','itemParts','title'));
    }

    public function updateItemParts(Request $request){
        $request->validate([
            'category_id'=> 'required',
            'item_type_id'=> 'required',
            'item_parts_variant'=>'required',
        ]);
        ItemPart::find($request->item_parts_id)->update([
            'category_id'=> $request->category_id,
            'item_type_id'=>$request->item_type_id,
            'item_parts_variant'=>$request->item_parts_variant,
        ]);
        $message = "Item Parts Updated Successfully !!";
           return back()->with('success', $message);
    }


    public function getItemType(Request $request){
        $itemTypes = ProductType::where('category_id', $request->category_id)->get();
        $itemTypes_send = "";
        foreach($itemTypes as $itemType){
            // echo $itemType->item_type_name;
            $itemTypes_send.="<option value='". $itemType->id."'>".$itemType->item_type_name."</option>";
        }
        return $itemTypes_send;
    }

    public function itemPartsDelete($id){
        if (FilteringItem::where('variant_id', $id)->exists()) {
            $message = 'This Item Part is included in some products !!';
            return back()->with('error', $message);
        }else{
            ItemPart::find($id)->delete();
            $message = "Item Parts Deleted Successfully !!";
            return back()->with('success', $message);
        }
    }


}
