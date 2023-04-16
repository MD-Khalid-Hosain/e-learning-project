<footer class="footer-area">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-6 m-auto">
                    <ul class="nav justify-content-md-center footer-menu">

                        <li class="nav-item">
                            <a class="nav-link btn btn-danger"
                               href="{{route('exam-policy')}}">Exam Policy</a>
                        </li>
                    </ul>

            </div>
        </div>
    </div>
</footer>


<!-- Modal -->
<div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content sign-in-modal">
            <div class="modal-header">
                <h5 class="modal-title">Login to your account!</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
{{--                <form action="{{ route('login') }}" method="post">--}}
{{--                    @csrf--}}
{{--                    <div class="input-group">--}}
{{--                        <span class="input-field-icon"><i class="fas fa-envelope"></i></span>--}}
{{--                        <input type="email" name="email" class="form-control" placeholder="email">--}}
{{--                    </div>--}}
{{--                    <div class="input-group">--}}
{{--                        <span class="input-field-icon"><i class="fas fa-lock"></i></span>--}}
{{--                        <input type="password" name="password" class="form-control" placeholder="password">--}}
{{--                    </div>--}}
{{--                    <button type="submit" class="btn btn-primary">Login</button>--}}
{{--                    <div class="forgot-pass">--}}
{{--                        <span>or</span>--}}
{{--                        <a href="" data-toggle="modal" data-target="#forgotModal" data-dismiss="modal">Forgot--}}
{{--                            password</a>--}}
{{--                    </div>--}}
{{--                </form>--}}
                <form action="" method="post">
                    @csrf
                    <div class="input-group">
                        <span class="input-field-icon"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="email">
                    </div>
                    <div class="input-group">
                        <span class="input-field-icon"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <div class="forgot-pass">
                        <span>or</span>
                        <a href="" data-toggle="modal" data-target="#forgotModal" data-dismiss="modal">Forgot
                            password</a>
                    </div>
                </form>
                <div class="account-have">
                    Don't have an account? <a href="" data-toggle="modal" data-target="#signUpModal"
                                              data-dismiss="modal">Sign up</a>
                </div>
            </div>
        </div>
    </div>
</div><!-- Modal -->

<!-- Rating Modal -->
<div class="modal fade multi-step" id="EditRatingModal" tabindex="-1" role="dialog" aria-hidden="true"
     reset-on-close="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content edit-rating-modal">
            <div class="modal-header">
                <h5 class="modal-title step-1" data-step="1">Step 1</h5>
                <h5 class="modal-title step-2" data-step="2">Step 2</h5>
                <h5 class="m-progress-stats modal-title">
                    &nbsp;of&nbsp;<span class="m-progress-total"></span>
                </h5>

                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="m-progress-bar-wrapper">
                <div class="m-progress-bar">
                </div>
            </div>
{{--            <form action="{{ route('add.review') }}" method="post">--}}
            <form action="" method="post">
                @csrf
                <div class="modal-body step step-1">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="modal-rating-box">
                                    <h4 class="rating-title">How would you rate this course overall?</h4>
                                    <fieldset class="your-rating">

                                        <input type="radio" id="star5" name="rating" value="5"/>
                                        <label class="full" for="star5"></label>

                                        <input type="radio" id="star4" name="rating" value="4"/>
                                        <label class="full" for="star4"></label>

                                        <input type="radio" id="star3" name="rating" value="3"/>
                                        <label class="full" for="star3"></label>

                                        <input type="radio" id="star2" name="rating" value="2"/>
                                        <label class="full" for="star2"></label>

                                        <input type="radio" id="star1" name="rating" value="1"/>
                                        <label class="full" for="star1"></label>

                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modal-course-preview-box">
                                    <div class="card">
                                        <img class="card-img-top img-fluid" id="course_thumbnail_1" alt="">
                                        <div class="card-body">
                                            <h5 class="card-title" class="course_title_for_rating"
                                                id="course_title_1"></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body step step-2">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="modal-rating-comment-box">
                                    <h4 class="rating-title">Write a review</h4>
                                    <textarea id="review_of_a_course" name="review"
                                              placeholder="Describe your experience what you got out from this course"
                                              maxlength="1000" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modal-course-preview-box">
                                    <div class="card">
                                        <img class="card-img-top img-fluid" id="course_thumbnail_2" alt="">
                                        <div class="card-body">
                                            <h5 class="card-title" class="course_title_for_rating"
                                                id="course_title_2"></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="course_id" id="course_id_for_rating" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary next step step-1" data-step="1"
                            onclick="sendEvent(2)">Next
                    </button>
                    <button type="button" class="btn btn-primary previous step step-2 mr-auto" data-step="2"
                            onclick="sendEvent(1)">Previous
                    </button>
                    <button type="submit" class="btn btn-primary publish step step-2" id="">Publish</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="forgotModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content sign-in-modal">
            <div class="modal-header">
                <h5 class="modal-title">Forgot Password</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="input-group">
                        <input type="email" name="email" class="form-control forgot-email" placeholder="E-mail">
                    </div>
                    <div class="forgot-pass-btn">
                        <button type="submit" class="btn btn-primary d-inline-block">Reset Password</button>
                        <span>or</span>
                        <a href="" data-toggle="modal" data-target="#signInModal" data-dismiss="modal">Log In</a>
                    </div>
                </form>
                <div class="forgot-recaptcha">

                </div>
            </div>
        </div>
    </div>
