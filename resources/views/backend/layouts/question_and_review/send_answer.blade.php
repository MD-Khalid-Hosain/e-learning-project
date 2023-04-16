@extends('backend.master')
@section('title')
    Send Message
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
                    <h2>Question Answer</h2>
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
                            <h2><strong>Send Answer</strong></h2>
                            <i class="fas fa-toggle-on"></i>
                        </div>
                        <div class="body">
                            <form name="sectionForm" id="sectionForm" action="{{ route('send.question.answer') }}" method="POST">
                            @csrf
                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                                <div class="row clearfix ">
                                    <div class="col-md-6 m-auto">
                                        <label for="customer_name">Customer Name</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="customer_name" class="form-control" id="customer_name" value="{{ $question->customer_name }}" disabled >
                                            @error ('customer_name')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="customer_number">Customer Number</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="customer_number" class="form-control" id="customer_number" value="{{ $question->customer_number }}" disabled>
                                            @error ('customer_number')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="product">Product</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="customer_number" value="{{ $question->product->product_name }}" disabled>
                                            @error ('product')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="question">Question</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="question" value="{{ $question->question }}" disabled>
                                            @error ('question')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <label for="answer">Answer</label>
                                        <div class="form-group">
                                                <textarea name="answer"  class="form-control"  rows="9">@if (!empty($question->answer)){{ $question->answer }} @else  @endif</textarea>
                                            @error ('answer')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Send Answer</button>
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
