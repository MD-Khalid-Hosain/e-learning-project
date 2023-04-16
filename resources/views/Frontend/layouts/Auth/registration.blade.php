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
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i>Register</li>
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
    Register area Start
    ==========================-->
    <div class="register-area login-area mt-25">
        <div class="container">
            <div class="row">
                <div class="offset-lg-3 col-lg-6">
                    <div class="checkout_info mb-20">
                        <h1 class="last-title mb-30 text-center">Create New Account</h1>

                            <div class="col-lg-12 text-left mb-20">
                                <p class="register-page"> Already have an account? <a href="{{ url('ecom/user/login') }}">Log in instead!</a></p>
                            </div>
                            <div class="col-lg-12 text-left mb-20">
                                @if (session('message'))
                                    <div class="alert alert-danger alert-dismissible" >
                                        <strong>{{ session('message') }}</strong>
                                        <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>

                        <form class="form-row" method="POST" action="{{ url('/ecom/user/register') }}">
                            @csrf

                            <div class="form_group col-12">
                                <label class="form-label">Your Name <span>*</span></label>
                                 <input id="name" type="text" class="input-form " name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                                @error('name')
                                    <span class="text-danger" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form_group col-12">
                                <label class="form-label">Email Address <span>*</span></label>

                                <input id="email" type="email" class="input-form " name="email" value="{{ old('email') }}" autocomplete="email">
                                @error('email')
                                    <span class="text-danger" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form_group col-12">
                                <label class="form-label">Mobile Number <span>*</span></label>
                                <input class="input-form " type="text" name="mobile" value="{{ old('mobile') }}">
                                 @error('mobile')
                                    <span class="text-danger" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form_group col-12">
                                <label class="form-label">Address <span>*</span></label>
                                <textarea class="input-form "name="address" >{{ old('address') }}</textarea>
                                 @error('address')
                                    <span class="text-danger" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form_group col-12">
                                <label class="form-label">Password <span>*</span></label>
                                <input id="password" type="password" class="input-form " name="password" >
                                <span class="show-btn" id="show_password">Show</span>
                                @error('password')
                                    <span class="text-danger" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form_group col-12">
                                <label class="form-label">Confirm Password <span>*</span></label>

                                <input id="passwordConfirm" type="password" class="input-form " name="confirm_password"  >
                                <span class="show-btn" id="confirm_password">Show</span>
                                <span id="showError"></span>
                                @error('confirm_password')
                                    <span class="text-danger" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-row mt-20">
                                <input type="submit" class="btn-secondary" value="Register">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('footer_script')
    <script>
        $(document).ready(function(){
                $('#passwordConfirm').keyup(function (){
            var new_pwd = $('#password').val();
            var confirm_pwd = $('#passwordConfirm').val();

            if (new_pwd != confirm_pwd){
                $("#showError").html("<font color= red>Password is not match</font>");
            }else{
                $("#showError").html("<font color= green>Password matched </font>");
            }

            });
        });
    </script>
@endsection

