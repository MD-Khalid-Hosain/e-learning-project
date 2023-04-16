@extends('backend.master')
@section('title')
    Exam Answer List
@endsection

@section('exam_active')
    active
@endsection
@section('exam_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Exam Question Answer</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
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
            @if (session('delete_message'))
                <div class="alert alert-danger alert-dismissible" >
                    <strong>{{ session('delete_message') }}</strong>
                    <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <h3><span class="font-weight-bold"><a href="{{route('exam-event.index')}}">Exam:</a></span> {{$examTitle->exam_title}}</h3>
            <h3><span class="font-weight-bold"><a href="{{route('exam-question',$examTitle->id )}}">Question:</a></span> {{$question->question}}</h3>
            <h6><span class="font-weight-bold">Right Ans:</span> {{$question->right_answer}}</h6>
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Answer List</strong></h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover  dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Answer</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($allAnswer as $answer)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $answer->answer }}</td>
                                            <td>
                                                <a href="{{route('question-answer-edit', $answer->id )}}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i></a>
                                                <form class="d-inline" action="{{route('question-answer-delete',$answer->id )}}" method="GET">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm show_confirm"  data-toggle="tooltip" title='Delete'><i class="zmdi zmdi-delete"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Add Question Options</strong></h2>
                            <i class="fas fa-toggle-on"></i>
                        </div>
                        <div class="body">
                            <form name="sectionForm" id="sectionForm" action="{{route('question-answer-store')}}"  method="POST">
                                @csrf
                                <input type="hidden" name="exam_id" value="{{$examTitle->id}}">
                                <input type="hidden" name="question_id" value="{{$question->id}}">
                                <div class="row clearfix ">
                                    <div class="col-md-6 m-auto">
                                        <label for="answer">Options</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="answer" class="form-control" id="answer" value="{{ old('answer') }}">
                                            @error ('answer')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Create Answer </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('footer_section')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
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
                    var name = $(this).data("name");
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
