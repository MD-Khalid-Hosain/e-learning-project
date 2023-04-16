<?php
 use App\Section;
    $sections = Section::sections();
?>
@extends('Frontend.master')
@section('title')
{{ $categoryDetails['categoryDetails']['meta_title'] }}
@endsection
@section('description')
{{ $categoryDetails['categoryDetails']['meta_description'] }}
@endsection
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

                            <li >
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li > <?php echo $categoryDetails['breadcrumbs'] ?></li>
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
    Shop area Start
    ==========================-->
    <div class="shop-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <aside class="sidebar-widget mt-50">
                        <div class="widget_inner widget-background mt-50">
                            <div class="widget_list widget_filter">
                                <div class="sidebar-title">
                                    <h4 class="title-shop">Filter by Price</h4>
                                </div>
                                <form action="#">
                                    <div id="slider-range"></div>
                                    <button type="submit">Filter</button>
                                    <input type="text" name="text" id="amount" />
                                </form>
                            </div>
                            @foreach ($categoryDetails['categoryDetails']['item_types'] as $filter)
                            <div class="widget_list widget_categories mt-20" id="filter">
                                <div class="faq-accordion">
                                    <div class="card actives">
                                        <div class="card-header" id="headingOne{{ $filter['id'] }}">
                                            <h5 class="mb-0">
                                                <a class="collapsed" href="#" data-toggle="collapse" data-target="#collapseOne{{ $filter['id'] }}" aria-expanded="false" aria-controls="collapseOne{{ $filter['id'] }}">
                                                    {{ $filter['item_type_name'] }}
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseOne{{ $filter['id'] }}" class="collapse" aria-labelledby="headingOne{{ $filter['id'] }}" >
                                            <div class="card-body">
                                                <ul>
                                                    @foreach (App\ItemPart::where('item_type_id',$filter['id'])->get() as $item)
                                                    <li>
                                                        <input class="filterProduct" type="checkbox" name="filter_product[]" id="filterProduct" value="{{ $item->id }}">
                                                        <a href="#">{{ $item->item_parts_variant }}</a>
                                                        <span class="checkmark"></span>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- Shop Banner Start -->
                        <div class="single-banner text-center mt-50 mb-30">
                            <a href="#"><img src="{{ asset('frontend/assets/assets/images/banner/shop-banner-2.jpg')}}" alt="" class="img-fluid"></a>
                        </div>
                        <!-- Shop Banner End -->
                    </aside>
                </div>
                <div class="col-lg-9 order-first order-lg-last">
                     @if (session('success'))
                        <div class="alert alert-success alert-dismissible" >
                            <strong>Your Product <span style="color:#0152A2;">{{ session('success') }}</span> Added in Cart Successfully !!</strong>
                            <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="coupon-code">
                                        <div class="view-cart-button">
                                            <a href="{{ url('/cart/view') }}">View Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- Shop Banner Start -->
                    <div class="mb-30  subcategory">
                        @if (count($subcategories)>0)
                        @foreach ($subcategories as $category)
                            <a href="{{ route('header-menu',$category->slug) }}">{{ $category->category_name }}</a>
                        @endforeach
                    @endif
                    </div>
                    <!-- Shop Banner End -->
                    <!-- Shop Toolbar Start -->

                    <div class="toolbar-shop mb-50">
                        <div class="shop_toolbar_btn">
                            <button data-role="grid_3" class="btn-grid-3 active"></button>
                            <button data-role="grid_list" class="btn-list "></button>
                            <a class="btn-primary" href="#filter" >Filter</a>
                        </div>
                        <div class="page-amount">
                            <p>{{ $categoryProductCount }} Products are avilable in this category</p>
                        </div>
                        <form name="sortform" id="sortform" >
                            <input type="hidden" id="slug" name="slug" value="{{ $slug }}">
                            <div>
                                <select name="sort" id="sort" class="form-control">
                                    <option value="">Sort By</option>
                                    <option value="latest_products" @if (isset($_GET['sort']) && $_GET['sort']=="latest_products") selected @endif>Latest Products</option>
                                    <option value="product_name_a_z" @if (isset($_GET['sort']) && $_GET['sort']=="product_name_a_z") selected @endif>Product Name A - Z</option>
                                    <option value="product_name_z_a" @if (isset($_GET['sort']) && $_GET['sort']=="product_name_z_a") selected @endif>Product Name Z - A</option>
                                    <option value="lowest_to_highest" @if (isset($_GET['sort']) && $_GET['sort']=="lowest_to_highest") selected @endif>Lowest to Highest</option>
                                    <option value="highest_to_highest" @if (isset($_GET['sort']) && $_GET['sort']=="highest_to_highest") selected @endif>Highest to Lowest</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <!-- Shop Toolbar End -->
                    <!-- Shop Wrapper Start -->
                    <div class="row shop-wrapper grid_3 filter_prodcuts">
                        @include('Frontend.layouts.product.ajax_product_list')
                    </div>
                    <!-- Shop Wrapper End -->
                    <!-- Shop Toolbar Start -->
                    <div class="toolbar-shop toolbar-bottom">
                        <div class="page-amount">
                            <p>Showing 1-{{ count($categoryProducts) }} of {{ $categoryProductCount }} results</p>
                        </div>
                        <div>
                            <ul>
                                @if (isset($_GET['sort']) && !empty($_GET['sort']))
                                    <li>{{ $categoryProducts->appends(['sort' => $_GET['sort']])->links() }}</li>
                                @else
                                    <li>{{ $categoryProducts->links() }}</li>
                                @endif

                            </ul>
                        </div>
                    </div>
                    <!-- Shop Toolbar End -->

                    <!-- Category Description Start -->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="faq-content">
                                    <div class="faq-desc category-details">
                                        {!! $categoryDetails['categoryDetails']['description'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- Category Description End -->
                </div>
            </div>
        </div>
    </div>
    <!--======================
    Shop area End
    ==========================-->
@endsection
