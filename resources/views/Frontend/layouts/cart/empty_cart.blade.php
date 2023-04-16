
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
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i>Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================
        Breadcrumb Aera End
    =========================-->

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
                    <h4 >Your Shopping Cart is Empty</h4>

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


@endsection
