@extends('Frontend.elearning.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="row mt-5 mb-5">
            <div class="col-lg-6 m-auto">
                <div class="modal-content sign-in-modal">
                    <div class="modal-header">
                        <h5 class="modal-title">Verify Mobile Number</h5>
                    </div>
                    <div class="modal-body">

                        <form action="{{route('verify-otp')}}" method="POST" id="newModalForm">
                            @csrf
                            <input type="hidden" value="{{$student_id}}" name="student_id">
                            <div class="input-group">
                                <span class="input-field-icon"><i class="fas fa-user"></i></span>
                                <input type="text" name="otp_verification" id="otp" class="form-control"
                                       placeholder="Enter your verification code">
                            </div>
                            @error ('otp_verification')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
