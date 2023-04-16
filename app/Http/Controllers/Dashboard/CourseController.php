<?php

namespace App\Http\Controllers\Dashboard;

use App\Course;
use App\CourseCategory;
use App\CourseEnroll;
use App\CourseLesson;
use App\CourseReview;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allCourse = Course::get();
        return view('backend.layouts.course.show_all_courses', compact('allCourse'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCategory = CourseCategory::get();
        return view('backend.layouts.course.add_course_form', compact('allCategory'));
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
            'title'=> 'required',
            'short_description'=> 'required',
            'description'=> 'required',
            'outcomes'=> 'required',
            'requirement'=> 'required',
            'language'=> 'required',
            'level'=> 'required',
            'thumbnail'=> 'required|image',
            'slug'=> 'required',
            'video_url'=> 'required|url',
            'category_id'=> 'required',
        ]);
        $course_id = Course::insertGetId([
            'title'=> $request->title,
            'short_description'=> $request->short_description,
            'description'=> $request->description,
            'outcomes'=> $request->outcomes,
            'requirement'=> $request->requirement,
            'language'=> $request->language,
            'level'=> $request->level,
            'thumbnail'=> 'thumbnail.jpg',
            'slug'=> $request->slug,
            'video_url'=> $request->video_url,
            'category_id'=> $request->category_id,
        ]);

        // main photo upload start
        $uploaded_main_img = $request->file('thumbnail');
        $main_img_name = $course_id ."course". "." . $uploaded_main_img->extension();
        $main_img_location = base_path('public/backend/course/' . $main_img_name);
        Image::make($uploaded_main_img)->resize(480, 480)->save($main_img_location);

        Course::find($course_id)->update([
            'thumbnail' => $main_img_name
        ]);
        return redirect()->route('course.index')->with('success', 'New Course Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Course::find($id);
        $allCategory = CourseCategory::get();
        return view('backend.layouts.course.edit_course', compact('data', 'allCategory'));
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
        $data = Course::find($id);
        //main photo upload start
        if(!empty($request->hasFile('thumbnail'))){
            @unlink(base_path() . '/public/backend/course/' . $data->thumbnail);
            $uploaded_main_img = $request->file('thumbnail');
            $main_img_name = $id ."course". "." . $uploaded_main_img->extension();
            $main_img_location = base_path('public/backend/course/' . $main_img_name);
            Image::make($uploaded_main_img)->resize(480, 480)->save($main_img_location);

            Course::find($id)->update([
                'thumbnail' => $main_img_name
            ]);
        }
        $course = Course::find($id)->update([
            'title'=> $request->title,
            'short_description'=> $request->short_description,
            'description'=> $request->description,
            'outcomes'=> $request->outcomes,
            'requirement'=> $request->requirement,
            'language'=> $request->language,
            'level'=> $request->level,
            'slug'=> $request->slug,
            'video_url'=> $request->video_url,
            'category_id'=> $request->category_id,
        ]);
        $message = 'Course Updated Successfully !!';
        return redirect()->route('course.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Course::find($id);
        if(CourseEnroll::where('course_id', $id)->exists()){
            return back()->with('error_message', 'You can not delete this course because already enrolled by student');
        }else{
            if (file_exists(base_path() . '/public/backend/uploads/product_main_image/' . $data->thumbnail))
            {
                @unlink(base_path() . '/public/backend/course/' . $data->thumbnail);
            }
            $data->delete();
            $message = "Course Delete Successfully !!";
            return back()->with('success', $message);
        }

    }
    public function courseLesson($id){

        $course  = Course::findOrFail($id);
        $allCourseLessons = CourseLesson::where('course_id', $id)->orderBy('id', 'DESC')->get();
        return view('backend.layouts.course.add_course_lesson', compact('allCourseLessons','course'));
    }
    public function storeLesson(Request $request){
        $request->validate([
           'lesson_title'=> 'required',
           'video_url'=> 'required|url'
        ]);
        CourseLesson::create([
            'course_id'=> $request->course_id,
            'lesson_title'=> $request->lesson_title,
            'video_url'=> $request->video_url
        ]);
        $message = "Lesson Added Successfully !!";
        return back()->with('success', $message);
    }
    public function courseReview(){
        $allReview = CourseReview::orderBy('status', 'ASC')->get();
        return view('backend.layouts.course_review.courseReview', compact('allReview'));
    }
    public function reviewUpdate($id){
            CourseReview::find($id)->update([
               'status'=> 1
            ]);
            return back()->with('success', 'Review Status Updated Successfully ');
    }




}
