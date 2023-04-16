<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exam</title>
    <link rel="favicon" href="{{ asset('frontend/img/icons/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('frontend/img/icons/icon.png') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.webui-popover.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
</head>
<body>
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12 m-auto">
            <div class="mb-3">
                <h2>{{ucfirst($examDetails->exam_title)}}</h2>
                <h5 class="d-inline">Total Marks: {{$totalMarks}}</h5>
                <h5 class="d-inline mr-5 pl-5">Duration: {{$examDetails->exam_duration}}</h5>
                <h5 class=" d-inline">Finish the exam within <span id="time" style="color: red; font-weight: bolder">05:00</span> minutes!</h5>
            </div>

            <ul>
                <form id="examForm" action="{{route('store-question-answer')}}" method="post">
                    @csrf

                    @foreach($questions as $key=>$question)
                        <input type="hidden" name="question_id{{$key+1}}" value="{{$question->id}}" />
                        <input type="hidden" name="ans{{$key+1}}" value="0" />
                        <li style="list-style: none" class="font-weight-bold">{{$key+1}}# {{$question->question}}</li>
                        <ul style="list-style: none">
                            @foreach(App\Answer::where('exam_id', $examDetails->id)->where('question_id', $question->id)->get() as $answer)
                                <li> <input type="radio" name="ans{{$key+1}}" value="{{$answer->answer}}" /> {{$answer->answer }}</li>
                            @endforeach
                        </ul>

                    @endforeach
                    <input type="hidden" name="exam_id" value="{{$examDetails->id}}">
                    <input type="hidden" name="index" value="@php echo $key+1 @endphp">
                    <button type="submit" class="btn btn-primary mt-3">submit</button>
                </form>

            </ul>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" data-backdrop="static" >
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hey! You can not leave the page before submit the quiz </h4>
            </div>
            <div class="modal-body">
                <p>Please submit your exam first</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
            </div>
        </div>

    </div>
</div>
<input type="hidden" id="getValue" value="{{$examDetails->exam_duration * 60000}}">
<script src="{{ asset('frontend/js/vendor/modernizr-3.5.0.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/slick.min.js') }}"></script>
<script src="{{ asset('frontend/js/select2.min.js') }}"></script>
<script src="{{ asset('frontend/js/tinymce.min.js') }}"></script>
<script src="{{ asset('frontend/js/multi-step-modal.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.webui-popover.min.js') }}"></script>
<script src="https://content.jwplatform.com/libraries/O7BMTay5.js"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    // $(document).ready(function () {
    //     $('#openApp')[0].click();
    // });

    $(window).blur(function(e) {
        // Do Blur Actions Here
    });
    $(function() {
        let time = $("#getValue").val();
        setTimeout(function() {
            $('#examForm').submit();
        }, time);

        $(window).bind('beforeunload', function(){
            $('#examForm').submit();
        });
        $("html").bind("mouseleave", function () {
            $('#myModal').modal();
            // $('#examForm').submit();
        });
        $(window).blur(function() {
            $('#examForm').submit();
            //do something else
        });

    });
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

    window.onload = function () {
        let time = $("#getValue").val();
        var fiveMinutes = 60 * (time/60000),
            display = document.querySelector('#time');
        startTimer(fiveMinutes, display);
    };
    // function myfun(){
    //     // Write your business logic here
    //     console.log('hello');
    // }
    // window.onbeforeunload = function(){
    //     myfun();
    //     return 'Are you sure you want to leave?';
    // };
    // function disableBackButton() {
    //     alert('kkk')
    //
    //     window.history.pushState(null, "", window.location.href);
    //     window.onpopstate = function() {
    //         window.history.pushState(null, "", window.location.href);
    //     };
    //
    //     $("#message").text("Successfully!, Browser back button disabled").delay(2000).fadeOut(1000);
    // }

