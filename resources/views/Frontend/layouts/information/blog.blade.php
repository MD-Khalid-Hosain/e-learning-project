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
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i>Blog</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================
    Breadcrumb Aera End
    =========================-->
    <!-- ================
    404 Area Start
    =====================-->
    <div class="error_page_start">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>This Page is Under Construction</h2>
                    <p>Sorry but the page is temporarity unavailable.</p>
                    <div class="hom_btn">
                        <a href="{{ url('/') }}" class="btn-secondary">Back to home page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================
    404 Area End
    =====================-->
@endsection
