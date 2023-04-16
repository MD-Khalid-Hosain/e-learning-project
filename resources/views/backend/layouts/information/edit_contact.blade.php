@extends('backend.master')
@section('title')
  Contact us
@endsection

@section('about_settings_active')
active open
@endsection
@section('contact_active')
    active
@endsection
@section('contact_toggled')
    toggled waves-effect waves-block
@endsection
@section('header_section')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('public/backend/assets/plugins/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('public/backend/assets/plugins/dropify/css/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/summernote/dist/summernote.css') }}"/>
@endsection
@section('content')
      <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit Contact</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Form Examples</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    @if (session('delete_success'))
                        <div class="alert alert-success alert-dismissible" >
                            <strong>{{ session('delete_success') }}</strong>
                            <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="header">
                            <h2><strong></strong></h2>
                            <i class="fas fa-toggle-on"></i>
                        </div>
                        <div class="body">
                            <form name="contactForm" id="contactForm"  action="{{ route('contact-update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="contact_id" value="{{ $contact->id }}">
                                <div class="row clearfix ">
                                    <div class="col-md-6 m-auto">
                                        <label for="branch_name">Branch Name</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="branch_name" class="form-control" id="branch_name"  value="{{ $contact->branch_name }}" >
                                            @error ('branch_name')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="location_map">Location Map</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="location_map" class="form-control" id="location_map"value="{{ $contact->location_map }}" >
                                            @error ('location_map')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <label for="address">Branch Address</label>
                                        <div class="form-group">
                                                <textarea name="address"  class="form-control summernote"  rows="9">{{ $contact->address }}</textarea>
                                            @error ('address')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="close_day">Close Day</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="close_day" class="form-control" id="close_day"  value="{{ $contact->close_day }}" >
                                            @error ('close_day')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="serial">Serial Number</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="serial" class="form-control" id="serial"  value="{{ $contact->serial }}" >
                                            @error ('serial')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="meta_title">Meta Title</label>
                                        <div class="form-group" style="text-align:center">
                                           <input type="text" name="meta_title"  class="form-control" id="meta_title" value="{{ $contact->meta_title }}" >
                                            @error ('meta_title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <label for="meta_description">Meta Description</label>
                                        <div class="form-group">
                                            <textarea name="meta_description" class="form-control" id="meta_description"  rows="6">{{ $contact->meta_description }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_section')
<script src="{{ asset('public/backend/assets/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
<script src="{{ asset('public/backend/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/summernote/dist/summernote.js') }}"></script>
<script src="{{ asset('public/backend/assets/admin_js/admin_script.js') }}"></script>

@endsection
