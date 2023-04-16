@extends('backend.master')
@section('header_section')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/dropify/css/dropify.min.css') }}">
<!-- Bootstrap Tagsinput Css -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/summernote/dist/summernote.css') }}"/>
@endsection
@section('content')
      <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Catalogues</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Aero</a></li>
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
                            <h2><strong>{{ $title }}</strong></h2>
                        </div>
                        <div class="body">
                            <form name="categoryForm" id="categoryForm" action="{{ url('admin/add-category') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="section_id">Select Section</label><span class="required">*</span>
                                        <select name="section_id" id="section_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                            <option value="">Select</option>
                                            @foreach ($getSections as $section)
                                            <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                            @endforeach
                                        </select>
                                        @error ('section_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div id="appendCategoriesLevel" class="col-md-6">
                                       <label for="parent_id">Select Parent Category Level</label><span class="required">*</span>
                                        <select name="parent_id" id="parent_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                            <option value="">Select </option>
                                            <option value="0">Main Category</option>
                                                @if (!empty($getCategories))
                                                    @foreach ($getCategories as $category)
                                                        <option value="{{ $category['id'] }}" >{{ $category['category_name'] }}</option>
                                                            @if (!empty($category['subcategories']))
                                                                @foreach ($category['subcategories'] as $subcategory)
                                                                    <option value="{{ $subcategory['id'] }}" >&nbsp;&nbsp;&nbsp;&nbsp;&#187;&nbsp;{{ $subcategory['category_name'] }}</option>
                                                                @endforeach
                                                            @endif
                                                    @endforeach
                                                @endif
                                        </select>
                                        @error ('parent_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="category_name">Category Name</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="category_name" class="form-control" id="category_name" value="{{ old('category_name') }}" >
                                            @error ('category_name')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="description">Category Description</label><span class="required">*</span>
                                        <div class="form-group">
                                                <textarea name="description"  class="form-control summernote"  rows="9">{{ old('description') }}</textarea>
                                            @error ('description')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="category_image">Category Image</label>
                                      <div class="form-group" style="text-align:center">
                                           <input type="file" name="category_image" class="dropify" class="form-control" id="category_image">
                                            @error ('category_image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                         <label for="slug">Category Slug</label><span class="required">*</span>
                                      <div class="form-group" style="text-align:center">
                                           <input type="text" name="slug"  class="form-control" id="slug">
                                            @error ('slug')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="meta_description">Meta Description</label>
                                        <div class="form-group">
                                            <textarea name="meta_description" class="form-control" id="meta_description"  rows="6">{{ old('meta_description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="meta_title">Meta Title</label>
                                      <div class="form-group" style="text-align:center">
                                           <input type="text" name="meta_title"  class="form-control" id="meta_title">
                                            @error ('meta_title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <div class="form-group">
                                            <input type="text" name="meta_keywords" id="meta_keywords" data-role="tagsinput" value="{{ old('meta_keywords') }}">
                                        </div>

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="appendCategories" value="{{ route('append-categories-level') }}">
@endsection
@section('footer_section')
<script src="{{ asset('backend/assets/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
<script src="{{ asset('backend/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/pages/forms/dropify.js') }}"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{ asset('backend/assets/js/pages/forms/editors.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/summernote/dist/summernote.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script> <!-- Bootstrap Tags Input Plugin Js -->
<script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
<script>
    $("#category_name").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#slug").val(Text);
    });
</script>
@endsection
