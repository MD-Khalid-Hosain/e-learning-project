@extends('backend.master')
@section('title')
    Course Review
@endsection
@section('course_review_active')
    active
@endsection
@section('course_review_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Course Review</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>

                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
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
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover  dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Course</th>
                                        <th>Student Email</th>
                                        <th>Student Name</th>
                                        <th>Ratting</th>
                                        <th>Comment</th>
                                        <th>Created</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($allReview as $review)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ App\Course::where('id', $review->course_id)->value('title') }}</td>
                                            <td>{{ App\Student::where('id', $review->student_id)->value('email') }}</td>
                                            <td>{{ App\Student::where('id', $review->student_id)->value('first_name') .' '.App\Student::where('id', $review->student_id)->value('last_name')  }}</td>
                                            <td>{{$review->ratting}}</td>
                                            <td>{{$review->comment}}</td>
                                            <td>{{$review->created_at->translatedFormat('d-M-Y g:i A')}}</td>
                                            <td>
                                                <a href="{{route('review-update', $review->id)}}" class="btn {{ $review->status == 0 ? 'btn-warning': 'btn-success' }}">{{ $review->status == 0 ? 'Pending' : 'Approved'}}</a></td>
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

@endsection
