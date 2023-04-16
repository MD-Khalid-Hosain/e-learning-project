@extends('backend.master')
@section('title')
  Request Exam List
@endsection

@section('requested_active')
    active
@endsection
@section('requested_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Exam Requested List</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Exam Requested</strong> List </h2>
                             @if (session('success'))
                            <div class="alert alert-success alert-dismissible" >
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                             @endif
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover  dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Exam Title</th>
                                            <th>Email</th>
                                            <th>Number</th>
                                            <th>Payment Status</th>
                                            <th>Exam Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allPendingExams as $exam)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ App\ExamEvent::where('id',$exam->exam_id)->value('exam_title') }}</td>
                                            <td>{{ App\Student::where('id',$exam->student_id)->value('email') }}</td>
                                            <td>{{ App\Student::where('id',$exam->student_id)->value('number') }}</td>
                                            <td>{{$exam->payment_status}}</td>
                                            <td>{{ App\ExamEvent::where('id',$exam->exam_id)->value('exam_date') }}</td>
                                            <td>Tk {{$exam->amount}}</td>
                                            <td>
                                                @if($exam->exam_confirmation_status == 'pending')
                                                <form class="d-inline" action="{{route('exam-confirm')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="confirm" value="confirmed">
                                                    <input type="hidden" name="payment_id" value="{{$exam->id}}">
                                                    <button type="submit" class="badge badge-warning">{{$exam->exam_confirmation_status}}</button>
                                                </form>
                                                @else
                                                    <span class="badge badge-success">{{$exam->exam_confirmation_status}}</span>
                                                @endif
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
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
    <script>
        $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection
