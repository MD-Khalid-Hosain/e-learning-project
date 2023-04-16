@extends('backend.master')
@section('title')
    Exam Report
@endsection
@section('exam_report_active')
    active
@endsection
@section('exam_report_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2> All Payment of @isset($date) {{ $date }} and Total Payment = {{ number_format($sum)}}Tk  @else @isset($month) {{ $month }}, {{ $year }} and Total Payment= {{ number_format($sum)}}Tk @else @isset($from) {{ $from }} to {{ $to }} and Total Payment = {{ number_format($sum)}}Tk @else Year-{{ $year }} and Total Payment = {{ number_format($sum)}}Tk   @endisset @endisset @endisset</h2>
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
{{--                    <form action="" method="POST">--}}
{{--                        @csrf--}}
{{--                        @isset($date)--}}
{{--                            <input type="hidden" name="date" value="{{ $date }}">--}}
{{--                            <button class="btn btn-primary " type="submit">Download</button>--}}
{{--                        @else--}}
{{--                            @isset($month)--}}
{{--                                <input type="hidden" name="month" value="{{ $month }}">--}}
{{--                                <input type="hidden" name="year" value="{{ $year }}">--}}
{{--                                <button class="btn btn-primary " type="submit">Download</button>--}}
{{--                            @else @isset($from)--}}
{{--                                <input type="hidden" name="from" value="{{ $from }}">--}}
{{--                                <input type="hidden" name="to" value="{{ $to }}">--}}
{{--                                <button class="btn btn-primary " type="submit">Download</button>--}}
{{--                            @else--}}
{{--                                <input type="hidden" name="year" value="{{ $year }}">--}}
{{--                                <button class="btn btn-primary " type="submit">Download</button>--}}
{{--                            @endisset @endisset @endisset--}}
{{--                    </form>--}}
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover  dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Student Email</th>
                                        <th>Number</th>
                                        <th>Exam Title</th>
                                        <th>Amount</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($allOrders as $order)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ App\Student::where('id',$order->student_id)->value('email') }}</td>
                                            <td>{{ App\Student::where('id',$order->student_id)->value('number') }}</td>
                                            <td>{{ App\ExamEvent::where('id',$order->exam_id)->value('exam_title') }}</td>
                                            <td>Tk {{ $order->amount }}</td>
                                            <td>{{ $order->created_at->format('d/m/Y')}}</td>
                                            <td><a href="{{route('student-invoice-download',$order->id)}}" class="btn btn-primary">Download</a></td>
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
