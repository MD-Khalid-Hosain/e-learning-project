@extends('backend.master')
@section('header_section')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
@endsection
@section('discount_section_active')
active open
@endsection
@section('discount_active')
    active
@endsection
@section('discount_toggled')
    toggled waves-effect waves-block
@endsection
@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Jquery DataTables</h2>
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
                            <h2><strong>Edit Discount Coupon</strong></h2>
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
                            <form action="{{ route('coupon-update') }}" method="POST"  id="updatPwdForm">
                                @csrf
                                <input type="hidden" name="discount_id" value="{{ $discounts->id }}">
                                <div class="form-row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label for="coupon">Coupon Code</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" id="coupon" value="{{ $discounts->coupon }}"  name="coupon" class="form-control" >
                                            @error ('coupon')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label for="selectType">Type</label><span class="required">*</span>
                                        <div class="form-group">
                                            <select name="type" id="selectType"class="form-control show-tick ms select2">
                                                <option >Select Coupon Type</option>
                                                <option value="total" @if ($discounts->type == 'total') selected @else @endif>Total</option>
                                                <option value="product type" @if ($discounts->type == 'product type') selected @else @endif>Product</option>
                                                <option value="category type"@if ($discounts->type == 'category type') selected @else @endif>Category</option>
                                            </select>
                                            @error ('type')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label for="percentage">Percentage(%)</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" id="percentage" value="{{ $discounts->percentage }}" name="percentage" class="form-control" >
                                            @error ('percentage')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label for="max_amount">Max Amount</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="max_amount" value="{{ $discounts->max_amount }}" id="max_amount" class="form-control">
                                            @error ('max_amount')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row" >
                                    <div class="col-lg-4 col-md-6 col-sm-12" id="categoryId">
                                        <label for="category_id">Select Category</label><span class="required">*</span>
                                        <select name="category_id" id="category_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                            <option value="NULL">---Select Category---</option>
                                            @foreach ($categories as $sections)
                                                <option class="font-weight-bold" disabled>{{ $sections['section_name'] }}</option>
                                                @foreach ($sections['categories'] as $category)
                                                    <option class="pl-3" value="{{ $category['id'] }}" @if (isset($discounts->category_id) && ($discounts->category_id == $category['id'])) selected @else @endif>--&nbsp;{{ $category['category_name'] }}</option>
                                                    @foreach ($category['subcategories'] as $subcategory)
                                                         <option class="pl-5" value="{{ $subcategory['id'] }}" @if (isset($discounts->category_id) && ($discounts->category_id == $subcategory['id'])) selected @else @endif>&nbsp;&nbsp;-&nbsp;{{ $subcategory['category_name'] }}</option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                        @error ('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12" id="productId">
                                        <label for="product_id">Product</label><span class="required">*</span>
                                        <div class="form-group">
                                            <select name="product_id" id="product_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                                <option >Select Product</option>
                                                @foreach ($allProducts as $product)
                                                    <option value="{{ $product->id }}" @if (isset($discounts->product_id) && ($discounts->product_id == $product->id)) selected @else @endif>{{ $product->product_name }}</option>
                                                @endforeach
                                            </select>
                                            @error ('product_id')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label for="start_date">Start Date</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="date" id="start_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $discounts->start_date }}" name="start_date" class="form-control" >
                                            @error ('percentage')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label for="end_date">End Date</label><span class="required">*</span>
                                        <div class="input-group">
                                            <input type="date" id="end_date" value="{{ $discounts->end_date }}"  name="end_date" class="form-control" placeholder="Please choose date & time...">
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
    {{-- <input type="hidden" id="updateHomeImageStatus" value="{{ route('update-homeImage-status') }}"> --}}
@endsection

@section('footer_section')
    <script src="{{ asset('backend/assets/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
    <script src="{{ asset('backend/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
    <script>
    $(document).ready(function(){
        //item type append with category
         $('#selectType').on('change',function() {
                if(this.value == 'total'){
                    $("#categoryId").hide();
                    $("#productId").hide();
                }
                else if(this.value == 'product type')
                {
                    $("#categoryId").hide();
                    $("#productId").show();

                }
                else if(this.value == 'category type'){

                    $("#productId").hide();
                    $("#categoryId").show();
                }else{

                    $("#categoryId").show();
                    $("#productId").show();
                }
            }).change();
    });
</script>
@endsection
