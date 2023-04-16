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
                                <h1><a href="{{ url('/') }}">Home</a></h1>
                            </li>
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i>Mobile Verification </li>
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
                <div class="offset-lg-3 col-lg-6">
                    <div class="checkout_info mb-20">

                        <form class="form-row" method="POST" action="{{ route('mobileOtp-code') }}">
                            @csrf
                            <div class="col-lg-12 text-left mb-20">
                                @if (session('error_message'))
                                    <div class="alert alert-danger alert-dismissible" >
                                        <strong>{{ session('error_message') }}</strong>
                                        <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form_group col-12">
                                <label class="form-label">Enter Verification Code<span class="required">*</span></label>
                                <input type="hidden" name="user_id" value="{{ $user_id }}">
                                <input id="otp_verification" type="text" class="input-form " name="otp_verification" required="">
                                 @error('otp_verification')
                                    <span class="text-danger" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form_group group_3 col-lg-3">
                                <button class="login-register" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
