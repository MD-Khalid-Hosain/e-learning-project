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
                        <li><a class="nav-link"  href="">Change Password</a></li>
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
                                 @if (session('error_message'))
                            <div class="alert alert-danger alert-dismissible" >
                                <strong>{{ session('error_message') }}</strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                             @endif
                            <div class="checkout_info">
                                <form class="form-row" action="{{ route('user-update-password') }}" method="POST">
                                    @csrf
                                    <div class="form_group col-12 col-lg-12">
                                        <label class="form-label">Old Password<span>*</span></label>
                                        <input class="input-form" id="current_pwd"type="password" name="current_pwd" value="">
                                        <span id="check_current_pwd"></span>
                                        @error('old_pwd')
                                            <span class="text-danger" >
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form_group col-12 col-lg-6">
                                        <label class="form-label">New Password<span>*</span></label>
                                        <input class="input-form" name="new_pwd" id="new_pwd" type="password" value="">

                                        @error('new_pwd')
                                            <span class="text-danger" >
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form_group col-12  col-lg-6">
                                        <label class="form-label">Confirm Password <span>*</span></label>
                                        <input class="input-form" name="confirm_pwd" id="confirm_pwd" type="password" value="">
                                        <span id="showError"></span>
                                        @error('confirm_pwd')
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
    <input type="hidden" id="checkCurrentPwd" value="{{ route('user-check-currentPwd') }}">
    <!--======================
    My Account area End
    ==========================-->
@endsection




