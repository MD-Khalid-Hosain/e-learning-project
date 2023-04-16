@extends('backend.master')
@section('title')
    Edit Brand
@endsection
@section('header_section')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/dropify/css/dropify.min.css') }}">
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
                            <h2><strong>Edit Brand</strong></h2>
                            <i class="fas fa-toggle-on"></i>
                        </div>
                        <div class="body">
                            <form name="brandForm" id="brandForm" action="{{ url('admin/update-brand') }}"   method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="brand_id" value="{{ $brand->id }}">
                                <div class="row clearfix ">
                                    <div class="col-md-6 m-auto">
                                        <label for="brand_name">Brand Name</label>
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" id="brand_name" value="{{ $brand->name }}" >
                                            @error ('name')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="slug">Slug</label>
                                        <div class="form-group">
                                            <input type="text" name="slug" class="form-control" id="slug" value="{{ $brand->slug }}" >
                                            @error ('slug')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="image">Brand Image</label>
                                        <div class="form-group">
                                            <img src="{{ asset('backend/uploads/brand_image') }}/{{ $brand->image }}" alt="{{ $brand->name }}" width="100">
                                        </div>
                                        <label for="image">Brand Image</label>
                                        <div class="form-group">
                                            <input type="file" name="image" class="form-control" id="image" >
                                            @error ('image')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Update Brand</button>
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
<script src="{{ asset('backend/assets/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
<script src="{{ asset('backend/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
<script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
<script>
    $("#brand_name").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#slug").val(Text);
    });
</script>
@endsection

