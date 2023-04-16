@extends('backend.master')
@section('title')
  Brand List
@endsection

@section('section_settings_active')
active open
@endsection
@section('brand_active')
    active
@endsection
@section('brand_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Brands</h2>
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
                    <div class="card">
                        <div class="header">
                            <h2><strong>Brands</strong> List </h2>
                             @if (session('success'))
                            <div class="alert alert-success alert-dismissible" >
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                             @endif
                            <a href="{{ url('/admin/add-brand-form') }}" class="btn btn-labeled btn-info float-right my-3">
                            <span class="btn-label"><i class="zmdi zmdi-plus font-weight-bold pr-2"></i></span>Add Brand</a>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover  dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Brand Name</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $brand)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $brand->name }}</td>
                                            <td><img src="{{ asset('backend/uploads/brand_image') }}/{{ $brand->image }}" alt="{{ $brand->name }}" width="50"></td>
                                            <td>
                                                @if ($brand->status == 1)
                                                    <a class="updateBrandStatus" id="brand-{{ $brand->id }}" brand_id="{{ $brand->id}}" href="javascript:void(0)" style="color:green">Active</i></a>
                                                    @else
                                                    <a class="updateBrandStatus" id="brand-{{ $brand->id }}" brand_id="{{ $brand->id }}" href="javascript:void(0)" style="color:red">Inactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/edit-brand/'.$brand->id) }}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm confirmDeleteBrand" recordid="{{ route('delete.brand',$brand->id) }}"><i class="zmdi zmdi-delete"></i></a>
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
    <input type="hidden" id="updateBrandStatus" value="{{ route('update-brand-status') }}">
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
