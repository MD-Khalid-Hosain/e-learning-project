@extends('Frontend.elearning.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="row mt-5 mb-5">
            <div class="col-lg-6 m-auto">
                <div class="modal-content sign-in-modal">
                    <div class="modal-header">
                        <h5 class="modal-title">Login your account</h5>
                    </div>
                    <div class="modal-body">
                        @if (session('error_message'))
                            <div class="alert alert-danger alert-dismissible" >
                                <strong>{{ session('error_message') }}</strong>
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
                        <form action="{{url('login/students')}}" method="post">
                            @csrf
                            <div class="input-group">
                                <span class="input-field-icon"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="email">
                            </div>
                            <div class="input-group">
                                <span class="input-field-icon"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="password">
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                            <div class="forgot-pass">
                                <span>or</span>
                                <a href="{{route('student-forget-password')}}">Forgot
                                    password</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
