@extends('Frontend.master')
@section('title')
{{ $about->meta_title }}
@endsection
@section('content')
<!--=====================
    Breadcrumb Aera Start
    =========================-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li>
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================
    Breadcrumb Aera End
    =========================-->
    <!--======================
    login area Start
    ==========================-->
    <div class="login-area mt-25">
        <div class="container">
            <div class="row">
                <div class="offset-lg-12 col-lg-12">
                    <div class="checkout_info mb-20 about-css">

                        {!! $about->about_description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
