@extends('Frontend.elearning.layouts.app')

@section('content')

    <section class="category-header-area">
        <div class="container-lg">
            <div class="row">
                <div class="col">
                    <h1 class="category-name">
                        {{ $category->title }}
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <section class="category-course-list-area mt-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="category-course-list">
                        <ul>
                            @foreach($allCourses as $course)
                                <li>
                                    <div class="course-box-2">
                                        <div class="course-image">
                                            <a href="{{ route('student-course-details', App\Course::where('id', $course->id)->value('slug')) }}">
                                                <img src="{{ asset('backend/course/'.$course->thumbnail) }}" alt="" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="course-details">
                                            <a href="{{ route('student-course-details', App\Course::where('id', $course->id)->value('slug')) }}" class="course-title">{{ $course->title }}</a>
                                            {{--<a href="" class="course-instructor">--}}
                                                {{--<span class="instructor-name">first_name last_name</span>--}}
                                                {{-----}}
                                            {{--</a>--}}
                                            <div class="course-subtitle">
                                                {{ $course->short_description }}
                                            </div>
                                            <div class="course-meta">
                                                <span class="">
                                                    <i class="fas fa-play-circle"></i>
                                                    {{ App\CourseLesson::where('course_id', $course->id)->count() }} Lessons
                                                </span>
                                                <span class="">
                                                    <i class="far fa-clock"></i>
                                                    3 hours
                                                </span>
                                                <span class="">
                                                    <i class="fas fa-closed-captioning"></i>{{$course->language}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="course-price-rating">
                                            <div class="course-price">
                                                <span class="current-price">Free</span>
                                                {{--<span class="original-price">$300</span>--}}
                                            </div>
{{--                                            <div class="rating">--}}
{{--                                                <i class="fas fa-star filled"></i>--}}
{{--                                                <i class="fas fa-star filled"></i>--}}
{{--                                                <i class="fas fa-star filled"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <span class="d-inline-block average-rating">5</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="rating-number">--}}
{{--                                                4 Ratings--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <nav>
                        {{--pagination--}}
                    </nav>
                </div>
            </div>
        </div>
    </section>

@endsection
