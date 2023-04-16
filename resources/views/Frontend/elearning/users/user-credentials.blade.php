@extends('Frontend.elearning.layouts.app')
@section('account_active')
    active
@endsection
@section('content')

    <section class="user-dashboard-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="user-dashboard-box">
                        <div class="user-dashboard-sidebar">
                            <div class="user-box">
                                <img src="{{ asset('images/avatar.png') }}" alt="" class="img-fluid">
                                <div class="name">
                                    <div class="name">{{ Auth::guard('student')->user()->first_name .' '. Auth::guard('student')->user()->last_name }}</div>
                                </div>
                            </div>
                            <div class="user-dashboard-menu">
                                <ul>
                                    <li class="@yield('dashboard_active')">
                                        <a href="{{route('student-dashboard')}}">Dashboard</a>
                                    </li>
                                    <li class="@yield('profile_active')">
                                        <a href="{{route('student-profile')}}">Profile</a>
                                    </li>
                                    <li class="@yield('account_active')">
                                        <a href="{{route('student-account-page')}}">Account</a>
                                    </li>

                                    <li class="@yield('invoice_active')">
                                        <a href="{{route('student-invoice-page')}}">Invoice</a>
                                    </li>
                                    <li class="@yield('my_exams_active')">
                                        <a href="{{route('student-exams')}}">My Exams</a>
                                    </li>
                                    <li class="@yield('my_course_active')">
                                        <a href="{{route('student-courses')}}">My Courses</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="user-dashboard-content">
                            <div class="content-title-box">
                                <div class="title">Account</div>
                                <div class="subtitle">Change Password</div>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible" >
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="close my-3" style="top:-16px" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('error_message'))
                                <div class="alert alert-danger alert-dismissible" >
                                    <strong>{{ session('error_message') }}</strong>
                                    <button type="button" class="close my-3" style="top:-16px" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form action="{{route('student-change-password')}}" method="post">
                                @csrf
                                <div class="content-box">
                                    <div class="password-group">
                                        <div class="form-group">
                                            <label for="password">Password:</label>
                                            <input type="password" class="form-control" id="current_pwd"
                                                   name="current_pwd"
                                                   placeholder="Enter current password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control passInput" name="new_pwd"
                                                   placeholder="Enter new password">
                                            <input type="checkbox" id="showPass"> Show Password
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control passInput" name="confirm_pwd"
                                                   placeholder="Confirm your password">
                                        </div>
                                    </div>
                                </div>
                                <div class="content-update-box">
                                    <button type="submit" class="btn">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')
    <script>
        $(document).ready(function(){

            $('#showPass').on('click', function(){
                var passInput=$(".passInput");
                if(passInput.attr('type')==='password')
                {
                    passInput.attr('type','text');
                }else{
                    passInput.attr('type','password');
                }
            })
        })
    </script>
@endsection
