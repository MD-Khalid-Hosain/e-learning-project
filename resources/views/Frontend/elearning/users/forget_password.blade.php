@extends('Frontend.elearning.layouts.app')

@section('content')
    <div class="container-xl">
        <div class="row mt-5 mb-5">
            <div class="col-lg-6 m-auto">
                <div class="modal-content sign-in-modal">
                    <div class="modal-header">
                        <h5 class="modal-title">Enter your number</h5>
                    </div>
                    <div class="modal-body">
                        @if (session('error_message'))
                            <div class="alert alert-danger alert-dismissible" >
                                <strong>{{ session('error_message') }}</strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form action="{{route('send-password')}}" method="post">
                            @csrf
                            <div class="input-group">
                                <span class="input-field-icon"><i class="fas fa-mobile"></i></span>
                                <input type="text" name="number" class="form-control" placeholder="your phone number">
                            </div>
                            <button type="submit" class="btn btn-primary">Send password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
