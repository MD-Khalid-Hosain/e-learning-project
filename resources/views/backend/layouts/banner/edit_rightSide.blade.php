@extends('backend.master')
@section('header_section')
<!-- Multi Select Css -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/multi-select/css/multi-select.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
@endsection
@section('banner_section_active')
active open
@endsection
@section('banner_active')
    active
@endsection
@section('banner_toggled')
    toggled waves-effect waves-block
@endsection
@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Jquery DataTables</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Normal Tables</li>
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
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Create Right Side</strong> Banner</h2>
                        </div>
                        <div class="body">
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible" >
                                <strong>{{ session('error') }}</strong>
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
                            <form action="{{ route('banner-rightSide-update') }}" method="POST" enctype="multipart/form-data" id="updatPwdForm">
                                @csrf
                                <input type="hidden" name="rightSide_id" value="{{ $rightSide->id }}">
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="right_image">Right Side Image</label><span class="required">*</span>
                                         <img src="{{ asset('backend/uploads/banners/rightSideImage/'.$rightSide->right_image) }}" alt="" width="150">
                                        <div class="form-group">
                                            <input type="file" id="right_image" name="right_image"  class="form-control">
                                            @error ('right_image')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="right_side_link">Right Side Banner Link</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" id="right_side_link"  name="right_side_link" class="form-control" value="{{ $rightSide->right_side_link }}">
                                            @error ('right_side_link')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
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
@endsection

@section('footer_section')
    <script src="{{ asset('backend/assets/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
    <script src="{{ asset('backend/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
@endsection
