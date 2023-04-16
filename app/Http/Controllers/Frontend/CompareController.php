<?php

namespace App\Http\Controllers\Frontend;

use App\Compare;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class CompareController extends Controller
{

    public function compare()
    {
        $compareProducts = Compare::get();
        return view('Frontend.layouts.compare.compare_page', compact('compareProducts'));
    }

    public function addCompare(Request $request){
        $session_id = Session::get('session_id');
        if (empty($session_id)) {
            $session_id = Session::getId();
            Session::put('session_id', $session_id);
        }

        Compare::create([
                        'product_id' => $request->product_id,
                        'category_id' => $request->category_id,
                        'session_id' => Session::get('session_id'),
                        'created_at' => Carbon::now()->toDateString(),
        ]);
        return back();
    }
}
