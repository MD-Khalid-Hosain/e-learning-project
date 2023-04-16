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
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i>Login</li>
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

                        <form class="form-row" method="POST" action="{{ url('/ecom/user/login') }}">
                            @csrf
                            <h1 class="last-title mb-30 text-center">Login to Your Account</h1>
                            <div class="col-lg-12 text-left mb-20">
                                @if (session('status'))
                                    <div class="alert alert-danger alert-dismissible" >
                                        <strong>{{ session('status') }}</strong>
                                        <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible" >
                                        <strong>{{ session('success') }}</strong>
                                        <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form_group col-12">
                                <label class="form-label">Email <span class="required">*</span></label>
                                <input id="email" type="email" class="input-form " name="email" value="{{ old('email') }}" >
                                 @error('email')
                                    <span class="text-danger" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form_group col-12 position-relative">
                                <label class="form-label">Password <span class="required">*</span></label>
                                <input id="password" type="password" class="input-form input-login" name="password" >
                                <span class="show-btn" id="show_password">Show</span>
                                @error('password')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form_group group_3 col-lg-3">
                                <button class="login-register" type="submit">Login</button>
                            </div>
                            <div class="form_group group_3 col-lg-9">
                                <label for="remember_box">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span> Remember me </span>
                                </label>
                            </div>
                            <div class="col-lg-12 text-left">
                                <a href="{{ route('user-forgot-password') }}">Forgot Your Password?</a>
                            </div>
                            <div class="col-lg-12 text-left">
                                <p class="register-page"> No account? <a href="{{ url('/ecom/user/registration') }}">Create one here</a>.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
