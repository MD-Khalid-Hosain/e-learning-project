<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\Brand;
use App\Product;
use App\Category;
use Carbon\Carbon;
use App\PCComponent;
use App\ComponentProducts;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;


class PcBuildController extends Controller
{
    public function pcBuild(Request $request){
        $all_pcBuild_product = ComponentProducts::all();
        foreach ($all_pcBuild_product as $all) {
            $all::where('created_at', '!=', Carbon::now()->toDateString())->delete();
        }
        $allComponents = PCComponent::get();
        $session_id = Session::get('session_id');
        return view('Frontend.layouts.pcBuild.pc_build', compact('allComponents', 'session_id'));
    }

    public function componentProduct($component_id){

        // $categoryDetails = Category::categoryDetails($slug);
        // $component_product = Product::whereIn('category_id', $categoryDetails['catIds'])->where('status', 1)->where('product_stock', 'In Stock')->with('brand')->with('productFetures')->with('filterItems')->get();
        if($component_id == 1){

                $component_id = $component_id;
                $component_product = QueryBuilder::for(Product::class)
                ->allowedFilters('product_name')
                ->where('component_id', $component_id);
                $component_product_count = $component_product->count();
                $component_product = $component_product->paginate(2000);

                return view('Frontend.layouts.pcBuild.componentProducts', compact('component_product', 'component_product_count', 'component_id'));
        } elseif($component_id == 2){
            if(ComponentProducts::where('component_id', 1)->where('session_id', Session::get('session_id'))->exists()){
                if (ComponentProducts::where('component_id', 1)->where('session_id', Session::get('session_id'))->value('brand') == 'intel') {
                    $component_id = $component_id;
                    $component_product = QueryBuilder::for(Product::class)
                    ->allowedFilters('product_name')
                    ->where('component_id', $component_id)
                    ->where('processor', 'intel');
                    $component_product_count = $component_product->count();
                    $component_product = $component_product->paginate(2000);

                    return view('Frontend.layouts.pcBuild.componentProducts', compact('component_product', 'component_product_count', 'component_id'));
                } else {
                    $component_id = $component_id;
                    $component_product = QueryBuilder::for(Product::class)
                    ->allowedFilters('product_name')
                    ->where('component_id', $component_id)
                    ->where('processor', 'amd');
                    $component_product_count = $component_product->count();
                    $component_product = $component_product->paginate(2000);

                    return view('Frontend.layouts.pcBuild.componentProducts', compact('component_product', 'component_product_count', 'component_id'));
                }
            }else{
                return back()->with('message', 'Please at First Select a Processor !!');
            }


        }elseif ($component_id == 3) {
            if (ComponentProducts::where('component_id', 2)->where('session_id', Session::get('session_id'))->exists()) {
                if (ComponentProducts::where('component_id', 2)->where('session_id', Session::get('session_id'))->value('support') == 'ddr3') {
                    $component_id = $component_id;
                    $component_product = QueryBuilder::for(Product::class)
                    ->allowedFilters('product_name')
                    ->where('component_id', $component_id)
                    ->where('support', 'ddr3');
                    $component_product_count = $component_product->count();
                    $component_product = $component_product->paginate(2000);

                    return view('Frontend.layouts.pcBuild.componentProducts', compact('component_product', 'component_product_count', 'component_id'));
                } elseif(ComponentProducts::where('component_id', 2)->where('session_id', Session::get('session_id'))->value('support') == 'ddr4'){
                    $component_id = $component_id;
                    $component_product = QueryBuilder::for(Product::class)
                    ->allowedFilters('product_name')
                    ->where('component_id', $component_id)
                    ->where('support', 'ddr4');
                    $component_product_count = $component_product->count();
                    $component_product = $component_product->paginate(2000);

                    return view('Frontend.layouts.pcBuild.componentProducts', compact('component_product', 'component_product_count', 'component_id'));
                }else{
                    $component_id = $component_id;
                    $component_product = QueryBuilder::for(Product::class)
                    ->allowedFilters('product_name')
                    ->where('component_id', $component_id)
                    ->where('support', 'ddr5');
                    $component_product_count = $component_product->count();
                    $component_product = $component_product->paginate(2000);

                    return view('Frontend.layouts.pcBuild.componentProducts', compact('component_product', 'component_product_count', 'component_id'));
                }
            }else{
                return back()->with('message', 'Please at First Select a Motherboard !!');
            }

        } elseif ($component_id == 4) {
                $component_id = $component_id;
                $component_product = QueryBuilder::for(Product::class)
                ->allowedFilters('product_name')
                ->where('component_id', $component_id)
                ->where('support', 'ssd');
                $component_product_count = $component_product->count();
                $component_product = $component_product->paginate(2000);
                return view('Frontend.layouts.pcBuild.componentProducts', compact('component_product', 'component_product_count', 'component_id'));

        } elseif ($component_id == 5) {
            $component_id = $component_id;
            $component_product = QueryBuilder::for(Product::class)
                ->allowedFilters('product_name')
                ->where('component_id', $component_id)
                ->where('support', 'hdd');
            $component_product_count = $component_product->count();
            $component_product = $component_product->paginate(2000);
            return view('Frontend.layouts.pcBuild.componentProducts', compact('component_product', 'component_product_count', 'component_id'));
        }else{
            $component_id = $component_id;
            $component_product = QueryBuilder::for(Product::class)
                ->allowedFilters('product_name')
                ->where('component_id', $component_id);
            $component_product_count = $component_product->count();
            $component_product = $component_product->paginate(2000);

            return view('Frontend.layouts.pcBuild.componentProducts', compact('component_product', 'component_product_count', 'component_id'));
        }


    }

