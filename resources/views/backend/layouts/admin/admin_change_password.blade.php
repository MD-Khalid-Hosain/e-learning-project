@extends('backend.master')

@section('admin_settings_active')
active open
@endsection
@section('change_pwd_active')
    active
@endsection
@section('change_pwd_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Admin Settings</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="zmdi zmdi-home"></i>Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                        <li class="breadcrumb-item active">{{ auth('admin')->user()->name }}</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Admin</strong> Change Password </h2>
                        </div>
                        <div class="body">
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
                            <form action="{{ route('update-current-pwd') }}" method="POST" id="updatPwdForm">
                                @csrf
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="email">Admin Email</label>
                                        <div class="form-group">
                                            <input type="text" id="admin_email"  class="form-control" disabled value="{{ $adminDetails->email }}">
                                            @error ('email')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="number">Admin Type</label>
                                        <div class="form-group">
                                            <input type="text" id="admin_type" disabled class="form-control" value="{{ $adminDetails->type }}">
                                            @error ('phone_number')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="number">Current Password</label>
                                        <div class="form-group">
                                            <input type="password" id="current_pwd" name="current_pwd" class="form-control" placeholder="Enter Current Password">
                                            <span id="check_current_pwd"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="number">New Password</label>
                                        <div class="form-group">
                                            <input type="password" id="new_pwd" name="new_pwd" class="form-control" placeholder="Enter New password">
                                            @error ('phone_number')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="confirm_pass">Confirm Password</label>
                                        <div class="form-group">
                                            <input type="password" id="confirm_pwd" name="confirm_pwd" class="form-control" >
                                            <span id="showError"></span>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="checkCurrentPwd" value="{{ route('check-current-pwd') }}">
@endsection

@section('footer_section')
    <script src="{{ asset('backend/assets/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
    <script src="{{ asset('backend/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
@endsection
