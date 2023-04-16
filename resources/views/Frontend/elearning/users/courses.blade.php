@extends('Frontend.elearning.layouts.app')

@section('content')

    <section class="page-header-area my-course-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="page-title">My Courses</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="my-courses-area">
        <div class="container">
            <div class="row align-items-baseline">

            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" >
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close my-3" style="top:-16px" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible" >
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="close my-3" style="top:-16px" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row no-gutters" id="my_courses_area">
                @foreach ($enrolls as $enroll)
                    {{ $enroll->thumbnail }}
                    <div class="col-lg-3">
                        <div class="course-box-wrap">
                            <div class="course-box">
                                <a href="">
                                    <div class="course-image">
                                        <img src="{{ asset('backend/course') }}/{{ App\Course::where('id', $enroll->course_id)->value('thumbnail')}}" alt=""
                                             class="img-fluid">
                                        <span class="play-btn"></span>
                                    </div>
                                </a>
                                <div class="course-details">
                                    <a href="{{ route('student-course-details', App\Course::where('id', $enroll->course_id)->value('slug')) }}">
                                        <h5 class="title">{{ App\Course::where('id', $enroll->course_id)->value('title') }}</h5>
                                    </a>
                                </div>
                                <div class="row" style="padding: 5px;">
                                    <div class="col-md-6">
                                        <a href="{{ route('student-course-details', App\Course::where('id', $enroll->course_id)->value('slug')) }}" class="btn">Course
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection


@section('scripts')

{{--    <script>--}}

{{--        function courseModal($course_id) {--}}
{{--            // alert($course_id);--}}
{{--            $('#course_id_for_rating').val($course_id);--}}
{{--        }--}}

{{--    </script>--}}

@endsection
