@extends('backend.master')
@section('title')
    Edit Course Category
@endsection
@section('category_active')
    active
@endsection
@section('category_toggled')
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
                    <h2>Edit Course Category</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('course-category.index')}}"> Back to category list</a></li>
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
                            <h2><strong>Edit Course Category</strong></h2>
                            <i class="fas fa-toggle-on"></i>
                        </div>
                        <div class="body">
                            <form name="sectionForm" id="sectionForm" action="{{route('course-category.update', $data->id)}}"  method="POST">
                            @csrf
                                @method('PUT')
                                <div class="row clearfix ">
                                    <div class="col-md-6 m-auto">
                                        <label for="category_name">Course Category Name</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="category_name" class="form-control" id="category_name" value="{{ $data->category_name}}">
                                            @error ('category_name')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="slug">Course Category Slug</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="slug" class="form-control" id="slug"  value="{{ $data->slug}}">
                                            @error ('slug')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Update Category </button>
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
<script>
    $("#category_name").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#slug").val(Text);
    });
</script>
@endsection
