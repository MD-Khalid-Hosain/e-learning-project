@extends('Frontend.master')
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
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i>All Brands</li>
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
                    <div class="all-brand-image mb-20 about-css">
                        @foreach ($allBrands as $brand)
                            <a href="{{ route('all-brand-product', $brand->slug) }}"><img src="{{ asset('backend/uploads/brand_image') }}/{{ $brand->image }}" alt=""></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
