@extends('Frontend.elearning.layouts.app')
@section('dashboard_active')
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
                                <div class="title">Dashboard</div>
                            </div>
                            <div class="content-box">
                                <h2 class="text-center">Exam Result</h2>
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Exam Title</th>
                                        <th scope="col">Total Right Ans:</th>
                                        <th scope="col">Total Wrong Ans:</th>
                                        <th scope="col">Total Mark</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($allExamResult as $result)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ App\ExamEvent::find($result->exam_id)->value('exam_title') }}</td>
                                            <td>{{ $result->total_right_ans }}</td>
                                            <td>{{ $result->total_wrong_ans }}</td>
                                            <td>{{ $result->total_mark }}</td>
                                            <td>
                                                <button data-toggle="modal" class="btn {{ $result->status == 'pending' ? 'btn-warning' : ($result->status == 'passed' ? 'btn-success' : 'btn-danger') }}" data-target="#exampleModalCenter">{{ $result->status }}</button></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
