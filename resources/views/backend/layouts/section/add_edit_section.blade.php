@extends('backend.master')
@section('title')
    Add Section
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
                    <h2>Catalogues</h2>
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
                            <h2><strong>{{ $title }}</strong></h2>
                            <i class="fas fa-toggle-on"></i>
                        </div>
                        <div class="body">
                            <form name="sectionForm" id="sectionForm" @if (empty($section['id'])) action="{{ url('admin/add-edit-section') }}" @else action="{{ url('admin/add-edit-section/'.$section['id']) }}" @endif  method="POST">
                            @csrf
                                <div class="row clearfix ">
                                    <div class="col-md-6 m-auto">
                                        <label for="section_name">Section Name</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="section_name" class="form-control" id="section_name" @if (!empty($section['section_name'])) value="{{ $section['section_name'] }}" @else value="{{ old('section_name') }}" @endif>
                                            @error ('section_name')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="slug">Section Slug</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="slug" class="form-control" id="slug" @if (!empty($section['slug'])) value="{{ $section['slug'] }}" @else value="{{ old('slug') }}" @endif>
                                            @error ('slug')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <label for="description">Section Description</label>
                                        <div class="form-group">
                                                <textarea name="description"  class="form-control summernote"  rows="9">@if (!empty($section['description'])) {{ $section['description'] }} @else {{ old('description') }} @endif</textarea>
                                            @error ('description')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="meta_title">Meta Title</label>
                                        <div class="form-group" style="text-align:center">
                                           <input type="text" name="meta_title"  class="form-control" id="meta_title" @if (!empty($section['meta_title'])) value="{{ $section['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif>
                                            @error ('meta_title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <label for="meta_description">Meta Description</label>
                                        <div class="form-group">
                                            <textarea name="meta_description" class="form-control" id="meta_description"  rows="6">@if (!empty($section['meta_description'])) {{ $section['meta_description'] }} @else {{ old('meta_description') }} @endif</textarea>
                                        </div>


                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">@if (empty($section['id'])) Create section @else Update section @endif</button>
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
    $("#section_name").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#slug").val(Text);
    });
</script>
@endsection
