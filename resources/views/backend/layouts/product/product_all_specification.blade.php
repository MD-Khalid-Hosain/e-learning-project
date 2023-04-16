@extends('backend.master')
@section('header_section')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
<!-- Bootstrap Tagsinput Css -->
<link rel="stylesheet" href="{{ asset('backend/assets/css/others.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/summernote/dist/summernote.css') }}"/>

@endsection
@section('title')
  Product All Specifications
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Product All Specifications</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Normal Tables</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible" >
                            <strong>{{ session('error') }}</strong>
                            <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('features'))
                        <div class="alert alert-success alert-dismissible" >
                            <strong>{{ session('features') }}</strong>
                            <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-xl-9 col-lg-8 col-md-12">

                                    <div class="product details">
                                        <h3 class="product-title mb-0">{{ $productDetails['product_name'] }}</h3>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <form name="attributes" id="productAttributes"  action="{{ url('admin/add-productAllSepecification/'.$productDetails['id']) }}" method="post" >
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $productDetails['id']}}">
                                <input type="hidden" name="category_id" value="{{ $productDetails['category_id'] }}">
                                <input type="hidden" name="category_slug" value="{{ $productDetails['category_slug'] }}">
                                <div class="row clearfix">
                                    <div class="col-md-8">
                                        <label for="header_id">Select Section</label><span class="required">*</span>
                                        <select name="header_id" id="header_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                            <option value="">Select</option>
                                            @foreach ($specification_header as $item)
                                            <option value="{{ $item->id }}">{{ $item->header }}</option>
                                            @endforeach
                                        </select>
                                        @error ('header_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="titleRemove">
                                    <div class="row clearfix mt-3">
                                        <div class="col-md-3 ">
                                            <input type="text" name="title[]" class="form-control" />
                                        </div>
                                        <div class="col-md-5 ">
                                            <textarea   name="description[]"  class="form-control summernote" rows="3"></textarea>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" name="add" class="btn btn-success add_title_desc">Add More</button>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($get_ItemType_and_variant as $itemType)
                                    <div class="row clearfix">
                                        <div class="col-md-4">
                                            <label for="specification">{{ $itemType->item_type_name }}</label>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                                @foreach (App\ItemPart::where('item_type_id',$itemType->id)->get() as $variant)
                                                <div class="checkbox inlineblock">
                                                    <input id="{{ $variant->id }}" type="checkbox" name="variant_id[]" value="{{ $variant->id }}">
                                                    <label for="{{ $variant->id }}">{{ $variant->item_parts_variant }}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                @endforeach
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="meta_description">Fetures</label>
                                    </div>
                                </div>
                                <div class="shortSpecificationAddRemove">
                                    <div class="remove_field2">
                                        <div class="row clearfix">
                                            <div class="col-md-8">
                                                <input type="text" name="fetures[]"  class="form-control"/></div>
                                                <div class="col-md-4"> <button type="button" name="add"  class="btn btn-success add_button2">Add More</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#specification">Specification</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#fetures">Fetures</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#filter">Filtering</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#header">Header</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card">
                        <div class="body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="specification">
                                    <form name="editSpecification" id="editSpecification" action="{{ url('admin/edit-specification/'.$productDetails['id']) }}" method="post">
                                        @csrf
                                        <div class="table-responsive">
                                            @foreach ($specification_header as $headerTitle)
                                                <table class="data-table" cellspacing="0" cellpadding="0">
                                                    <colgroup>
                                                        <col class="name">
                                                        <col class="value">
                                                    </colgroup>
                                                    <thead>
                                                        <tr>
                                                            <td class="heading-row" colspan="3">{{ $headerTitle->header }}</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ( App\TitleDescOfSpecification::where('header_id',$headerTitle->id)->where('product_id',$headerTitle->product_id)->get() as $specification)
                                                            <tr>
                                                                <input type="hidden" name="specificatation_id[]" value="{{ $specification['id'] }}">
                                                                <td class="name"><input type="text" name="title[]" class="form-control" value="{{ $specification->title }}"></td>
                                                                <td class="value"><input type="text" name="description[]" class="form-control" value="{{ $specification->description }}"></td>
                                                                <td>
                                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm specificationConfirmDelete" recordid="{{ route('specification.delete',$specification['id']) }}"><i class="zmdi zmdi-delete"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @endforeach
                                            <div class="row clearfix">
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-info">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="fetures">
                                    <form name="editFetures" id="editFetures" action="{{ url('admin/edit-fetures/'.$productDetails['id']) }}" method="post">
                                        @csrf
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" >
                                                <thead>
                                                <tr>
                                                    <th>SL.</th>
                                                    <th>Fetures Details</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($productDetails['product_fetures'] as $feture)
                                                    <input type="hidden" name="product_feture_id[]" value="{{ $feture['id'] }}">
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td><input type="text" name="fetures[]" class="form-control" value="{{ $feture['fetures'] }}"></td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm productFeatureconfirmDelete"  recordid="{{ route('feature.delete',$feture['id']) }}"><i class="zmdi zmdi-delete"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="row clearfix">
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-info">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="filter">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" >
                                            <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Filter Item</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($productDetails['filter_items'] as $filterItem)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ App\ItemPart::where('id',$filterItem['variant_id'])->value('item_parts_variant') }}</td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm filterItemConfirmDelete"  recordid="{{ route('productFilterItem.delete',$filterItem['id']) }}"><i class="zmdi zmdi-delete"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="header">
                                    <form name="editFetures" id="editFetures" action="{{ url('admin/edit-specificationHeader/'.$productDetails['id']) }}" method="post">
                                        @csrf
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" >
                                                <thead>
                                                <tr>
                                                    <th>SL.</th>
                                                    <th>Header</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($specification_header as $product_header)
                                                    <input type="hidden" name="header_id[]" value="{{ $product_header->id }}">
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td><input type="text" name="header[]" class="form-control" value="{{ $product_header->header }}"></td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm headerconfirmDelete"  recordid="{{ route('header.delete',$product_header->id) }}"><i class="zmdi zmdi-delete"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="row clearfix">
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-info">Update</button>
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
        </div>
    </div>
@endsection

@section('footer_section')
<script src="{{ asset('backend/assets/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
<script src="{{ asset('backend/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
<script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script> <!-- Bootstrap Tags Input Plugin Js -->
<script src="{{ asset('backend/assets/js/pages/forms/editors.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/summernote/dist/summernote.js') }}"></script>
@endsection
