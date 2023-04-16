<?php

namespace App\Http\Controllers\Dashboard;

use App\CourseCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $allCategory = CourseCategory::get();
        return view('backend.layouts.course_category.course_category', compact('allCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.layouts.course_category.add_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name'=> 'required'
        ]);
        CourseCategory::create([
           'category_name'=> $request->category_name,
           'slug'=> $request->slug
        ]);
        return back()->with('success', "Category Added Successfully !!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = CourseCategory::find($id);
        return  view('backend.layouts.course_category.edit_category', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
           'category_name'=> 'required'
        ]);
        CourseCategory::find($id)->update([
            'category_name'=> $request->category_name,
            'slug'=> $request->slug
        ]);
        return redirect()->route('course-category.index')->with('success', "Category Updated Successfully !!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CourseCategory::where('id', $id)->delete();
        return back()->with('success', 'Category deleted successfully');
    }
}
