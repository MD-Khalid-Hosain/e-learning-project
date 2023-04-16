@extends('Frontend.master')
@section('title')
Contract Us - Original Store Ltd.
@endsection
@section('description')
We have 7 Branch in Dhaka. Gunsal-2 is the Main Branch and Others are Elephant Road, Motijheel, Uttara, Multiplan, Hp World Express & Motijheel Corporate Branch.
@endsection
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
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i>Contact Us</li>
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
    login area Start
    ==========================-->
    <div class="login-area mt-25">
        <div class="container">
            <div class="row">
                <div class="offset-lg-12 col-lg-12">
                    <div class="contact_info mb-20 about-css">
                        <!-- Footer Top Start -->
                            <div class="footer-top mt-50 " >
                                <div class="container mt5">
                                    <div class="row">
                                        @foreach ($allContact as $contact)
                                            <div class="col-md-3 mb-3">
                                                <div class="footerhead">
                                                    <div class="officename text-center">
                                                    <a href="{{ $contact->location_map }}" target="_blank"> <h6 class="footer-head-text-contact">{{ $contact->branch_name }}-<i class="fa fa-map-marker"></i></h6></a>
                                                    </div>
                                                </div>
                                                <div class="contact fobody">
                                                    <p class="contact-us">{!! $contact->address !!}</p>
                                                </div>
                                                <div class="offon">
                                                    <p class="footer-pera">{{ $contact->close_day }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        <!-- Footer Top End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
