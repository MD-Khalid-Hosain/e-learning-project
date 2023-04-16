@extends('backend.master')
@section('title')
  Section List
@endsection

@section('section_settings_active')
active open
@endsection
@section('section_active')
    active
@endsection
@section('section_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Section</h2>
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
                    <div class="col-lg-12">
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
                    <div class="card">
                        <div class="header">
                            <h2><strong>Section</strong> List </h2>
                            <a href="{{ url('/admin/add-edit-section') }}" class="btn btn-labeled btn-info float-right my-3">
                            <span class="btn-label"><i class="zmdi zmdi-plus font-weight-bold pr-2"></i></span>Add Section</a>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover  dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Section Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allSections as $section)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $section->section_name }}</td>
                                            <td>
                                                @if ($section->Status == 1)
                                                    <a class="updateSectionStatus" id="section-{{ $section->id }}" section_id="{{ $section->id }}" href="javascript:void(0)" style="color:green">Active</a>
                                                    @else
                                                    <a class="updateSectionStatus" id="section-{{ $section->id }}" section_id="{{ $section->id }}" href="javascript:void(0)" style="color:red">Inactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/add-edit-section') }}/{{ $section->id }}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm confirmDeleteSection" record="section" recordid="{{ route('delete.section',$section->id) }}"><i class="zmdi zmdi-delete"></i></a>
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
    <input type="hidden" id="updateSectionStatus" value="{{ route('update-section-status') }}">
@endsection
@section('footer_section')
    <script src="{{ asset('public/backend/assets/admin_js/admin_script.js') }}"></script>
    <!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('public/backend/assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('public/backend/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/backend/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/backend/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('public/backend/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('public/backend/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('public/backend/assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/pages/tables/jquery-datatable.js') }}"></script>
@endsection
