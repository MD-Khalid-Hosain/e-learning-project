@extends('backend.master')
@section('header_section')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
<!-- Bootstrap Tagsinput Css -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/summernote/dist/summernote.css') }}"/>

@endsection
@section('title')
  Offer List
@endsection

@section('offer_settings_active')
active open
@endsection
@section('offer_active')
    active
@endsection
@section('offer_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>All Offer</h2>
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
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Offers</strong></h2>
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
                             @if (session('success'))
                            <div class="alert alert-success alert-dismissible" >
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                             @endif
                            <form action="{{ route('offer.update') }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="offer_name">Offer Name</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" id="offer_name"  name="offer_name" class="form-control" value="{{ $offer->offer_name }}" >
                                            @error ('offer_name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="slug">Offer Slug</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" id="slug"  name="slug" class="form-control" value="{{ $offer->slug }}">
                                            @error ('slug')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="offer_type">Offer Type</label><span class="required">*</span>
                                        <div class="form-group">
                                            <div class="form-group" style="text-align:center">
                                        <select name="offer_type" id="offer_type" class="form-control show-tick ms select2" data-placeholder="Select">
                                            <option >--Select Offer Type--</option>
                                            <option @if ($offer->offer_type == "percentage") selected @endif value="percentage">Percentage</option>
                                            <option @if ($offer->offer_type == "gift_offer") selected @endif value="gift_offer">Gift</option>
                                            <option @if ($offer->offer_type == "cash_back") selected @endif value="cash_back">Cash Back Offer</option>
                                            <option @if ($offer->offer_type == "coupon") selected @endif value="coupon">Coupon</option>
                                        </select>
                                         @error ('offer_type')
                                                <small class="text-danger">{{ $message }}</small>
                                             @enderror
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="offer_title">Offer Title</label>
                                        <div class="form-group">
                                            <input type="text" id="offer_title"  name="offer_title" class="form-control" value="{{ $offer->offer_title }}" >
                                            @error ('offer_title')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="description">Description</label><span class="required">*</span>
                                        <div class="form-group">
                                            <textarea name="description"  class="form-control summernote"  rows="9">{{ $offer->description }}</textarea>
                                            @error ('description')
                                                <small class="text-danger">{{ $message }}</small>
                                             @enderror
                                        </div>
                                        <label for="meta_description">Meta Description</label>
                                        <div class="form-group">
                                            <textarea name="meta_description"  class="form-control"  rows="9">{{ $offer->meta_description }}</textarea>
                                            @error ('meta_description')
                                                <small class="text-danger">{{ $message }}</small>
                                             @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="start_date">Start Date</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="date" id="start_date"  name="start_date" class="form-control" value="{{ $offer->start_date }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                            @error ('start_date')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="end_date">End Date</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="date" id="end_date"  name="end_date" class="form-control" value="{{ $offer->end_date }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" >
                                            @error ('end_date')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                         <label for="end_date">Select Product</label><span class="required">*</span>
                                        <select class="form-control show-tick ms select2" multiple data-placeholder="Select" name="product_id[]">

                                            @foreach ($allProducts as $product)
                                            <option @foreach ($offerProducts as $already_selected_product)@if ($already_selected_product->id == $product->id) selected @endif value="{{ $product->id }}" @endforeach>{{ $product->product_name }}</option>
                                            {{-- <option value="{{ $product->id }}">{{ $product->product_name }}</option> --}}
                                            @endforeach
                                        </select>

                                        <div class="form-group">
                                            <label for="image">Offer Image</label><span class="required">*</span>
                                            <input type="file" id="image"  name="image" class="form-control" >
                                            @error ('image')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" id="meta_title" value="{{ $offer->meta_title }}"  name="meta_title" class="form-control" >
                                            @error ('meta_title')
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
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover  dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Offer Name</th>
                                            <th>Previous Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($offerProducts as $product)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td><a href="{{ route('product-details',$product->slug) }}" target="_blank">{{ $product->product_name }}</a></td>
                                                <td>{{ $product->price }}</td>
                                                <td>@if ($product->offer_id == null) N/A @else {{ $product->offer->offer_name }} @endif</td>
                                                <td>@if($product->previous_price == null) N/A  @else {{ $product->previous_price }} @endif</td>
                                                <td>
                                                    <a href="{{ url('admin/edit-product',$product->id) }}" target="_blank" class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i></a>
                                                    {{-- <a href="javascript:void(0)" class="btn btn-danger btn-sm confirmDeleteComponent" recordid="" ><i class="zmdi zmdi-delete"></i></a> --}}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_section')
    <script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
    <!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('backend/assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/pages/tables/jquery-datatable.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
<script src="{{ asset('backend/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
<script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
<script src="{{ asset('backend/assets/js/pages/forms/editors.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/summernote/dist/summernote.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script> <!-- Bootstrap Tags Input Plugin Js -->
<script>
    $("#offer_name").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#slug").val(Text);
    });
</script>
@endsection
