@extends('Frontend.elearning.layouts.app')

@section('header_script')
    <script type="text/javascript">
        $(window).on('popstate', function(event) {
            alert("pop");
        });
    </script>
@endsection
@section('content')

    <section class="page-header-area my-course-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="page-title">My Exams</h1>
                    <ul>
                        <li class="active"><a href="">All Exams</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="my-courses-area">

        <div class="container">
            @if (session('message'))
                <div class="alert alert-danger alert-dismissible" >
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="close my-3" style="top:-16px" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" >&times;</span>
                    </button>
                </div>
            @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible" >
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close my-3" style="top:-16px" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" >&times;</span>
                        </button>
                    </div>
                @endif
            <div class="row no-gutters" id="my_courses_area">
                @foreach ($allExams as $exam)
                    <div class="col-lg-3">
                        <div class="course-box-wrap">
                            <div class="course-box">
                                <a href="">
                                    <div class="course-image">
                                        <img src="{{ asset('images/learning.jpg') }}" alt=""
                                             class="img-fluid">
                                    </div>
                                </a>
                                <div class="course-details">
                                    <a href="">
                                        <h5 class="title">{{ $exam->exam_title }}</h5>
                                    </a>
                                    <p class="instructors">Exam Will Start: <span class="font-weight-bold">{{ $exam->exam_date }}</span>  <span class="font-weight-bold">{{\Carbon\Carbon::parse($exam->time)->translatedFormat('g:i A')}}</span></p>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <a href="{{route('exam-start', $exam->id)}}"
                                           class="btn">Start Exam</a>
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


