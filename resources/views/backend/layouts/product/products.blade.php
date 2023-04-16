@extends('backend.master')
@section('title')
  Product List
@endsection

@section('product_settings_active')
active open
@endsection
@section('product_active')
    active
@endsection
@section('product_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Products</h2>
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
                            <h2><strong>Product</strong> List </h2>
                            <a href="{{ url('/admin/add-product') }}" class="btn btn-labeled btn-info float-right my-3">
                            <span class="btn-label"><i class="zmdi zmdi-plus font-weight-bold pr-2"></i></span>Add Product</a>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover  dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Product Name</th>
                                            <th>Section</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Created Admin</th>
                                            <th>Updated Admin</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->section->section_name}}</td>
                                            <td>{{ $product->category->category_name}}</td>
                                            <td>{{ $product->brand->name}}</td>
                                            <td>{{ $product->admin->name}}</td>
                                            <td>{{ App\Admin::where('id',$product->updated_admin_id)->value('name')}}</td>
                                            <td>{{ substr(strip_tags($product->product_description), 0, 30) }}{{ strlen(strip_tags($product->product_description)) > 30 ? "....": "" }} </td>
                                            <td>
                                                @if ($product->status == 1)
                                                    <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" href="javascript:void(0)" style="color:green">Active</a>
                                                    @else
                                                    <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" href="javascript:void(0)" style="color:red">Inactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($product->created_at))
                                                    {{ $product->created_at->format('d/m/Y') }}
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($product->updated_at))
                                                    {{ $product->updated_at->diffForHumans() }}
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/add-productAllSepecification/'.$product->id) }}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-plus font-weight-bold"></i></a>
                                                <a href="{{ url('admin/product-details/'.$product->id) }}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-eye"></i></a>
                                                <a href="{{ url('admin/edit-product/'.$product->id) }}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm productConfirmDelete"  recordid="{{ route('delete.product',$product->id) }}"><i class="zmdi zmdi-delete"></i></a>
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
    <input type="hidden" id="updateProductStatus" value="{{ route('update-product-status') }}">
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
@endsection
