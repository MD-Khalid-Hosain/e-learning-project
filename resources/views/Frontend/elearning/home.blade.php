@extends('Frontend.elearning.layouts.app')

@section('content')
    <section class="home-banner-area" style="background-image: url({{ asset('images/learning.jpg') }})">
        <div class="container-lg">
            <div class="row">
                <div class="col">
                    <div class="home-banner-wrap">
                        <h2>Best place for learning</h2>
                        <p>Learn from any topic, choose from category</p>
{{--                        <form class="" action=""--}}
{{--                              method="post">--}}
{{--                            <div class="input-group">--}}
{{--                                <input type="text" class="form-control" name="search_string"--}}
{{--                                       placeholder="what do you want to learn?">--}}
{{--                                <div class="input-group-append">--}}
{{--                                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="home-fact-area">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-4 d-flex">
                    <div class="home-fact-box mr-md-auto ml-auto mr-auto">
                        <i class="fas fa-bullseye float-left"></i>
                        <div class="text-box">
                            <h4>{{ allCourse() }} online_courses</h4>
                            <p>Explore A Variety Of Fresh Topics</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 d-flex">
                    <div class="home-fact-box mr-md-auto ml-auto mr-auto">
                        <i class="fa fa-check float-left"></i>
                        <div class="text-box">
                            <h4>Expert Instruction</h4>
                            <p>Find The Right Course For You</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 d-flex">
                    <div class="home-fact-box mr-md-auto ml-auto mr-auto">
                        <i class="fa fa-clock float-left"></i>
                        <div class="text-box">
                            <h4>Lifetime Access</h4>
                            <p>Learn On Your Schedule</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="course-carousel-area">
        <div class="container-lg">
            <div class="row">
                <div class="col">
                    <h2 class="course-carousel-title">Courses</h2>
                    <div class="course-carousel">
                        @foreach ($allCourse as $top_course)
                            <div class="course-box-wrap">
                                <a href="{{route('student-course-details', $top_course->slug)}}"
                                   class="">
                                    <div class="course-box">
                                        <!-- <div class="course-badge position best-seller">Best seller</div> -->
                                        <div class="course-image">
                                            <img src="{{ asset('backend/course') }}/{{ $top_course->thumbnail }}" alt="{{$top_course->title}}" class="img-fluid" >
                                        </div>
                                        <div class="course-details">
                                            <h5 class="title">{{ $top_course->title }}</h5>
                                            <p class="instructors">{{ $top_course->short_description }}</p>
{{--                                            <div class="rating">--}}
{{--                                                <i class="fas fa-star filled"></i>--}}
{{--                                                <i class="fas fa-star filled"></i>--}}
{{--                                                <i class="fas fa-star filled"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <span class="d-inline-block average-rating">5</span>--}}
{{--                                            </div>--}}
                                            <p class="price text-right">
                                                Free
                                            </p>
                                        </div>
                                    </div>
                                </a>

                                <div class="webui-popover-content">
                                    <div class="course-popover-content">

                                        <div class="course-title">
                                            <a href="">{{ $top_course->title }}</a>
                                        </div>
                                        <!-- <div class="course-category">
                                            <span class="course-badge best-seller">Best seller</span>
                                            in
                                            <a href="">PHP</a>
                                        </div> -->
                                        <div class="course-meta">
                                        <span class=""><i class="fas fa-play-circle"></i>
                                            10 Lessons
                                        </span>
                                            <span class=""><i class="far fa-clock"></i>
                                            2 Hours
                                        </span>
                                            <span class="">
                                            <i class="fas fa-closed-captioning"></i>{{ $top_course->language }}
                                        </span>
                                        </div>
                                        <div class="course-subtitle">{{ $top_course->short_description }}</div>
                                        <div class="what-will-learn">
                                            <ul>
                                                {{ $top_course->outcomes }}
                                            </ul>
                                        </div>
                                        <div class="popover-btns">
{{--                                            @if(auth()->check() && \App\Enroll::whereCourseId($top_course->id)->first() !== null)--}}
{{--                                                <div class="purchased">--}}
{{--                                                    <a href="#">Already purchased</a>--}}
{{--                                                </div>--}}
{{--                                            @elseif(Cart::get($top_course->id) !== null)--}}
                                                <button type="button"
                                                        class="btn add-to-cart-btn addedToCart big-cart-button-1"
                                                        id="1">
                                                    Added To Cart
                                                </button>
{{--                                            @else--}}
{{--                                                <button type="button"--}}
{{--                                                        class="btn add-to-cart-btn addedToCart big-cart-button-1"--}}
{{--                                                        id="1">--}}
{{--                                                    Add To Cart--}}
{{--                                                </button>--}}
{{--                                            @endif--}}
                                            <button type="button"
                                                    class="wishlist-btn"
                                                    title="Add to wishlist"
                                                    id="1"><i class="fas fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

{{--    <section class="course-carousel-area">--}}
{{--        <div class="container-lg">--}}
{{--            <div class="row">--}}
{{--                <div class="col">--}}
{{--                    <h2 class="course-carousel-title">Top 10 latest courses</h2>--}}
{{--                    <div class="course-carousel">--}}
{{--                        @foreach($courses as $course)--}}
{{--                            <div class="course-box-wrap">--}}
{{--                                <a href="{{ route('course_detail', $course) }}">--}}
{{--                                    <div class="course-box">--}}
{{--                                        <div class="course-image">--}}
{{--                                            <img src="" alt="" class="img-fluid">--}}
{{--                                        </div>--}}
{{--                                        <div class="course-details">--}}
{{--                                            <h5 class="title">{{ $course->title }}</h5>--}}
{{--                                            <p class="instructors">first and last name of the instructor</p>--}}
{{--                                            <div class="rating">--}}
{{--                                                <i class="fas fa-star filled"></i>--}}
{{--                                                <i class="fas fa-star filled"></i>--}}
{{--                                                <i class="fas fa-star filled"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <span class="d-inline-block average-rating">5</span>--}}
{{--                                            </div>--}}
{{--                                            <p class="price text-right">--}}
{{--                                                <small>--}}
{{--                                                    $200--}}
{{--                                                </small>--}}
{{--                                                $100--}}
{{--                                            </p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
@endsection
@section('scripts')
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
    <script>

        $(function() {

                {{--$("#btn-submit").click(function(e){--}}
                {{--    e.preventDefault();--}}

                {{--    var _token = $("input[name='_token']").val();--}}
                {{--    var first_name = $("#first_name").val();--}}
                {{--    var last_name = $("#last_name").val();--}}
                {{--    var email  = $("#email ").val();--}}
                {{--    var number = $("#number").val();--}}
                {{--    var city = $("#city").val();--}}
                {{--    var password = $("#password").val();--}}
                {{--    var password_confirmation = $("#password_confirmation").val();--}}

                {{--    $.ajax({--}}
                {{--        url: "{{ route('student-registration') }}",--}}
                {{--        type:'POST',--}}
                {{--        data: {_token:_token, first_name:first_name,last_name:last_name, email:email, number:number, city:city, password:password,password_confirmation:password_confirmation},--}}
                {{--        success: function(data) {--}}
                {{--            console.log(data.error)--}}
                {{--            if($.isEmptyObject(data.error)){--}}
                {{--                window.location.href = "/home";--}}
                {{--            }else{--}}
                {{--                printErrorMsg(data.error);--}}
                {{--            }--}}
                {{--        }--}}
                {{--    });--}}
                {{--});--}}

                function printErrorMsg (msg) {
                    $.each( msg, function( key, value ) {
                        // console.log(key);
                        $('.'+key+'_err').text(value);
                    });
                }

            // $("#newModalForm").validate({
            //
            //     // // validation rules for registration form
            //     // errorClass: "error-class",
            //     // validClass: "valid-class",
            //     // errorElement: 'div',
            //     // errorPlacement: function(error, element) {
            //     //     if(element.parent('.input-group').length) {
            //     //         error.insertAfter(element.parent());
            //     //     } else {
            //     //         error.insertAfter(element);
            //     //     }
            //     // },
            //     // onError : function(){
            //     //     $('.input-group.error-class').find('.help-block.form-error').each(function() {
            //     //         $(this).closest('.form-group').addClass('error-class').append($(this));
            //     //     });
            //     // },
            //     //
            //     // rules: {
            //     //     first_name: {
            //     //         required: true,
            //     //     },
            //     //     last_name: {
            //     //         required: true,
            //     //     },
            //     //     email: {
            //     //         required: true,
            //     //     },
            //     //     city: {
            //     //         required: true,
            //     //     },
            //     //     number: {
            //     //         required: true,
            //     //     },
            //     //     password: {
            //     //         minlength: 5,
            //     //         required: true,
            //     //     },
            //     //     password_confirmation: {
            //     //         minlength: 5,
            //     //         equalTo: "#password",
            //     //         required: true,
            //     //     }
            //     // },
            //     //
            //     // messages: {
            //     //     password: {
            //     //         required: "Please enter your password",
            //     //         minlength: "Passwords can't be shorter than seven characters",
            //     //         maxlength: "Passwords must be shorter than forty characters."
            //     //     },
            //     //
            //     //     highlight: function(element, errorClass) {
            //     //         $(element).removeClass(errorClass);
            //     //     }
            //     // },
            //         });
        });
    </script>

@endsection
