@extends('backend.master')
@section('title')
  Scroll create
@endsection

@section('about_settings_active')
active open
@endsection
@section('scroll_active')
    active
@endsection
@section('scroll_toggled')
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
                    <h2>Scroll Add</h2>
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
                    <div class="card">
                        <div class="header">
                            <h2><strong></strong></h2>
                            <i class="fas fa-toggle-on"></i>
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
                            <form name="scrollForm" id="scrollForm"  action="{{ route('scroll-create') }}" method="POST">
                            @csrf
                                <div class="row clearfix ">
                                    <div class="col-md-6 m-auto">
                                        <label for="scroll_status">Scroll Status</label><span class="required">*</span>
                                        <div class="form-group">
                                            <textarea name="scroll_status" class="form-control" id="scroll_status"  rows="6">{{ old('scroll_status') }}</textarea>
                                            @error ('scroll_status')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="day">Day</label>
                                        <div class="form-group" >
                                           <select name="day" id="day" class="form-control show-tick ms select2" data-placeholder="Select">
                                               <option value="">--Select A Day--</option>
                                               <option value="Saturday">Saturday</option>
                                               <option value="Sunday">Sunday</option>
                                               <option value="Monday">Monday</option>
                                               <option value="Tuesday">Tuesday</option>
                                               <option value="Wednesday">Wednesday</option>
                                               <option value="Thursday">Thursday</option>
                                               <option value="Friday">Friday</option>
                                           </select>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Submit</button>
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
