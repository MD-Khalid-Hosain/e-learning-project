@extends('Frontend.elearning.layouts.app')

@section('content')

    <section class="category-header-area">
        <div class="container-lg">
            <div class="row">
                <div class="col">
                    <h1 class="category-name">
                        Exam Confirmation Page
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <section class="category-course-list-area mt-3">
        <div class="container ">
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
                                <li>
                                    <div class="course-box-2">
                                        <div class="course-image">
                                            <a href="">
                                                <img src="{{ asset('images/learning.jpg') }}" alt="" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="course-details">
                                            <a href="" class="course-title">{{ $examDetails->exam_title }}</a>
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
                                                    {{App\Question::where('exam_id', $examDetails->id)->count()}} Questions
                                                </span>
                                                <span class="">
                                                    <i class="far fa-clock"></i>
                                                    {{$examDetails->exam_duration}} minutes
                                                </span>
                                                <span class="">
                                                    <i class="fas fa-closed-captioning"></i>English
                                                </span>
                                                <span class="">
                                                    <i class="fas fa-calendar"></i>{{$examDetails->exam_date}}
                                                </span>
                                                <span class="">
                                                    <i class="fas fa-clock"></i>{{\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A')}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="course-price-rating">
                                            <div class="course-price">
                                                <span class="current-price">
                                                    <form action="{{route('checkout-confirm')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="exam_id" value="{{$examDetails->id}}">
                                                        <input type="hidden" name="exam_fee" value="{{$examDetails->exam_fee}}">
                                                        <button class="btn btn-info" type="submit">Checkout</button>
                                                    </form>
                                                </span>
                                                {{--<span class="original-price">$300</span>--}}
                                            </div>
                                            <div class="course-price">
                                                <span class="current-price">Tk {{ $examDetails->exam_fee }}</span>
                                                {{--<span class="original-price">$300</span>--}}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