</script>
</body>
</html>
{{--@extends('Frontend.elearning.layouts.app')--}}
{{--@section('header_script')--}}
{{--    <script type="text/javascript" >--}}
{{--        function preventBack(){window.history.forward();}--}}
{{--        setTimeout("preventBack()", 0);--}}
{{--        window.onunload=function(){null};--}}
{{--    </script>--}}
{{--@endsection--}}
{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row mt-5">--}}
{{--        <div class="col-lg-12 m-auto">--}}
{{--            <div class="mb-3">--}}
{{--                <h2>{{ucfirst($examDetails->exam_title)}}</h2>--}}
{{--                <h5 class="d-inline">Total Marks: {{$totalMarks}}</h5>--}}
{{--                <h5 class="d-inline mr-5 pl-5">Duration: {{$examDetails->exam_duration}}</h5>--}}
{{--                <h5 class=" d-inline">Finish the exam within <span id="time" style="color: red; font-weight: bolder">05:00</span> minutes!</h5>--}}
{{--            </div>--}}

{{--            <ul>--}}
{{--                <form id="examForm" action="{{route('store-question-answer')}}" method="post">--}}
{{--                    @csrf--}}

{{--                    @foreach($questions as $key=>$question)--}}
{{--                        <input type="hidden" name="question_id{{$key+1}}" value="{{$question->id}}" />--}}
{{--                        <input type="hidden" name="ans{{$key+1}}" value="0" />--}}
{{--                        <li style="list-style: none" class="font-weight-bold">{{$key+1}}# {{$question->question}}</li>--}}
{{--                        <ul style="list-style: none">--}}
{{--                            @foreach(App\Answer::where('exam_id', $examDetails->id)->where('question_id', $question->id)->get() as $answer)--}}
{{--                                <li> <input type="radio" name="ans{{$key+1}}" value="{{$answer->answer}}" /> {{$answer->answer }}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}

{{--                    @endforeach--}}
{{--                    <input type="hidden" name="exam_id" value="{{$examDetails->id}}">--}}
{{--                    <input type="hidden" name="index" value="@php echo $key+1 @endphp">--}}
{{--                    <button type="submit" class="btn btn-primary mt-3">submit</button>--}}
{{--                </form>--}}

{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- Modal -->--}}
{{--<div class="modal fade" id="myModal" role="dialog">--}}
{{--    <div class="modal-dialog">--}}

{{--        <!-- Modal content-->--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h4 class="modal-title">Hey! You can not leave the page before submit the quiz </h4>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <p>Please submit your exam first</p>--}}
{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</div>--}}
{{--<input type="hidden" id="getValue" value="{{$examDetails->exam_duration * 60000}}">--}}
{{--<button onclick="disableBackButton()" id="openApp">Click to Disable</button>--}}
{{--@endsection--}}
{{--@section('scripts')--}}
{{--    <script>--}}
{{--        // $(document).ready(function () {--}}
{{--        //     $('#openApp')[0].click();--}}
{{--        // });--}}

{{--        $(function() {--}}
{{--            let time = $("#getValue").val();--}}
{{--            setTimeout(function() {--}}
{{--                $('#examForm').submit();--}}
{{--            }, time);--}}

{{--            // $(window).bind('beforeunload', function(){--}}
{{--            //     $('#examForm').submit();--}}
{{--            //     return 'Are you sure you want to leave?';--}}
{{--            // });--}}
{{--            // $("html").bind("mouseleave", function () {--}}
{{--            //     $('#myModal').modal();--}}
{{--            // });--}}

{{--        });--}}
{{--        function startTimer(duration, display) {--}}
{{--            var timer = duration, minutes, seconds;--}}
{{--            setInterval(function () {--}}
{{--                minutes = parseInt(timer / 60, 10)--}}
{{--                seconds = parseInt(timer % 60, 10);--}}

{{--                minutes = minutes < 10 ? "0" + minutes : minutes;--}}
{{--                seconds = seconds < 10 ? "0" + seconds : seconds;--}}

{{--                display.textContent = minutes + ":" + seconds;--}}

{{--                if (--timer < 0) {--}}
{{--                    timer = duration;--}}
{{--                }--}}
{{--            }, 1000);--}}
{{--        }--}}

{{--        window.onload = function () {--}}
{{--            let time = $("#getValue").val();--}}
{{--            var fiveMinutes = 60 * (time/60000),--}}
{{--                display = document.querySelector('#time');--}}
{{--            startTimer(fiveMinutes, display);--}}
{{--        };--}}
{{--        // function myfun(){--}}
{{--        //     // Write your business logic here--}}
{{--        //     console.log('hello');--}}
{{--        // }--}}
{{--        // window.onbeforeunload = function(){--}}
{{--        //     myfun();--}}
{{--        //     return 'Are you sure you want to leave?';--}}
{{--        // };--}}
{{--        // function disableBackButton() {--}}
{{--        //     alert('kkk')--}}
{{--        //--}}
{{--        //     window.history.pushState(null, "", window.location.href);--}}
{{--        //     window.onpopstate = function() {--}}
{{--        //         window.history.pushState(null, "", window.location.href);--}}
{{--        //     };--}}
{{--        //--}}
{{--        //     $("#message").text("Successfully!, Browser back button disabled").delay(2000).fadeOut(1000);--}}
{{--        // }--}}
{{--    </script>--}}
{{--@endsection--}}


