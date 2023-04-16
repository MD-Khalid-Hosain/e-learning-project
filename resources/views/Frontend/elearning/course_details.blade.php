@extends('Frontend.elearning.layouts.app')

@section('content')

    <section class="course-header-area">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="course-header-wrap">
                        <h1 class="title">{{$course->title }}</h1>
                        <p class="subtitle">{{ $course->short_description }}</p>
                        <div class="rating-row">
                            {{--<span class="course-badge best-seller">Best seller</span>--}}
{{--                            <?php--}}
{{--                            for($i = 1; $i < 6; $i++):?>--}}
{{--                            <?php if ($i <= 5): ?>--}}
{{--                            <i class="fas fa-star filled" style="color: #f5c85b;"></i>--}}
{{--                            <?php else: ?>--}}
{{--                            <i class="fas fa-star"></i>--}}
{{--                            <?php endif; ?>--}}
{{--                            <?php endfor; ?>--}}
{{--                            <span class="d-inline-block average-rating"><?php echo 5; ?></span>--}}
{{--                            <span>(20 ratings)</span>--}}
                            <span class="enrolled-num">
                                {{App\CourseEnroll::where('course_id', $course->id)->count()}} students enrolled
                            </span>
                        </div>
                        <div class="created-row">
                            {{--<span class="created-by">--}}
                            {{--Created by--}}
                            {{--<a href="">first_name last_name</a>--}}
                            {{--</span>--}}
                            <span class="last-updated-date">Created on {{ $course->created_at }}</span>
                            <span class="last-updated-date">Last updated on {{ $course->updated_at }}</span>
                            <span class="comment">
                                <i class="fas fa-comment"></i>{{$course->language}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">

                </div>
            </div>
        </div>
    </section>

    <section class="course-content-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible mt-5" >
                            <strong style="font-size: 20px;">{{ session('success') }}</strong>
                            <button type="button" class="close my-3" style="top:-16px" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" >&times;</span>
                            </button>
                        </div>
                    @endif
                        @if (session('message'))
                        <div class="alert alert-danger alert-dismissible mt-5" >
                            <strong style="font-size: 20px;">{{ session('message') }}</strong>
                            <button type="button" class="close my-3" style="top:-16px" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" >&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="what-you-get-box">
                        <div class="what-you-get-title">What i will learn?</div>
                        <ul class="what-you-get__items">
                            <li>{{ $course->outcomes }}</li>
                        </ul>
                    </div>
                    <br>
                    <div class="course-curriculum-box">
                        <div class="course-curriculum-title clearfix">
                            <div class="title float-left">Lessons for this course</div>
                            <div class="float-right">
                                <span class="total-lectures">
                                    {{ App\CourseLesson::where('course_id', $course->id)->count() }} lessons
                                </span>
                                <span class="total-time">

                                </span>
                            </div>
                        </div>
                        <div class="course-curriculum-accordion">

                            <div class="lecture-group-wrapper">
                                <div class="lecture-group-title clearfix" data-toggle="collapse"
                                     data-target="#collapse"
                                     aria-expanded="false">
                                    <div class="title float-left">
                                        Lessons
                                    </div>
                                    <div class="float-right">
                                        <span class="total-lectures">
                                           {{ App\CourseLesson::where('course_id', $course->id)->count() }} lessons
                                        </span>
                                        <span class="total-time">

                                        </span>
                                    </div>
                                </div>

                                <div id="collapse" class="lecture-list collapse">
                                    <ul>
                                        @if(Auth::guard('student')->check())
                                            @if(App\CourseEnroll::where('student_id', Auth::guard('student')->id())->where('course_id', $course->id)->exists())
                                                @foreach(App\CourseLesson::where('course_id', $course->id)->get() as $lesson)
                                                    <li class="lecture has-preview">
                                                        <a href="{{ $lesson->video_url }}"><span class="lecture-title">{{ $lesson->lesson_title }}</span></a>
                                                        <!-- <span class="lecture-preview float-right" data-toggle="modal" data-target="#CoursePreviewModal">Preview</span> -->
                                                    </li>

                                                @endforeach
                                            @else
                                            <span class="lecture-title">Without enroll course you can not see lesson</span>
                                            @endif
                                        @endif

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="requirements-box">
                        <div class="requirements-title">Requirements</div>
                        <div class="requirements-content">
                            <ul class="requirements__list">
                                <li>{{ $course->requirement }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="description-box view-more-parent">
                        <div class="view-more" onclick="viewMore(this,'hide')">
                            + View More
                        </div>
                        <div class="description-title">Description</div>
                        <div class="description-content-wrap">
                            <div class="description-content">
                                {!! $course->description !!}
                            </div>
                        </div>
                    </div>

                    <div class="student-feedback-box">
                        <div class="student-feedback-title">
                            Student feedback
                        </div>
                        <form class="form-row" method="POST" action="{{route('course-review-store')}}">
                            @csrf
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                            <div class="form_group col-6 position-relative">
                                <label class="form-label">Your Comment <span class="required">*</span></label>
                                <textarea name="comment" id="comment" class="input-form form-control"  rows="6"></textarea>
                                @error('comment')
                                <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form_group col-6 position-relative">
                                <label class="form-label">Rating <span class="required">*</span></label>
                                <div class="feedback" >
                                    <div class="rating-emo">
                                        <input type="radio" name="ratting" id="rating-5" value="5">
                                        <label for="rating-5"></label>
                                        <input type="radio" name="ratting" id="rating-4" value="4">
                                        <label for="rating-4"></label>
                                        <input type="radio" name="ratting" id="rating-3" value="3">
                                        <label for="rating-3"></label>
                                        <input type="radio" name="ratting" id="rating-2" value="2">
                                        <label for="rating-2"></label>
                                        <input type="radio" name="ratting" id="rating-1" value="1">

                                        <label for="rating-1"></label>
                                        <div class="emoji-wrapper">
                                            <div class="emoji">
                                                <svg class="rating-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                    <path d="M512 256c0 141.44-114.64 256-256 256-80.48 0-152.32-37.12-199.28-95.28 43.92 35.52 99.84 56.72 160.72 56.72 141.36 0 256-114.56 256-256 0-60.88-21.2-116.8-56.72-160.72C474.8 103.68 512 175.52 512 256z" fill="#f4c534"/>
                                                    <ellipse transform="scale(-1) rotate(31.21 715.433 -595.455)" cx="166.318" cy="199.829" rx="56.146" ry="56.13" fill="#fff"/>
                                                    <ellipse transform="rotate(-148.804 180.87 175.82)" cx="180.871" cy="175.822" rx="28.048" ry="28.08" fill="#3e4347"/>
                                                    <ellipse transform="rotate(-113.778 194.434 165.995)" cx="194.433" cy="165.993" rx="8.016" ry="5.296" fill="#5a5f63"/>
                                                    <ellipse transform="scale(-1) rotate(31.21 715.397 -1237.664)" cx="345.695" cy="199.819" rx="56.146" ry="56.13" fill="#fff"/>
                                                    <ellipse transform="rotate(-148.804 360.25 175.837)" cx="360.252" cy="175.84" rx="28.048" ry="28.08" fill="#3e4347"/>
                                                    <ellipse transform="scale(-1) rotate(66.227 254.508 -573.138)" cx="373.794" cy="165.987" rx="8.016" ry="5.296" fill="#5a5f63"/>
                                                    <path d="M370.56 344.4c0 7.696-6.224 13.92-13.92 13.92H155.36c-7.616 0-13.92-6.224-13.92-13.92s6.304-13.92 13.92-13.92h201.296c7.696.016 13.904 6.224 13.904 13.92z" fill="#3e4347"/>
                                                </svg>
                                                <svg class="rating-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                                    <path d="M328.4 428a92.8 92.8 0 0 0-145-.1 6.8 6.8 0 0 1-12-5.8 86.6 86.6 0 0 1 84.5-69 86.6 86.6 0 0 1 84.7 69.8c1.3 6.9-7.7 10.6-12.2 5.1z" fill="#3e4347"/>
                                                    <path d="M269.2 222.3c5.3 62.8 52 113.9 104.8 113.9 52.3 0 90.8-51.1 85.6-113.9-2-25-10.8-47.9-23.7-66.7-4.1-6.1-12.2-8-18.5-4.2a111.8 111.8 0 0 1-60.1 16.2c-22.8 0-42.1-5.6-57.8-14.8-6.8-4-15.4-1.5-18.9 5.4-9 18.2-13.2 40.3-11.4 64.1z" fill="#f4c534"/>
                                                    <path d="M357 189.5c25.8 0 47-7.1 63.7-18.7 10 14.6 17 32.1 18.7 51.6 4 49.6-26.1 89.7-67.5 89.7-41.6 0-78.4-40.1-82.5-89.7A95 95 0 0 1 298 174c16 9.7 35.6 15.5 59 15.5z" fill="#fff"/>
                                                    <path d="M396.2 246.1a38.5 38.5 0 0 1-38.7 38.6 38.5 38.5 0 0 1-38.6-38.6 38.6 38.6 0 1 1 77.3 0z" fill="#3e4347"/>
                                                    <path d="M380.4 241.1c-3.2 3.2-9.9 1.7-14.9-3.2-4.8-4.8-6.2-11.5-3-14.7 3.3-3.4 10-2 14.9 2.9 4.9 5 6.4 11.7 3 15z" fill="#fff"/>
                                                    <path d="M242.8 222.3c-5.3 62.8-52 113.9-104.8 113.9-52.3 0-90.8-51.1-85.6-113.9 2-25 10.8-47.9 23.7-66.7 4.1-6.1 12.2-8 18.5-4.2 16.2 10.1 36.2 16.2 60.1 16.2 22.8 0 42.1-5.6 57.8-14.8 6.8-4 15.4-1.5 18.9 5.4 9 18.2 13.2 40.3 11.4 64.1z" fill="#f4c534"/>
                                                    <path d="M155 189.5c-25.8 0-47-7.1-63.7-18.7-10 14.6-17 32.1-18.7 51.6-4 49.6 26.1 89.7 67.5 89.7 41.6 0 78.4-40.1 82.5-89.7A95 95 0 0 0 214 174c-16 9.7-35.6 15.5-59 15.5z" fill="#fff"/>
                                                    <path d="M115.8 246.1a38.5 38.5 0 0 0 38.7 38.6 38.5 38.5 0 0 0 38.6-38.6 38.6 38.6 0 1 0-77.3 0z" fill="#3e4347"/>
                                                    <path d="M131.6 241.1c3.2 3.2 9.9 1.7 14.9-3.2 4.8-4.8 6.2-11.5 3-14.7-3.3-3.4-10-2-14.9 2.9-4.9 5-6.4 11.7-3 15z" fill="#fff"/>
                                                </svg>
                                                <svg class="rating-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                                    <path d="M336.6 403.2c-6.5 8-16 10-25.5 5.2a117.6 117.6 0 0 0-110.2 0c-9.4 4.9-19 3.3-25.6-4.6-6.5-7.7-4.7-21.1 8.4-28 45.1-24 99.5-24 144.6 0 13 7 14.8 19.7 8.3 27.4z" fill="#3e4347"/>
                                                    <path d="M276.6 244.3a79.3 79.3 0 1 1 158.8 0 79.5 79.5 0 1 1-158.8 0z" fill="#fff"/>
                                                    <circle cx="340" cy="260.4" r="36.2" fill="#3e4347"/>
                                                    <g fill="#fff">
                                                        <ellipse transform="rotate(-135 326.4 246.6)" cx="326.4" cy="246.6" rx="6.5" ry="10"/>
                                                        <path d="M231.9 244.3a79.3 79.3 0 1 0-158.8 0 79.5 79.5 0 1 0 158.8 0z"/>
                                                    </g>
                                                    <circle cx="168.5" cy="260.4" r="36.2" fill="#3e4347"/>
                                                    <ellipse transform="rotate(-135 182.1 246.7)" cx="182.1" cy="246.7" rx="10" ry="6.5" fill="#fff"/>
                                                </svg>
                                                <svg class="rating-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                    <path d="M407.7 352.8a163.9 163.9 0 0 1-303.5 0c-2.3-5.5 1.5-12 7.5-13.2a780.8 780.8 0 0 1 288.4 0c6 1.2 9.9 7.7 7.6 13.2z" fill="#3e4347"/>
                                                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                                    <g fill="#fff">
                                                        <path d="M115.3 339c18.2 29.6 75.1 32.8 143.1 32.8 67.1 0 124.2-3.2 143.2-31.6l-1.5-.6a780.6 780.6 0 0 0-284.8-.6z"/>
                                                        <ellipse cx="356.4" cy="205.3" rx="81.1" ry="81"/>
                                                    </g>
                                                    <ellipse cx="356.4" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347"/>
                                                    <g fill="#fff">
                                                        <ellipse transform="scale(-1) rotate(45 454 -906)" cx="375.3" cy="188.1" rx="12" ry="8.1"/>
                                                        <ellipse cx="155.6" cy="205.3" rx="81.1" ry="81"/>
                                                    </g>
                                                    <ellipse cx="155.6" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347"/>
                                                    <ellipse transform="scale(-1) rotate(45 454 -421.3)" cx="174.5" cy="188" rx="12" ry="8.1" fill="#fff"/>
                                                </svg>
                                                <svg class="rating-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                                    <path d="M232.3 201.3c0 49.2-74.3 94.2-74.3 94.2s-74.4-45-74.4-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b"/>
                                                    <path d="M96.1 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2C80.2 229.8 95.6 175.2 96 173.3z" fill="#d03f3f"/>
                                                    <path d="M215.2 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff"/>
                                                    <path d="M428.4 201.3c0 49.2-74.4 94.2-74.4 94.2s-74.3-45-74.3-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b"/>
                                                    <path d="M292.2 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2-77.8-65.7-62.4-120.3-61.9-122.2z" fill="#d03f3f"/>
                                                    <path d="M411.3 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff"/>
                                                    <path d="M381.7 374.1c-30.2 35.9-75.3 64.4-125.7 64.4s-95.4-28.5-125.8-64.2a17.6 17.6 0 0 1 16.5-28.7 627.7 627.7 0 0 0 218.7-.1c16.2-2.7 27 16.1 16.3 28.6z" fill="#3e4347"/>
                                                    <path d="M256 438.5c25.7 0 50-7.5 71.7-19.5-9-33.7-40.7-43.3-62.6-31.7-29.7 15.8-62.8-4.7-75.6 34.3 20.3 10.4 42.8 17 66.5 17z" fill="#e24b4b"/>
                                                </svg>
                                                <svg class="rating-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <g fill="#ffd93b">
                                                        <circle cx="256" cy="256" r="256"/>
                                                        <path d="M512 256A256 256 0 0 1 56.8 416.7a256 256 0 0 0 360-360c58 47 95.2 118.8 95.2 199.3z"/>
                                                    </g>
                                                    <path d="M512 99.4v165.1c0 11-8.9 19.9-19.7 19.9h-187c-13 0-23.5-10.5-23.5-23.5v-21.3c0-12.9-8.9-24.8-21.6-26.7-16.2-2.5-30 10-30 25.5V261c0 13-10.5 23.5-23.5 23.5h-187A19.7 19.7 0 0 1 0 264.7V99.4c0-10.9 8.8-19.7 19.7-19.7h472.6c10.8 0 19.7 8.7 19.7 19.7z" fill="#e9eff4"/>
                                                    <path d="M204.6 138v88.2a23 23 0 0 1-23 23H58.2a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#45cbea"/>
                                                    <path d="M476.9 138v88.2a23 23 0 0 1-23 23H330.3a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#e84d88"/>
                                                    <g fill="#38c0dc">
                                                        <path d="M95.2 114.9l-60 60v15.2l75.2-75.2zM123.3 114.9L35.1 203v23.2c0 1.8.3 3.7.7 5.4l116.8-116.7h-29.3z"/>
                                                    </g>
                                                    <g fill="#d23f77">
                                                        <path d="M373.3 114.9l-66 66V196l81.3-81.2zM401.5 114.9l-94.1 94v17.3c0 3.5.8 6.8 2.2 9.8l121.1-121.1h-29.2z"/>
                                                    </g>
                                                    <path d="M329.5 395.2c0 44.7-33 81-73.4 81-40.7 0-73.5-36.3-73.5-81s32.8-81 73.5-81c40.5 0 73.4 36.3 73.4 81z" fill="#3e4347"/>
                                                    <path d="M256 476.2a70 70 0 0 0 53.3-25.5 34.6 34.6 0 0 0-58-25 34.4 34.4 0 0 0-47.8 26 69.9 69.9 0 0 0 52.6 24.5z" fill="#e24b4b"/>
                                                    <path d="M290.3 434.8c-1 3.4-5.8 5.2-11 3.9s-8.4-5.1-7.4-8.7c.8-3.3 5.7-5 10.7-3.8 5.1 1.4 8.5 5.3 7.7 8.6z" fill="#fff" opacity=".2"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('ratting')
                                <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="form_group group_3 col-lg-3">
                                <button class="login-register btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-lg-6 col-lg-offset-4">
                                <div class="average-rating">
                                    <div class="num">
                                     {{App\CourseReview::where('course_id', $course->id )->where('status',1)->avg('ratting')}}
                                    </div>
                                    <div class="rating">
                                        <?php
                                        for($i = 1; $i < 6; $i++):?>
                                        <?php if ($i <= App\CourseReview::where('course_id', $course->id )->where('status',1)->avg('ratting')): ?>
                                        <i class="fas fa-star filled" style="color: #f5c85b;"></i>
                                        <?php else: ?>
                                        <i class="fas fa-star" style="color: #abb0bb;"></i>
                                        <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="title">Average rating</div>
                                </div>
                            </div>
                        </div>
                        <div class="reviews">
                            <div class="reviews-title">Reviews</div>
                            <ul>
                                @foreach(App\CourseReview::where('course_id', $course->id )->where('status',1)->get() as $review)
                                    <li>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="reviewer-details clearfix">
                                                    <div class="reviewer-img float-left">
                                                        <img src="{{ asset('frontend/assets/images/blog/comment/comment-3.jpg') }}" alt="">
                                                    </div>
                                                    <div class="review-time">
                                                        <div class="time">
                                                            {{ $review->created_at->translatedFormat('d-M-Y g:i A') }}
                                                        </div>
                                                        <div class="reviewer-name">
                                                            {{ App\Student::where('id', $review->student_id)->value('first_name') . ' '.  App\Student::where('id', $review->student_id)->value('last_name')}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="review-details">
                                                    <div class="rating">
                                                        @for($i = 1; $i < 6; $i++)
                                                            @if ($i <= $review->ratting)
                                                                <i class="fas fa-star filled"
                                                                   style="color: #f5c85b;"></i>
                                                            @else
                                                                <i class="fas fa-star" style="color: #abb0bb;"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <div class="review-text">
                                                        {{ $review->comment }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="course-sidebar natural">
                        <div class="preview-video-box">
                            <a href="{{$course->video_url}}" target="_blank">
                                <img src="{{ asset('backend/course/'.$course->thumbnail) }}" alt="" class="img-fluid">
                                <span class="preview-text">Preview this course</span>
                                <span class="play-btn"></span>
                            </a>
                        </div>
                        <div class="course-sidebar-text-box">
                            <div class="price">
                                <span class="current-price">
                                    Tk <span class="current-price">Free</span></span>
                            </div>

                            {{--<div class="buy-btns">--}}
                            {{--<button class="btn btn-buy-now" type="button">Already purchased</button>--}}
                            {{--</div>--}}
                            <div class="buy-btns">
{{--                                @if(Cart::get($course->id))--}}
{{--                                    <a href="" class="btn btn-buy-now" id="course_2" onclick="handleBuyNow(this)">Buy--}}
{{--                                        now</a>--}}
{{--                                    <button class="btn btn-add-cart addedToCart" type="button" id="{{ $course->id }}"--}}
{{--                                            onclick="handleCartItems(this)">Added to cart--}}
{{--                                    </button>--}}
{{--                                @else--}}

                                        @if(App\CourseEnroll::where('student_id', Auth::guard('student')->id())->where('course_id', $course->id)->exists())
                                            <span class="btn btn-add-cart">Course Already Enrolled</span>
                                        @else
                                    <a class="btn btn-add-cart" href="{{route('course-enroll', $course->id )}}" id="{{ $course->id }}">Enroll Now
                                    </a>
                                            @endif



{{--                                    @if(Cart::get($course->id))--}}
{{--                                        <a href="" class="btn btn-buy-now" id="course_2" onclick="handleBuyNow(this)">Buy--}}
{{--                                            now</a>--}}
{{--                                        <button class="btn btn-add-cart addedToCart" type="button" id="{{ $course->id }}"--}}
{{--                                                onclick="handleCartItems(this)">Added to cart--}}
{{--                                        </button>--}}
{{--                                    @else--}}
{{--                                        <form action="{{ route('cart.add') }}" method="post">--}}
{{--                                            @csrf--}}

{{--                                            <input type="hidden" value="{{ $course->id }}" name="course_id">--}}
{{--                                            <input type="hidden" value="{{ $course->title }}" name="name">--}}
{{--                                            <input type="hidden" value="{{ $course->price }}" name="price">--}}
{{--                                            <input type="hidden" value="1" name="quantity">--}}

{{--                                            <button class="btn btn-add-cart" type="submit" id="{{ $course->id }}">Add to--}}
{{--                                                cart--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
{{--                                    @endif--}}
                            </div>

                            <div class="includes">
                                <div class="title"><b>Includes:</b></div>
                                <ul>
                                    <li>
                                        <i class="far fa-file-video"></i>
                                        on_demand_videos
                                    </li>
                                    <li>
                                        <i class="far fa-file"></i> {{ App\CourseLesson::where('course_id', $course->id)->count() }} lessons
                                    </li>
                                    <li><i class="far fa-compass"></i>Full lifetime access
                                    </li>
                                    <li>
                                        <i class="fas fa-mobile-alt"></i>Access on mobile and tv
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ff6c15d02a436d5"></script>
@endsection
