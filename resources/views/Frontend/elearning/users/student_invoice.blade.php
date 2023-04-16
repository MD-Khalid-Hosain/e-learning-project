@extends('Frontend.elearning.layouts.app')
@section('invoice_active')
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
                                <div class="title">All Invoice</div>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible" >
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="close my-3" style="top:-16px" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="content-box">
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Exam Title</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Invoice</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($allPayment as $payment)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ App\ExamEvent::where('id', $payment->exam_id)->value('exam_title') }}</td>
                                            <td>TK {{ $payment->amount }}</td>
                                            <td>{{ $payment->created_at->translatedFormat('d, F, Y') }}</td>
                                            <td>{{ $payment->exam_confirmation_status }}</td>
                                            <td>
                                                <a href="{{route('student-invoice-download', $payment->id)}}" class="btn btn-primary" style="background: blue;">Download</a>
                                            </td>
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
