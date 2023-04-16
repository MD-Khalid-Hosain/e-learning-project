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
@section('homeImage_active')
    active
@endsection
@section('homeImage_toggled')
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
                            <h2><strong>Edit Home Images</strong></h2>
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
                            <form action="{{ route('home-image-update') }}" method="POST" enctype="multipart/form-data" id="updatPwdForm">
                                @csrf
                                <input type="hidden" name="homeImage_id" value="{{ $homeImage->id }}">
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="home_image">Home Image</label><span class="required">*</span>
                                        <img src="{{ asset('backend/uploads/homeImage/'.$homeImage->home_image) }}" alt="" width="100">
                                        <div class="form-group">
                                            <input type="file" id="home_image" name="home_image"  class="form-control">
                                            @error ('home_image')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="image_link">Image Type</label><span class="required">*</span>

                                        <div class="form-group">
                                            <select name="type" id="type" class="form-control">
                                                <option >Select Type</option>
                                                <option value="Small" @if ($homeImage->type == "Small") selected  @endif>Small</option>
                                                <option value="Big" @if ($homeImage->type == "Big") selected  @endif>Big</option>
                                            </select>
                                            @error ('type')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="image_alter">Image Alter Tag</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" id="image_alter"  name="image_alter" value="{{ $homeImage->image_alter }}" class="form-control" placeholder="Enter Image Alter Tag">
                                            @error ('image_alter')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="image_link">Image Link</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" id="image_link" value="{{ $homeImage->image_link }}"  name="image_link" class="form-control" placeholder="Enter banner link">
                                            @error ('image_link')
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
