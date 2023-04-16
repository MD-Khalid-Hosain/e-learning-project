@extends('Frontend.elearning.layouts.app')
@section('profile_active')
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
                                <div class="title">Profile</div>
                                <div class="subtitle">Add information about yourself to share on your profile.
                                </div>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible" >
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="close my-3" style="top:-16px" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form action="{{route('student.update', Auth::guard('student')->id())}}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="content-box">
                                    <div class="basic-group">
                                        <div class="form-group">
                                            <label for="FristName">Basics:</label>
                                            <input type="text" class="form-control" name="first_name" id="FristName"
                                                   placeholder="first name" value="{{ Auth::guard('student')->user()->first_name }}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="last_name"
                                                   placeholder="last name" value="{{ Auth::guard('student')->user()->last_name }}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="number"
                                                   placeholder="number" value="{{ Auth::guard('student')->user()->number }}">
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
