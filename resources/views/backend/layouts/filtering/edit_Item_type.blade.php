@extends('backend.master')
@section('header_section')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
<!-- Bootstrap Tagsinput Css -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">

@endsection
@section('title')
  Item Type
@endsection

@section('product_settings_active')
active open
@endsection
@section('item_type_active')
    active
@endsection
@section('item_type_toggled')
    toggled waves-effect waves-block
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
            <div class="row clearfix ">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>{{ $title }}</strong></h2>
                        </div>
                        <div class="body">
                             @if (session('success'))
                            <div class="alert alert-success alert-dismissible" >
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                             @endif
                            <form name="productForm" id="productForm" action="{{ url('admin/update-itemType') }}"  method="POST">
                                @csrf
                                <input type="hidden" name="itemType_id" value="{{ $itemType->id }}">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <label for="category_id">Select Category</label><span class="required">*</span>
                                        <select name="category_id" id="category_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                            <option >---Select Category---</option>
                                            @foreach ($categories as $sections)
                                                <option class="font-weight-bold" disabled>{{ $sections->section_name }}</option>
                                                @foreach ($sections->categories as $category)
                                                    <option class="pl-3" @if ($itemType->category_id == $category->id) selected @endif value="{{ $category->id }}">--&nbsp;{{ $category->category_name }}</option>
                                                    @foreach ($category->subcategories as $subcategory)
                                                         <option class="pl-5" @if ($itemType->category_id == $subcategory->id) selected @endif  value="{{ $subcategory->id }}">&nbsp;&nbsp;-&nbsp;{{ $subcategory->category_name }}</option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                        @error ('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-5">
                                       <label for="item_type_name">Item Name</label><span class="required">*</span>
                                       <div class="form-group">
                                           <input type="text" name="item_type_name" class="form-control" id="item_type_name" value="{{ $itemType->item_type_name }}" >
                                           @error ('item_type_name')
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
<script src="{{ asset('backend/assets/js/pages/forms/editors.js') }}"></script>
@endsection
