<?php

namespace App\Http\Controllers\Dashboard;

use App\Section;
use App\PCComponent;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PCBuildComponentController extends Controller
{
    public function pcBuildComponent(){
        //Section with Categories and SubCategories
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories), true);
        $allComponents = PCComponent::get();
        return view('backend.layouts.pcBuild.pc_build_component', compact('categories', 'allComponents'));
    }

    public function addPcComponent(Request $request){
        // PCComponent
        PCComponent::create([
            'component_name' => $request->component_name,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'PC Component Created Successfully !!');
    }
    public function editPcComponent($id){
        $pcComponent = PCComponent::find($id);
       return view('backend.layouts.pcBuild.editPcComponent', compact('pcComponent'));
    }
    public function updatePcComponent(Request $request){
        PCComponent::find($request->component_id)->update([
            'component_name'=>$request->component_name
        ]);
        return back()->with('success','PC Component Updated Successfully !!');
    }
    public function deletePcComponent($id){
        if(Product::where('component_id', $id)->exists()){
            return back()->with('error', 'This component is already added in some products !!');
        }else{
            PCComponent::find($id)->delete();
        }
    }
}
