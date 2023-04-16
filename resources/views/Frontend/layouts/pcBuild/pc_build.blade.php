<?php
 use App\Section;
    $sections = Section::sections();
?>
@extends('Frontend.master')

@section('content')
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root" ></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v9.0'
    });
  };

  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your Chat Plugin code -->
<div class="fb-customerchat mb-5"
  attribution=setup_tool
  page_id="2374804922748585"
theme_color="#0A7CFF"
logged_in_greeting="অরিজিনাল ষ্টোর বিডি ফেসবুক পেজে আপনাকে স্বাগত। How can i Help You?"
logged_out_greeting="অরিজিনাল ষ্টোর বিডি ফেসবুক পেজে আপনাকে স্বাগত। How can i Help You?">
</div>
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
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i>PC Build</li>
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

                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                @if (session('message'))
                        <div class="alert alert-danger alert-dismissible" >
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="toolbar-shop toolbar-bottom">
                        <div class="page-amount">
                            <p>Get a Quote</p>
                        </div>
                        <div class="pagination">
                            <ul>
                                <li class="current"style="background:#104043"><a href="{{ route('pc.build.addToCart') }}"><i class="fa fa-cart-arrow-down"></i></a></li>
                                <li class="current"style="background:#104043"><a href="{{ url('/print/pc/build/'.$session_id) }}"><i class="fa fa-print" ></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content dashboard-content mb-20" id="pcbuildTable">

                         <div id="orders" class="tab-pane fade active show">
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead class="table-head">
                                        <tr>
                                            <th class="head-content">Component</th>
                                            <th class="head-content text-center">Image</th>
                                            <th class="head-content text-center">Product Name</th>
                                            <th class="head-content text-center">Price</th>
                                            <th class="head-content text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body" >
                                         @php
                                            $total =0;
                                        @endphp
                                        @foreach ($allComponents as $item)
                                            <tr class="beforeclick">
                                                <td class="font-weight-bold">{{ $item->component_name }}</td>
                                                <td class="border-hide"><img src="{{ asset('backend/uploads/product_main_image') }}/{{ App\Product::where('id',App\ComponentProducts::where('component_id',$item->id)->where('session_id', $session_id)->value('product_id'))->value('main_image') }}" alt="" width="50"></td>
                                                <td class="border-hide">{{ App\Product::where('id',App\ComponentProducts::where('component_id',$item->id)->where('session_id', $session_id)->value('product_id'))->value('product_name') }}</td>
                                                <td class="border-hide">
                                                    @if (App\ComponentProducts::where('component_id',$item->id)->where('session_id', $session_id)->value('product_id'))
                                                    ৳ {{ App\Product::where('id',App\ComponentProducts::where('component_id',$item->id)->where('session_id', $session_id)->value('product_id'))->value('price') }}
                                                    @endif
                                                </td>
                                                <td class="border-hide ">
                                                    @if ( App\ComponentProducts::where('component_id',$item->id)->where('session_id', $session_id)->value('product_id'))
                                                        <a class="btn btn-secondary pcBuildDelete" style="background:#104043" href="{{ route('remove.component.product', App\ComponentProducts::where('component_id',$item->id)->where('session_id', $session_id)->value('id') ) }}" >Remove</a> <a class="btn btn-secondary" style="background:#104043" href="{{ route('component.product',$item->id) }}">Choose</a>
                                                        @else
                                                        <a class="btn btn-secondary" style="background:#104043" href="{{ route('component.product',$item->id) }}">Choose</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                                $total = $total+ App\Product::where('id',App\ComponentProducts::where('component_id',$item->id)->where('session_id', $session_id)->value('product_id'))->value('price');
                                            @endphp
                                        @endforeach
                                        @foreach ($allComponents as $item)
                                        <tr class="after-click">
                                            <td class="pro-name"> {{ $item->component_name }}</td>
                                            <td class="pro-img"><img src="{{ asset('backend/uploads/product_main_image') }}/{{ App\Product::where('id',App\ComponentProducts::where('component_id',$item->id)->where('session_id', $session_id)->value('product_id'))->value('main_image') }}" alt="" width="50"></td>
                                            <td class="pro-detail">{{ App\Product::where('id',App\ComponentProducts::where('component_id',$item->id)->where('session_id', $session_id)->value('product_id'))->value('product_name') }}</td>
                                            <td class="pro-price">
                                                @if (App\ComponentProducts::where('component_id',$item->id)->where('session_id', $session_id)->value('product_id'))
                                                    ৳ {{ App\Product::where('id',App\ComponentProducts::where('component_id',$item->id)->where('session_id', $session_id)->value('product_id'))->value('price') }}
                                                    @endif
                                            </td>
                                            <td class="dubble-btn">
                                                @if ( App\ComponentProducts::where('component_id',$item->id)->where('session_id', $session_id)->value('product_id'))
                                                        <a class="btn btn-secondary pcBuildDelete" style="background:#104043" href="{{ route('remove.component.product', App\ComponentProducts::where('component_id',$item->id)->where('session_id', $session_id)->value('id')) }}" >Remove</a> <a class="btn btn-secondary" style="background:#104043" href="{{ route('component.product',$item->id) }}">Choose</a>
                                                        @else
                                                        <a class="btn btn-secondary" style="background:#104043" href="{{ route('component.product',$item->id) }}">Choose</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach

                                        <tr>
                                            <td class="font-weight-bold"> Total </td>
                                            <td></td>
                                            <td></td>
                                            <td> ৳ {{ $total }} </td>
                                            <td></td>
                                        </tr>
                                        </tbody>

                                    </tbody>
                                </table>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--======================
    My Account area End
    ==========================-->
    {{-- <input type="hidden" value="{{ route('remove.component.product') }}" id="pcbuildurl"> --}}
    @endsection
