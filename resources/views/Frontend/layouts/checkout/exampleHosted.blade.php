@extends('Frontend.elearning.layouts.app')

@section('content')
    <section class="category-header-area">
        <div class="container-lg">
            <div class="row">
                <div class="col">
                    <h1 class="category-name">
                        Checkout Page
                    </h1>
                </div>
            </div>
        </div>
    </section>
<div class="container-lg">

    <div class="row mt-5">
        <div class="col-md-12 order-md-1">

                <h5 class="form-head">Billing Details</h5>

            <form action="{{ url('/pay') }}" method="POST" id="basic-form" class="needs-validation">
            @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Full name <span class="required">*</span></label>
                        <input type="text" id="name" name="full_name" class="form-control" value="{{ auth()->guard('student')->user()->first_name . auth()->guard('student')->user()->last_name }}" id="customer_name" placeholder="your name" required>
                        @error ('full_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label >Mobile <span class="required">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+88</span>
                            </div>
                            <input type="text" name="number" class="form-control" value="{{ auth()->guard('student')->user()->number }}" placeholder="Mobile number" required>
                            <label for="mobile"></label>
                            @error ('number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" id="email" name="email" value="{{ auth()->guard('student')->user()->email }}" class="form-control" id="email"
                           placeholder="you@example.com" required>
                    @error ('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                </div>
        <div class="col-md-12 order-md-2 mb-4 text-center">

            <ul class="list-group mb-3">
                <li class="list-group-item ">
                    <strong>Subtotal</strong>
                    <strong >{{ $examDetails->exam_fee }}Tk</strong>
                </li>
            </ul>

            <hr class="mb-4">
                <div class="form-check" id="online_payment">
                    <input type="hidden" value="{{ $examDetails->exam_fee }}" name="amount" id="total_amount" required/>
                    <input type="hidden" value="{{ $examDetails->id }}" name="exam_id"  required/>
                    <input type="hidden" value="{{ auth()->guard('student')->user()->city }}" name="city"  required/>
                    <label class="form-check-label" for="online">
                    Online Payment
                    </label>
                </div>
                <hr class="mb-4">
                <button class="btn btn-dark" type="submit">Confirm Order</button>
        </div>
        </form>
    </div>
</div>

@endsection
@section('footer_script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

@endsection
