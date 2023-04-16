@extends('backend.master')
@section('title')
    Exam Question List
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
                    <h2>Edit Question</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible" >
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 m-auto">
                    <div class="card">
                        <div class="body">
                            <form name="sectionForm" id="sectionForm" action="{{route('exam-question-update')}}"  method="POST">
                                @csrf
                                <input type="hidden" name="question_id" value="{{$questionDetails->id}}">
                                <input type="hidden" name="exam_id" value="{{$exam_id}}">
                                <div class="row clearfix ">
                                    <div class="col-md-6 m-auto">
                                        <label for="question">Exam Question</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="question" class="form-control" id="question" value="{{ $questionDetails->question }}">
                                            @error ('question')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="category_name">Question Point</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="point" class="form-control" id="point" value="{{  $questionDetails->point }}">
                                            @error ('point')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="right_answer">Question Right Answer</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="right_answer" class="form-control" id="right_answer"  value="{{ $questionDetails->right_answer }}">
                                            @error ('right_answer')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Update Question </button>
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
