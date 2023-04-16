
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
                            <h3 class="last-title">Opps Sorry!!</h3>

                            @if (session('message'))

                                <h6>Your Order No# {{ session('message') }}</h6>

                            @endif


                            <p>If you have any questions about your order you can contact with us on 01739438877 (10:00 AM - 08:00 PM)</p>
                            <p>If you have time you can visit our soical media pages like </p>
                            <div id="after-order-solical-link">
                                <div class="footer-item follow-part">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="top icons">
                                                <a href="https://www.facebook.com/originalstorebd" target="_blank"><i class="zmdi zmdi-facebook"></i></a>
                                                <a class="insta" href="https://www.instagram.com/originalstoreltd/" target="_blank"><i class="fa fa-instagram"></i></a>
                                                <a class="youtube" href="https://www.youtube.com/originalstorebd" target="_blank"><i class="zmdi zmdi-youtube-play"></i></a>
                                                <a class="twitter" href="https://twitter.com/originalstorebd" target="_blank"><i class="zmdi zmdi-twitter"></i></a>
                                                <a class="linkedin" href="https://www.linkedin.com/company/originalstorebd" target="_blank"><i class="zmdi zmdi-linkedin"></i></a>
                                                <a class="pinterest" href=""href="https://www.pinterest.com/originalstorebd/" target="_blank"><i class="fa fa-pinterest"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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