</div><!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content sign-in-modal">
            <div class="modal-header">
                <h5 class="modal-title">Sign Up And Start Learning!</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="newModalForm">
                    @csrf

                    <div class="input-group">
                        <span class="input-field-icon"><i class="fas fa-user"></i></span>
                        <input type="text" name="first_name" id="first_name" class="form-control"
                               placeholder="first name">
                    </div>
                    <span class="text-danger error-text first_name_err"></span>

                    <div class="input-group">
                        <span class="input-field-icon"><i class="fas fa-user"></i></span>
                        <input type="text" name="last_name" id="last_name" class="form-control"
                               placeholder="last name">
                    </div>
                    <span class="text-danger error-text last_name_err"></span>
                    <div class="input-group">
                        <span class="input-field-icon"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" id="email" class="form-control"
                               placeholder="email">
                    </div>
                    <span class="text-danger error-text email_err"></span>
                    <div class="input-group">
                        <span class="input-field-icon"><i class="fas fa-phone"></i></span>
                        <input type="text" name="number" id="number" class="form-control" minlength="11"
                               placeholder="Phone Number">
                    </div>
                    <span class="text-danger error-text number_err"></span>
                    <div class="input-group">
                        <span class="input-field-icon"><i class="fas fa-globe"></i></span>
                        <input type="text" name="country" id="country" class="form-control" disabled value="Bangladesh">
                    </div>
                    <span class="text-danger error-text country_err"></span>
                    <div class="input-group">
                        <span class="input-field-icon"><i class="fas fa-city"></i></span>
                        <select name="city" id="city" class="form-control">
                            <option value="">--Select City--</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Chattogram">Chattogram</option>
                            <option value="Khulna">Khulna</option>
                            <option value="Sylhet">Sylhet</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Rangpur">Rangpur</option>
                            <option value="Mymensingh">Mymensingh</option>
                        </select>
                    </div>
                    <span class="text-danger error-text city_err"></span>
                    <div class="input-group">
                        <span class="input-field-icon"><i class="fas fa-lock"></i></span>
                        <input type="password" id="password" name="password" class="form-control"
                               placeholder="password">
                    </div>
                    <span class="text-danger error-text password_err"></span>
                    <div class="input-group">
                        <span class="input-field-icon"><i class="fas fa-lock"></i></span>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                               placeholder="Confirm password">
                    </div>
                    <span class="text-danger error-text password_confirmation_err d-block"></span>
                    <button type="submit" class="btn btn-primary" id="btn-submit">Sign up</button>
                </form>
                <div class="agreement-text">
                    By Signing Up You Agree To Our
                    <a href="">Terms of use</a> and <a
                            href="">Privacy Policy</a>.
                </div>
                <div class="account-have">
                    Already have an account?
                    <a href="" data-toggle="modal" data-target="#signInModal" data-dismiss="modal">Login</a>
                </div>
            </div>
        </div>
    </div>
</div><!-- Modal -->

{{--payment modal--}}
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content payment-in-modal">
            <div class="modal-header">
                <h5 class="modal-title">Checkout!</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
{{--                        <form action="{{ route('enroll') }}" method="get">--}}
{{--                            <input type="hidden" class="total_price_of_checking_out" name="total_price_of_checking_out"--}}
{{--                                   value="">--}}
{{--                            <button type="submit" class="btn btn-default paypal">--}}
{{--                                Paypal--}}
{{--                            </button>--}}
{{--                        </form>--}}
                        <form action="" method="get">
                            <input type="hidden" class="total_price_of_checking_out" name="total_price_of_checking_out"
                                   value="">
                            <button type="submit" class="btn btn-default paypal">
                                Paypal
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- Modal -->
