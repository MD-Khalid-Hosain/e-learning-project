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
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i>Offers</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================
    Breadcrumb Aera End
    =========================-->
    @if (count($allOffers) == 0)
    <!-- ================
    404 Area Start
    =====================-->
    <div class="shop-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" style="text-align: center">
                    <p > <span style="background-color: yellow;">নির্দিষ্ট মডেল এর প্রসেসর, মাদারবোর্ড, গ্রাফিক্স কার্ড, র‍্যাম ও মনিটর স্টক সীমিত থাকায় সিংগেল প্রোডাক্ট অনলাইন ডেলিভারি দেয়া সম্ভব নাও হতে পারে।</span></p>

                    <p>বর্তমানে করোনা সংক্রমণ রোধে ঢাকা শহরে হোম ডেলিভারি এর ক্ষেত্রে বিল্ডিং এর ভেতরে নির্দিষ্ট ফ্ল্যাট এ গিয়ে ডেলিভারি সাময়িক বন্ধ রাখা হয়েছে। ক্রেতাকে বিল্ডিং এর মেইন গেট থেকে পণ্য রিসিভ করতে হবে।</p>
                    </p>
                    <div class="mt-4">
                        <a href="{{ url('/') }}" class="btn-secondary">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================
    404 Area End
    =====================-->
    @else
   <!--=====================
    Home 2 Product Aera Start
    =========================-->
    <div class="home2-product">
        <div class="container">
            <div class="row">
                @foreach ($allOffers as $offer)
                    <div class="col-lg-6 mt-15">
                    <!-- Product Offer Sidebar Start -->
                    <div class="product-offer-slider slick-custom-default">
                        <div class="flash-single-item">
                            <div class="product-item">
                                {{-- <span class="offer-bar"><img src="{{ asset('frontend/assets/images/product/sale-offer.png') }}" alt=""></span> --}}
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <a href="{{ route('our.offers.details', $offer->slug) }}"><img src="{{ asset('backend/uploads/offer/'.$offer->image) }}" alt="{{ $offer->offer_name }}" class="img-fluid"></a>
                                    </a>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name mb-20">
                                        <a href="product-details.html">
                                            <h6>{{ $offer->offer_name }}</h6>
                                        </a>
                                    </div>
                                    <div class="countdown">
                                        <div class="box-countdown">
                                            <div class="title-countdown">
                                                <h6 class="mb-20">Hurry Up! Offer ends in:</h6>
                                            </div>
                                            <div data-countdown="{{ $offer->end_date }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product Offer Sidebar End -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--======================
    Home 2 Product Area End
    ==========================-->
    @endif
@endsection
