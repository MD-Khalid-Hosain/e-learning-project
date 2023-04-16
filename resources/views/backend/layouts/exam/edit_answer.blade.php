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
                    <h2>Edit Question Answer</h2>
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

            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12b m-auto">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Edit Question Option</strong></h2>
                            <i class="fas fa-toggle-on"></i>
                        </div>
                        <div class="body">
                            <form name="sectionForm" id="sectionForm" action="{{route('question-answer-update')}}"  method="POST">
                                @csrf
                                <input type="hidden" name="exam_id" value="{{$answerDetails->exam_id}}">
                                <input type="hidden" name="question_id" value="{{$answerDetails->question_id}}">
                                <input type="hidden" name="answer_id" value="{{$answerDetails->id}}">
                                <div class="row clearfix ">
                                    <div class="col-md-6 m-auto">
                                        <label for="answer">Options</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="answer" class="form-control" id="answer" value="{{ $answerDetails->answer }}">
                                            @error ('answer')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Update Answer</button>
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
@endsection
