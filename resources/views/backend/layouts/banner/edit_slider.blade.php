@extends('backend.master')
@section('header_section')
<!-- Multi Select Css -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/multi-select/css/multi-select.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/summernote/dist/summernote.css') }}"/>
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
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Edit Slider</strong> Banner</h2>
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
                            <form action="{{ route('banner-slider-update') }}" method="POST" enctype="multipart/form-data" id="updatPwdForm">
                                @csrf
                                <input type="hidden" name="slider_id" value="{{ $slider->id }}">
                                <div class="form-row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="slider_image">Slider Image</label><span class="required">*</span>
                                        <img src="{{ asset('backend/uploads/banners/slider/'.$slider->slider_image) }}" alt="" width="150">
                                        <div class="form-group">
                                            <input type="file" id="slider_image" name="slider_image"  class="form-control">
                                            @error ('slider_image')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="slider_link">Slider Link</label>
                                        <div class="form-group">
                                            <input type="text" id="slider_link"  name="slider_link" class="form-control" value="{{ $slider->slider_link }}">
                                            @error ('slider_link')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="alt">Slider alt value</label>
                                        <div class="form-group">
                                            <input type="text" id="alt"  name="alt" class="form-control" value="{{ $slider->alt }}">
                                            @error ('alt')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="description">Details</label>
                                        <div class="form-group">
                                                <textarea name="details"  class="form-control summernote"  rows="9">{{ $slider->details }}</textarea>
                                            @error ('details')
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
    <script src="{{ asset('backend/assets/plugins/summernote/dist/summernote.js') }}"></script>
    <script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
@endsection
