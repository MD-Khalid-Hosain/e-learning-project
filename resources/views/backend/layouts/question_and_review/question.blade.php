@extends('backend.master')
@section('title')
  Question List
@endsection

@section('review_settings_active')
active open
@endsection
@section('question_active')
    active
@endsection
@section('review_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Questions</h2>
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
                            <h2><strong>Qestions</strong> List </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover  dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Name</th>
                                            <th>Number</th>
                                            <th>Qusetion</th>
                                            <th>Answer</th>
                                            <th>Product</th>
                                            <th>Admin</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allQuestions as $question)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $question->customer_name }}</td>
                                            <td>{{ $question->customer_number }}</td>
                                            <td>{{ $question->question }}</td>
                                            <td style="color:{{ $question->answer == null ? "red" : ""}}">{{ $question->answer == null ? "Not Answered" : $question->admin->name }}</td>
                                            <td><a href="{{ route('product-details',$question->product->slug) }}" target="_blank">{{ $question->product->product_name }}</a></td>
                                            <td>{{ $question->admin_id == null ? "No one" : $question->admin->name }}</td>
                                            <td>
                                                <a href="{{ route('answer.page',$question->id) }}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-eye"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm confirmDeleteQuestion" recordid="{{ route('delete.question',$question->id) }}"><i class="zmdi zmdi-delete"></i></a>
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
    {{-- <input type="hidden" id="updateReviewStatus" value="{{ route('update-review-status') }}"> --}}
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
