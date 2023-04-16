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
                        <li><a class="nav-link"  href="{{ route('ecom-user-details') }}">Account details</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ url('ecom/user/logout') }}">Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-10">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard-content mb-20">
                        <div id="dashboard" class="tab-pane fade active show">
                            <h3 class="last-title">Welcome to Original Store Ltd. </h3>
                            <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a></p>
                            @if (count(App\Cart::where('session_id',Session::get('session_id'))->get())>0)
                                <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="coupon-code">
                                        <div class="view-cart-button">
                                            <a  href="{{ url('/cart/view') }}">View Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

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
