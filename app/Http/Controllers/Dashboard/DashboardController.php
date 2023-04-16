<?php

namespace App\Http\Controllers\Dashboard;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * It will show the dashboard index
     */

    public function index()
    {
        $alladmin = Admin::where('type', 'user')->get();
        return view('backend.layouts.index', compact('alladmin'));
    }
}
