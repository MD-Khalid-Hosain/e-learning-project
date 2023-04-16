@extends('backend.master')
@section('title')
    Exam Results
@endsection
@section('exam_result_active')
    active
@endsection
@section('exam_result_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Exam Results</h2>
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
                                        <th>Total Right Ans:</th>
                                        <th>Total Wrong Ans:</th>
                                        <th>Total Mark</th>
                                        <th>Status</th>
                                        <th>Submitted</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($allResult as $result)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ App\Student::where('id', $result->student_id)->value('email') }}</td>
                                            <td>{{ App\Student::where('id', $result->student_id)->value('number') }}</td>
                                            <td>{{ App\ExamEvent::where('id', $result->exam_id)->value('exam_title') }}</td>
                                            <td>{{ $result->total_right_ans }}</td>
                                            <td>{{ $result->total_wrong_ans }}</td>
                                            <td>{{ $result->total_mark }}</td>
                                            <td>
                                                <button data-toggle="modal" class="btn {{ $result->status == 'pending' ? 'btn-warning' : ($result->status == 'passed' ? 'btn-success' : 'btn-danger') }}" data-target="#exampleModalCenter">{{ $result->status }}</button></td>
                                            <td>{{ $result->created_at->format('d/m/Y')}}</td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form name="sectionForm" id="sectionForm" action="{{route('publish-result')}}"  method="POST">
                                                            @csrf
                                                            <input type="hidden" name="result_id" value="{{$result->id}}">
                                                            <div class="row clearfix ">
                                                                <div class="col-md-6 m-auto">
                                                                    <label for="status">Publish Result</label><span class="required" >*</span>
                                                                    <div class="form-group">
                                                                        <select name="status" id="status" class="form-control show-tick ms select2" data-placeholder="Select">
                                                                            <option value="">Select Status</option>
                                                                            <option value="passed">Passed</option>
                                                                            <option value="failed">Failed</option>
                                                                        </select>
                                                                        @error ('status')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
