@extends('backend.master')
@section('header_section')
<!-- Multi Select Css -->
<link rel="stylesheet" href="{{ asset('public/backend/assets/plugins/multi-select/css/multi-select.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('public/backend/assets/plugins/select2/select2.css') }}" />
@endsection
@section('admin_settings_active')
active open
@endsection
@section('update_details_active')
    active
@endsection
@section('update_details_toggled')
    toggled waves-effect waves-block
@endsection
@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Admin Settings</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="zmdi zmdi-home"></i>Home</a></li>
{{--                        <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>--}}
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
                            <h2><strong>Admin</strong> Update Details</h2>
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
                            <form action="{{ url('admin/update-details') }}" method="POST" enctype="multipart/form-data" id="updatPwdForm">
                                @csrf
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="email">Admin Email</label>
                                        <div class="form-group">
                                            <input type="text" id="admin_email"  class="form-control" disabled value="{{ $adminDetails->email }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="admin_type">Admin Type</label>
                                        <div class="form-group">
                                            <input type="text" id="admin_type"  class="form-control" disabled value="{{ $adminDetails->type }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="admin_name">Admin Name</label>
                                        <div class="form-group">
                                            <input type="text" id="admin_name" name="name"  class="form-control" value="{{ $adminDetails->name }}">
                                            @error ('name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="admin_mobile">Admin Mobile</label>
                                        <div class="form-group">
                                            <input type="text" id="admin_mobile" name="mobile"  class="form-control" value="{{ $adminDetails->mobile }}">
                                            @error ('mobile')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="form-row">--}}
{{--                                    <div class="col-lg-6 col-md-6 col-sm-12">--}}
{{--                                        <label for="admin_image">Admin Image</label>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <input type="file" id="admin_image" name="image"  class="form-control" >--}}
{{--                                            @if(!empty(Auth::guard('admin')->user()->image))--}}
{{--                                            <a href="{{ asset('backend/uploads/admin') }}/{{ Auth::guard('admin')->user()->image }}" target="#">View Image</a>--}}
{{--                                            <input type="hidden" name="current_admin_image" value="{{ Auth::guard('admin')->user()->image }}">--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
{{--                <div class="col-lg-4 col-md-12 my-5">--}}
{{--                    <div class="card mcard_3">--}}
{{--                        <div class="body">--}}
{{--                            @if (Auth::guard('admin')->user()->image !=null)--}}
{{--                                <a href="profile.html"><img src="{{ asset('backend/uploads/admin') }}/{{ Auth::guard('admin')->user()->image }}" class="rounded-circle shadow " alt="profile-image"></a>--}}
{{--                            @else--}}
{{--                                <img src="{{ asset('backend/uploads/admin/default_photo.jpg') }}" alt="Default Image">--}}
{{--                            @endif--}}
{{--                            <h4 class="m-t-10">{{ Auth::guard('admin')->user()->name }}</h4>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-12">--}}
{{--                                    <p class="text-muted">{{ Auth::guard('admin')->user()->type }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
@endsection

@section('footer_section')
    <script src="{{ asset('public/backend/assets/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
    <script src="{{ asset('public/backend/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('public/backend/assets/admin_js/admin_script.js') }}"></script>
@endsection
