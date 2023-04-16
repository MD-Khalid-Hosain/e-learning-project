@extends('backend.master')
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
                       @if (session('success'))
                        <div class="alert alert-success alert-dismissible" >
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="header">
                            <h2><strong>Edit Product</strong></h2>
                        </div>
                        <div class="body">
                            <form name="productForm" id="productForm" action="{{ url('admin/update-product') }}"  method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="product_name">Product Name</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="product_name" value="{{ $product_edit->product_name }}" class="form-control" id="product_name">
                                            <input type="hidden" name="product_id" value="{{ $product_edit->id }}">
                                            @error ('product_name')
                                             <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="category_id">Select Category</label><span class="required">*</span>
                                        <select name="category_id" id="category_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                            <option>---Select Category---</option>
                                            @foreach ($categories as $sections)
                                                <option class="font-weight-bold" disabled>{{ $sections['section_name'] }}</option>
                                                @foreach ($sections['categories'] as $category)
                                                    <option class="pl-3" value="{{ $category['id'] }}" @if (!empty($product_edit->category_id) && $product_edit->category_id == $category['id'] ) selected @endif >--&nbsp;{{ $category['category_name'] }}</option>
                                                    @foreach ($category['subcategories'] as $subcategory)
                                                         <option class="pl-5" value="{{ $subcategory['id'] }}" @if (!empty($product_edit->category_id) && $product_edit->category_id == $subcategory['id'] ) selected @endif>&nbsp;&nbsp;-&nbsp;{{ $subcategory['category_name'] }}</option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                        @error ('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="product_description">Product Description</label><span class="required">*</span>
                                        <div class="form-group">
                                            <textarea name="product_description"  class="form-control summernote"  rows="9">{{ $product_edit->product_description }}</textarea>
                                        </div>
                                        <label for="offer_id">Select Offer</label>
                                        <div class="form-group" style="text-align:center">
                                            <select name="offer_id" id="offer_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                                <option value="" >--Select Offer--</option>
                                                @foreach ($offers as $offer)
                                                <option @if($product_edit->offer_id == $offer->id) selected @endif value="{{ $offer->id }}">{{ $offer->offer_name }}</option>
                                                @endforeach
                                            </select>
                                            @error ('offer_id')
                                                <small class="text-danger">{{ $message }}</small>
                                             @enderror
                                        </div>
                                        <label for="offer_percent">Offer Percent</label>
                                        <div class="form-group" style="text-align:center">
                                            <input type="text" name="offer_percent" class="form-control" id="offer_percent" value="{{ $product_edit->offer_percent }}">
                                            @error ('offer_percent')
                                                <small class="text-danger">{{ $message }}</small>
                                             @enderror
                                        </div>
                                        <label for="previous_price">Previous Price</label>
                                        <div class="form-group" style="text-align:center">
                                            <input type="text" name="previous_price" class="form-control" id="previous_price" value="{{ $product_edit->previous_price }}">
                                            @error ('previous_price')
                                                <small class="text-danger">{{ $message }}</small>
                                             @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="brand_id">Select Brnad</label><span class="required">*</span>
                                      <div class="form-group" style="text-align:center">
                                        <select name="brand_id" id="brand_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                            <option value="0">--Select Brand--</option>
                                            @foreach ($brands as $brandDetails)
                                            <option @if ($product_edit->brand_id == $brandDetails['id']) selected @endif value="{{ $brandDetails['id'] }}">{{ $brandDetails['name'] }}</option>
                                            @endforeach
                                        </select>
                                         @error ('brand_id')
                                                <small class="text-danger">{{ $message }}</small>
                                             @enderror
                                        </div>
                                        <label for="component_id">Select Component</label><span class="required">*</span>
                                      <div class="form-group" style="text-align:center">
                                        <select name="component_id" id="component_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                            <option value="">--Select Component--</option>
                                            @foreach ($allComponents as $component)
                                            <option @if ($product_edit->component_id == $component->id) selected @endif value="{{ $component->id }}">{{ $component->component_name }}</option>
                                            @endforeach
                                        </select>
                                         @error ('component_id')
                                                <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        </div>
                                         <label for="processor">Processor Type</label>
                                      <div class="form-group" style="text-align:center">
                                        <select name="processor" id="support" class="form-control show-tick ms select2" data-placeholder="Select">
                                            <option value="">--Select Version--</option>
                                            <option @if ($product_edit->processor == "intel") selected @endif value="intel">Intel</option>
                                            <option @if ($product_edit->processor == "amd") selected @endif value="amd">AMD</option>
                                        </select>
                                         @error ('processor')
                                                <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        </div>
                                        <label for="support">Supported Version</label>
                                      <div class="form-group" style="text-align:center">
                                        <select name="support" id="support" class="form-control show-tick ms select2" data-placeholder="Select">
                                            <option value="">--Select Version--</option>
                                            <option  @if ($product_edit->support == "ddr3") selected @endif value="ddr3">DDR3</option>
                                            <option @if ($product_edit->support == "ddr4") selected @endif value="ddr4">DDR4</option>
                                            <option @if ($product_edit->support == "ddr5") selected @endif value="ddr5">DDR5</option>
                                            <option @if ($product_edit->support == "ssd") selected @endif value="ssd">SSD</option>
                                            <option @if ($product_edit->support == "hdd") selected @endif value="hdd">HDD</option>

                                        </select>
                                         @error ('support')
                                                <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        </div>
                                        <label for="main_image">Product Image</label><span class="required">*</span>
                                        <div class="form-group" style="text-align:center">
                                            <input type="file" name="main_image"  class="form-control" id="main_image">
                                        </div>
                                        <label for="main_image" class="mt-2">Product Multiple Image</label>
                                        <div class="form-group" style="text-align:center">
                                            <input type="file" name="product_multiple_image[]" multiple  class="form-control" id="main_image">
                                        </div>
                                         <label for="product_code" class="mt-2">Product Code</label>
                                        <div class="form-group" style="text-align:center">
                                            <input type="text" name="product_code" value="{{ $product_edit->product_code }}" class="form-control" id="product_code">
                                            @error ('product_code')
                                                <small class="text-danger">{{ $message }}</small>
                                             @enderror
                                        </div>
                                        <label for="product_mpn" class="mt-2">Product MPN</label>
                                        <div class="form-group" style="text-align:center">
                                            <input type="text" name="product_mpn" value="{{ $product_edit->product_mpn }}" class="form-control" id="product_mpn">
                                            @error ('product_mpn')
                                                <small class="text-danger">{{ $message }}</small>
                                             @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                     <div class="col-md-6">
                                       <label for="price">Slug</label><span class="required">*</span>
                                        <div class="form-group" style="text-align:center">
                                            <input type="text" name="slug" value="{{ $product_edit->slug }}" class="form-control" placeholder="slug" id="slug">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <label for="price">Price</label><span class="required">*</span>
                                        <div class="form-group" style="text-align:center">
                                            <input type="text" name="price" value="{{ $product_edit->price }}" class="form-control" placeholder="Price" id="price">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <label for="regular_price">Regular Price</label>
                                        <div class="form-group" style="text-align:center">
                                            <input type="text" name="regular_price" value="{{ $product_edit->regular_price }}" class="form-control" placeholder="regular_price" id="regular_price">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="meta_title">Meta Title</label>
                                        <div class="form-group">
                                            <input type="text" name="meta_title" value="{{ $product_edit->meta_title }}" class="form-control" id="meta_title" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <div class="form-group">
                                            <input name="meta_keywords" id="meta_keywords" class="form-control" data-role="tagsinput"  value="{{ $product_edit->meta_keywords }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="meta_description">Meta Description</label>
                                        <div class="form-group">
                                            <textarea name="meta_description" class="form-control" id="meta_description"  rows="6">{{ $product_edit->meta_description }}</textarea>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="product_stock">Product Stock</label><span class="required">*</span>
                                        <div class="form-group">
                                            <select name="product_stock" id="product_stock" class="form-control show-tick ms select2" data-placeholder="Select">
                                                <option value="In Stock"@if (!empty($product_edit->product_stock) && $product_edit->product_stock == 'In Stock' ) selected @endif >In Stock</option>
                                                <option value="Out of Stock" @if (!empty($product_edit->product_stock) && $product_edit->product_stock == 'Out of Stock' ) selected @endif >Out of Stock</option>
                                                <option value="Up Comming" @if (!empty($product_edit->product_stock) && $product_edit->product_stock == 'Up Comming' ) selected @endif >Up Comming</option>
                                            </select>
                                             @error ('product_stock')
                                                <small class="text-danger">{{ $message }}</small>
                                             @enderror
                                        </div>
                                        <div class="specificationHeader">
                                            <label for="product_stock">Specification Header</label><span class="required">*</span>
                                            <div class="row clearfix">
                                                <div class="col-md-8">
                                                    <input type="text" name="header[]"   class="form-control"/>
                                                     @error ('header')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="button" name="add"  class="btn btn-success add_Header ">Add More</button>
                                                </div>
                                            </div>
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
@endsection
@section('footer_section')
<script src="{{ asset('backend/assets/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
<script src="{{ asset('backend/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
<script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
<script src="{{ asset('backend/assets/js/pages/forms/editors.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/summernote/dist/summernote.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script> <!-- Bootstrap Tags Input Plugin Js -->
<script>
    $("#product_name").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#slug").val(Text);
    });
</script>
@endsection
