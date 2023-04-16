@extends('backend.master')
@section('title')
    Information Panel
@endsection
@section('header_section')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('public/backend/assets/plugins/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('public/backend/assets/plugins/dropify/css/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/summernote/dist/summernote.css') }}"/>
@endsection
@section('about_settings_active')
active open
@endsection
@section('payment_active')
    active
@endsection
@section('payment_toggled')
    toggled waves-effect waves-block
@endsection
@section('content')
      <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Information Panel</h2>
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
                            <h2><strong>Payment Policy</strong></h2>
                            <i class="fas fa-toggle-on"></i>
                        </div>
                        <div class="body">
                            <form name="sectionForm" id="sectionForm" @if ($count < 1) action="{{ route('payment-create') }}" @else action="{{ route('update-payment') }}" @endif method="POST">
                            @csrf
                                <div class="row clearfix ">
                                    <div class="col-md-6 m-auto">

                                        <label for="payment_policy">Payment Policy</label>
                                        <div class="form-group">
                                                <textarea name="payment_policy"  class="form-control summernote"  rows="9"> @if(!empty($paymentInformation->payment_policy)) {{ $paymentInformation->payment_policy }} @endif </textarea>
                                            @error ('privacy_information')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="meta_title">Meta Title</label>
                                        <div class="form-group" style="text-align:center">
                                           <input type="text" name="meta_title"  class="form-control" id="meta_title" @if(!empty($paymentInformation->meta_title)) value="{{ $paymentInformation->meta_title }}"  @endif>
                                            @error ('meta_title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <label for="meta_description">Meta Description</label>
                                        <div class="form-group">
                                            <textarea name="meta_description" class="form-control" id="meta_description"  rows="6">@if(!empty($paymentInformation->meta_description)) {{ $paymentInformation->meta_description }} @endif</textarea>
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
