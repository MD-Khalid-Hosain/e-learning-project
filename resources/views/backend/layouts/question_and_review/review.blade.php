@extends('backend.master')
@section('title')
  Review List
@endsection

@section('review_settings_active')
active open
@endsection
@section('review_active')
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
                    <h2>Review</h2>
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
                            <h2><strong>Review</strong> List </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover  dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Name</th>
                                            <th>Product</th>
                                            <th>Comment</th>
                                            <th>Rating</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allReviews as $review)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $review->name }}</td>
                                            <td><a href="{{ route('product-details',$review->product->slug) }}" target="_blank">{{ $review->product->product_name }}</a></td>
                                            <td>{{ $review->comment }}</td>
                                            <td>{{ $review->rating }}</td>
                                            <td>
                                                @if ($review->status == 1)
                                                    <a class="updateReviewStatus" id="review-{{ $review->id }}" review_id="{{ $review->id }}" href="javascript:void(0)" style="color:green">Approved</a>
                                                    @else
                                                    <a class="updateReviewStatus" id="review-{{ $review->id }}" review_id="{{ $review->id }}" href="javascript:void(0)" style="color:red">Disapproved</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm confirmDeleteReview" recordid="{{ route('delete-review',$review->id) }}"><i class="zmdi zmdi-delete"></i></a>
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
    <input type="hidden" id="updateReviewStatus" value="{{ route('update-review-status') }}">
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
