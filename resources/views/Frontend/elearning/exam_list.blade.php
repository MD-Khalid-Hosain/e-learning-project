@extends('Frontend.elearning.layouts.app')

@section('content')

    <section class="category-header-area">
        <div class="container-lg">
            <div class="row">
                <div class="col">
                    <h1 class="category-name">
                        Exam List (Register Exam Before Exam Date)
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <section class="category-course-list-area">
        <div class="container">
            @if (session('message'))
                <div class="alert alert-danger alert-dismissible" >
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="close my-3" style="top:-16px" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" >&times;</span>
                    </button>
                </div>
            @endif
            <div class="row mt-5">
                <div class="col">
                    <div class="category-course-list">
                        <ul>
                            @foreach($allExams as $exam)
                                <li>
                                    <div class="course-box-2">
                                        <div class="course-image">
                                            <a href="">
                                                <img src="{{ asset('images/learning.jpg') }}" alt="" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="course-details">
                                            <a href="" class="course-title">{{ $exam->exam_title }}</a>
                                            {{--<a href="" class="course-instructor">--}}
                                            {{--<span class="instructor-name">first_name last_name</span>--}}
                                            {{-----}}
                                            {{--</a>--}}
                                            <div class="course-subtitle">
                                                This is very advance exam.
                                            </div>
                                            <div class="course-meta">
                                                <span class="">
                                                    <i class="fas fa-play-circle"></i>
                                                    {{App\Question::where('exam_id', $exam->id)->count()}} Questions
                                                </span>
                                                <span class="">
                                                    <i class="far fa-clock"></i>
                                                    {{$exam->exam_duration}} minutes
                                                </span>
                                                <span class="">
                                                    <i class="fas fa-closed-captioning"></i>English
                                                </span>
                                                <span class="">
                                                    <i class="fas fa-calendar"></i>{{$exam->exam_date}}
                                                </span>
                                                <span class="">
                                                    <i class="fas fa-clock"></i>{{\Carbon\Carbon::parse($exam->time)->translatedFormat('g:i A')}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="course-price-rating">
                                            <div class="course-price">
                                                <span class="current-price"><a href="{{route('checkout-page',$exam->slug)}}" class="btn btn-info">Pay & Attend</a></span>
                                                {{--<span class="original-price">$300</span>--}}
                                            </div>
                                            <div class="course-price">
                                                <span class="current-price">Tk {{ $exam->exam_fee }}</span>
                                                {{--<span class="original-price">$300</span>--}}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
