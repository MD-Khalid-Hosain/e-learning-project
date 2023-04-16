@extends('backend.master')
@section('title')
    Edit Exam
@endsection
@section('exam_active')
    active
@endsection
@section('exam_toggled')
    toggled waves-effect waves-block
@endsection
@section('header_section')
    <!-- Select2 -->
    {{--    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />--}}
    {{--    <!-- Bootstrap Tagsinput Css -->--}}
    {{--    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/summernote/dist/summernote.css') }}"/>--}}
    <link href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet"
          type="text/css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.3/jquery.timepicker.min.css">


@endsection
@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit Exam</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Edit Exam</strong></h2>
                            <i class="fas fa-toggle-on"></i>
                        </div>
                        <div class="body">
                            <form name="courseForm" id="courseForm"action="{{route('exam-event.update',$examDetails->id )}}"   method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row clearfix ">
                                    <div class="col-md-6 ">
                                        <label for="title">Exam Title</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="exam_title" class="form-control" id="exam_title" value="{{ $examDetails->exam_title }}" >
                                            @error ('exam_title')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="outcomes">Exam Date</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="exam_date" class="form-control" value="{{\Carbon\Carbon::parse($examDetails->exam_date)->translatedFormat('d/m/Y')}}" id="date_picker" >
                                            @error ('exam_date')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <label for="description">Exam Duration</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input name="exam_duration" type="number" class="form-control" value="{{ $examDetails->exam_duration}}">
                                            @error ('exam_duration')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <label for="slug">Exam Slug</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="slug" class="form-control" id="slug" value="{{ $examDetails->slug}}" >
                                            @error ('slug')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="fee">Exam Time</label><span class="required">*</span>
                                        <div class="form-group">
                                            {{--                                            <input type="text" name="time" class="form-control"  id="timepicker">--}}
                                            {{--                                            @error ('time')--}}
                                            {{--                                            <small class="text-danger">{{ $message }}</small>--}}
                                            {{--                                            @enderror--}}
                                            <select name="time" id="" class="form-control">
                                                <option value="">Select Time</option>
                                                <option value="12:00 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '12:00 AM') selected @endif>12:00 AM</option>
                                                <option value="12:30 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '12:30 AM') selected @endif>12:30 AM</option>
                                                <option value="1:00 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '1:00 AM') selected @endif>01:00 AM</option>
                                                <option value="1:30 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '1:30 AM') selected @endif>01:30 AM</option>
                                                <option value="2:00 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '2:00 AM') selected @endif>02:00 AM</option>
                                                <option value="2:30 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '2:30 AM') selected @endif>02:30 AM</option>
                                                <option value="3:00 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '3:00 AM') selected @endif>03:00 AM</option>
                                                <option value="3:30 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '3:30 AM') selected @endif>03:30 AM</option>
                                                <option value="4:00 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '4:00 AM') selected @endif>04:00 AM</option>
                                                <option value="4:30 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '4:30 AM') selected @endif>04:30 AM</option>
                                                <option value="5:00 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '5:00 AM') selected @endif>05:00 AM</option>
                                                <option value="5:30 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '5:30 AM') selected @endif>05:30 AM</option>
                                                <option value="6:00 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '6:00 AM') selected @endif>06:00 AM</option>
                                                <option value="6:30 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '6:30 AM') selected @endif>06:30 AM</option>
                                                <option value="7:00 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '7:00 AM') selected @endif>07:00 AM</option>
                                                <option value="7:30 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '7:30 AM') selected @endif>07:30 AM</option>
                                                <option value="8:00 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '8:00 AM') selected @endif>08:00 AM</option>
                                                <option value="8:30 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '8:30 AM') selected @endif>08:30 AM</option>
                                                <option value="9:00 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '9:00 AM') selected @endif>09:00 AM</option>
                                                <option value="9:30 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '9:30 AM') selected @endif>09:30 AM</option>
                                                <option value="10:00 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '10:00 AM') selected @endif>10:00 AM</option>
                                                <option value="10:30 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '10:30 AM') selected @endif>10:30 AM</option>
                                                <option value="11:00 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '11:00 AM') selected @endif>11:00 AM</option>
                                                <option value="11:30 AM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '11:30 AM') selected @endif>11:30 AM</option>
                                                <option value="12:00 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '12:00 PM') selected @endif>12:00 PM</option>
                                                <option value="12:30 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '12:30 PM') selected @endif>12:30 PM</option>
                                                <option value="1:00 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '1:00 PM') selected @endif>01:00 pM</option>
                                                <option value="1:30 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '1:30 PM') selected @endif>01:30 pM</option>
                                                <option value="2:00 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '2:00 PM') selected @endif>02:00 pM</option>
                                                <option value="2:30 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '2:30 PM') selected @endif>02:30 pM</option>
                                                <option value="3:00 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '3:00 PM') selected @endif>03:00 pM</option>
                                                <option value="3:30 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '3:30 PM') selected @endif>03:30 pM</option>
                                                <option value="4:00 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '4:00 PM') selected @endif>04:00 pM</option>
                                                <option value="4:30 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '4:30 PM') selected @endif>04:30 pM</option>
                                                <option value="5:00 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '5:00 PM') selected @endif>05:00 pM</option>
                                                <option value="5:30 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '5:30 PM') selected @endif>05:30 pM</option>
                                                <option value="6:00 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '6:00 PM') selected @endif>06:00 pM</option>
                                                <option value="6:30 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '6:30 PM') selected @endif>06:30 pM</option>
                                                <option value="7:00 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '7:00 PM') selected @endif>07:00 pM</option>
                                                <option value="7:30 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '7:30 PM') selected @endif>07:30 pM</option>
                                                <option value="8:00 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '8:00 PM') selected @endif>08:00 pM</option>
                                                <option value="8:30 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '8:30 PM') selected @endif>08:30 pM</option>
                                                <option value="9:00 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '9:00 PM') selected @endif>09:00 pM</option>
                                                <option value="9:30 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '9:30 PM') selected @endif>09:30 pM</option>
                                                <option value="10:00 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '10:00 PM') selected @endif>10:00 pM</option>
                                                <option value="10:30 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '10:30 PM') selected @endif>10:30 pM</option>
                                                <option value="11:00 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '11:00 PM') selected @endif>11:00 pM</option>
                                                <option value="11:30 PM" @if(\Carbon\Carbon::parse($examDetails->time)->translatedFormat('g:i A') == '11:30 PM') selected @endif>11:30 pM</option>
                                            </select>
                                        </div>
                                        <label for="fee">Exam Fee</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="exam_fee" class="form-control" id="fee" value="{{$examDetails->exam_fee}}">
                                            @error ('exam_fee')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Update Exam</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--      <input type="text" id="getValue" value="1000">--}}
@endsection
@section('footer_section')
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.3/jquery.timepicker.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#date_picker").datepicker({
                minDate: 0
            });
            $( "#timepicker" ).timepicker();
        });
        $("#exam_title").keyup(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
            $("#slug").val(Text);
        });

    </script>
@endsection
