@extends('backend.master')
@section('title')
    Add Course
@endsection
@section('course_active')
    active
@endsection
@section('course_toggled')
    toggled waves-effect waves-block
@endsection
@section('header_section')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
    <!-- Bootstrap Tagsinput Css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/summernote/dist/summernote.css') }}"/>

@endsection
@section('content')
      <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Create Course</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
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
                            <h2><strong>Create Course</strong></h2>
                            <i class="fas fa-toggle-on"></i>
                        </div>
                        <div class="body">
                            <form name="courseForm" id="courseForm"action="{{route('course.store')}}"   method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="row clearfix ">
                                    <div class="col-md-6 ">
                                        <label for="title">Course Title</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" >
                                            @error ('title')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="outcomes">Course Outcomes</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="outcomes" class="form-control" id="outcomes" value="{{ old('outcomes') }}" >
                                            @error ('outcomes')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="language">Select Language</label><span class="required">*</span>
                                        <div class="form-group" style="text-align:center">
                                            <select name="language" id="language" class="form-control show-tick ms select2" data-placeholder="Select">
                                                <option value="">--Select Language--</option>
                                                    <option value="english">English</option>
                                                    <option value="bengali">Bengali</option>
                                            </select>
                                            @error ('language')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="level">Select Level</label><span class="required">*</span>
                                        <div class="form-group" style="text-align:center">
                                            <select name="level" id="level" class="form-control show-tick ms select2" data-placeholder="Select">
                                                <option value="">--Select Level--</option>
                                                <option value="basic">Basic</option>
                                                <option value="intermediate ">Intermediate</option>
                                                <option value="advance">Advance</option>
                                            </select>
                                            @error ('level')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="short_description">Short Description</label><span class="required">*</span>
                                            <div class="form-group">
                                                <textarea name="short_description" class="form-control" id="short_description"  rows="6">{{ old('short_description') }}</textarea>
                                                @error ('short_description')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        <label for="description">Course Description</label><span class="required">*</span>
                                        <div class="form-group">
                                            <textarea name="description"  class="form-control summernote"  rows="9">{{ old('description') }}</textarea>
                                            @error ('description')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <label for="slug">Course Slug</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="slug" class="form-control" id="slug" >
                                            @error ('slug')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="thumbnail">Course Image</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="file" name="thumbnail" class="form-control" id="thumbnail" >
                                            @error ('thumbnail')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="category_id">Select Category</label><span class="required">*</span>
                                        <div class="form-group" style="text-align:center">
                                            <select name="category_id" id="category_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                                <option value="">--Select Category--</option>
                                                @foreach ($allCategory as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                            @error ('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="requirement">Requirement (example: Basic php, html, css)</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="requirement" id="requirement" value="{{ old('requirement') }}" class="form-control"/>
                                            @error ('requirement')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <label for="video_url">Video Url</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="video_url" class="form-control" id="video_url" >
                                            @error ('video_url')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Create Course</button>
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
{{--      <input type="text" id="getValue" value="1000">--}}
@endsection
@section('footer_section')
    <script src="{{ asset('backend/assets/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
    <script src="{{ asset('backend/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/forms/editors.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/summernote/dist/summernote.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script> <!-- Bootstrap Tags Input Plugin Js -->
    <script>
        $("#title").keyup(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
            $("#slug").val(Text);
        });
        // $(function() {
        //     var time = $("#getValue").val();
        //     setTimeout(function() {
        //         $('#courseForm').submit();
        //     }, time);
        // });
    </script>
@endsection
