@extends('Frontend.elearning.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="row mt-5 mb-5">
            <div class="col-lg-6 m-auto">
                <div class="modal-content sign-in-modal">
                    <div class="modal-header">
                        <h5 class="modal-title">Sign Up And Start Learning!</h5>
                    </div>
                    <div class="modal-body">
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible" >
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form action="{{route('student.store')}}" method="POST" id="newModalForm">
                            @csrf

                            <div class="input-group">
                                <span class="input-field-icon"><i class="fas fa-user"></i></span>
                                <input type="text" name="first_name" id="first_name" class="form-control"
                                       placeholder="first name" value="{{old('first_name')}}">
                            </div>
                            @error ('first_name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <div class="input-group">
                                <span class="input-field-icon"><i class="fas fa-user"></i></span>
                                <input type="text" name="last_name" id="last_name" class="form-control"
                                       placeholder="last name" value="{{old('last_name')}}">
                            </div>

                            @error ('last_name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <span class="input-field-icon"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" id="email" class="form-control"
                                       placeholder="email" value="{{old('email')}}">
                            </div>
                            @error ('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <label class="mt-2 font-weight-bold pr-2">Date of Birth</label>
                                <input type="date" name="date_of_birth" id="txtDate" class="form-control"
                                       value="{{old('date_of_birth')}}">
                            </div>
                            @error ('date_of_birth')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <span class="input-field-icon"><i class="fas fa-phone"></i></span>
                                <input type="text" name="number" id="number" class="form-control" minlength="11"
                                       placeholder="Phone Number" value="{{old('number')}}">
                            </div>
                            @error ('number')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <span class="input-field-icon"><i class="fas fa-globe"></i></span>
                                <input type="text" name="country" id="country" class="form-control" disabled value="Bangladesh">
                            </div>

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
                            @error ('city')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <span class="text-danger error-text city_err"></span>
                            <div class="input-group">
                                <span class="input-field-icon"><i class="fas fa-lock"></i></span>
                                <input type="password" id="password" name="password" class="form-control"
                                       placeholder="password">
                            </div>
                            @error ('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <span class="input-field-icon"><i class="fas fa-lock"></i></span>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                                       placeholder="Confirm password">
                            </div>
                            @error ('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
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
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function(){
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if(month < 10)
                month = '0' + month.toString();
            if(day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            $('#txtDate').attr('max', maxDate);
        });
    </script>
@endsection