    public function addToPcBuild(Request $request){

        $session_id = Session::get('session_id');
        if (empty($session_id)) {
            $session_id = Session::getId();
            Session::put('session_id', $session_id);
        }
        if(ComponentProducts::where('component_id', $request->component_id)->where('session_id', $session_id)->exists()){
            ComponentProducts::find(ComponentProducts::where('component_id', $request->component_id)->where('session_id', $session_id)->value('id'))->update([
                'product_id' => $request->product_id,
                'brand' => $request->processor,
                'support' => Product::where('id', $request->product_id)->value('support'),
            ]);
        }else{

            ComponentProducts::create([
                'component_id' => $request->component_id,
                'product_id' => $request->product_id,
                'brand' => $request->processor,
                'support' => Product::where('id', $request->product_id)->value('support'),
                'session_id' => $session_id,
                'created_at' => Carbon::now()->toDateString(),
                'updated_at' => null,
            ]);
        }
        return redirect('/pc-build');
    }

    public function removeComponentProduct($id){

        ComponentProducts::find($id)->delete();
        return back()->with('success', 'Component Remove successfully!!');
        /*==============================================================================================================================
            trying delete with ajax but there is a problem if there is more than one component than one remove but other is not deleted
        *==============================================================================================================================*/
        // if ($request->ajax()) {
        //     $data = $request->all();
        //     // echo $data['pcbuildid']; die;
        //     ComponentProducts::find($data['pcbuildid'])->delete();
        //     $allComponents = PCComponent::get();
        //     $session_id = Session::get('session_id');
        //     $all_pcBuild_product = ComponentProducts::all();
        //     foreach ($all_pcBuild_product as $all) {
        //         $all::where('created_at', '!=', Carbon::now()->toDateString())->delete();
        //     }
        //     return response()->json([
        //         'view'=>(String)View::make('Frontend.layouts.pcBuild.pc_build_table')->with(compact('allComponents', 'session_id'))
        //     ]);
        // }


    }

    public function printPcBuild($session_id){

        $pcBuildProduct = ComponentProducts::select('id', 'session_id', 'component_id', 'product_id')
                        ->where('session_id', $session_id)
                        ->orderBy('component_id', 'asc')
                        ->get();

        $order_pdf = PDF::loadView('Frontend.layouts.pcBuild.pdfDownload', compact('pcBuildProduct'));

        return $order_pdf->download('myPCBuild.pdf');

    }

    public function addToCart(){
        $session_id = Session::get('session_id');

        $allProducts = ComponentProducts::where('session_id', $session_id)->get();

        $flag=0;
        foreach($allProducts as $products){
            if (Cart::where('session_id', $session_id)->where('product_id', $products->product_id)->exists()) {
                Cart::where('session_id', $session_id)->where('product_id', $products->product_id)->increment('product_quantity', 1);
            }else{
                Cart::create([
                    'product_id' => $products->product_id,
                    'category_id' => Product::where('id', $products->product_id)->value('category_id'),
                    'product_quantity' => 1,
                    'session_id' => $session_id,
                    'created_at' => Carbon::now()->toDateString(),
                ]);
            }

        $flag++;
        }
        return back();

    }
}
