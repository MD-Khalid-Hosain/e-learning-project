@extends('Frontend.master')
@section('content')
    <!--=====================
    Breadcrumb Aera Start
    =========================-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li>
                                <h1><a href="{{ url('/') }}">Home</a></h1>
                            </li>
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i>My Account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================
    Breadcrumb Aera End
    =========================-->

    <!--======================
    My Account area Start
    ==========================-->
    <div class="my-account-area mt-50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-2">
                    <ul class="nav flex-column dashboard-list mb-20">
                        <li><a class="nav-link "  href="{{ route('my.account') }}">Dashboard</a></li>
                        <li> <a class="nav-link " href="{{ route('order-history') }}">Order History</a></li>
                        <li> <a class="nav-link " href="{{ route('transaction-history') }}">Transaction History</a></li>
                        <li> <a class="nav-link " href="{{ route('cannceld-orders') }}">Canceled Order</a></li>
                        <li><a class="nav-link"  href="{{ route('user-change-password') }}">Change Password</a></li>
                        <li><a class="nav-link"  href="{{ url('/ecom/user/details') }}">Account details</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ url('ecom/user/logout') }}">Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-10">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard-content mb-20">

                        <div id="account-details" class="tab-pane fade active show">
                            <h3 class="last-title">Account details </h3>
                             @if (session('success'))
                                    <div class="alert alert-success alert-dismissible" >
                                        <strong>{{ session('success') }}</strong>
                                        <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            <div class="checkout_info">
                                <form class="form-row" action="{{ route('update-ecomUser') }}" method="POST">
                                    @csrf
                                    <div class="form_group col-12 col-lg-6">
                                        <label class="form-label">Name<span>*</span></label>
                                        <input class="input-form" name="name" type="text" value="{{ Auth::guard('ecomUser')->user()->name }}">
                                        @error('name')
                                            <span class="text-danger" >
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form_group col-12  col-lg-6">
                                        <label class="form-label">Email Address <span>*</span></label>
                                        <input class="input-form" name="email" type="text" value="{{ Auth::guard('ecomUser')->user()->email }}">
                                        @error('email')
                                            <span class="text-danger" >
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form_group col-12 col-lg-12">
                                        <label class="form-label">Address<span>*</span></label>
                                        {{-- <input class="input-form" type="text"> --}}
                                        <textarea name="address" name="address" class="input-form" rows="5">{{ Auth::guard('ecomUser')->user()->address }}</textarea>
                                        @error('address')
                                            <span class="text-danger" >
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form_group col-12 col-lg-12">
                                        <label class="form-label">Mobile<span>*</span></label>
                                        <input class="input-form" type="text" name="mobile" value="{{ Auth::guard('ecomUser')->user()->mobile }}">
                                        @error('mobile')
                                            <span class="text-danger" >
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-row mt-20">
                                        <input type="submit" class="btn-secondary" value="Update">
                                    </div>
                                </form>
                            </div>
                        </div> <!-- end of tab-pane -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--======================
    My Account area End
    ==========================-->
@endsection
