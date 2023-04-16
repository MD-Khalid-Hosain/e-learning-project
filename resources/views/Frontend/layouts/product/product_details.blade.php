
@extends('Frontend.master')
@section('title')
{{ $product_info->meta_title }}
@endsection
@section('description')
{{ $product_info->meta_description }}
@endsection

@section('header_script')
<!-- You can use Open Graph tags to customize link previews.
Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
<meta property="og:url"           content="{{route('product-details',$product_info->slug ) }}" />
<meta property="og:type"          content="ecommerce" />
<meta property="og:title"         content="{{ $product_info->product_name }}" />
<meta property="og:description"   content="{{ $product_info->product_name }}" />
<meta property="og:image"         content="{{ asset('backend/uploads/product_main_image/'.$product_info->main_image) }}" />
@endsection
@section('content')
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
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
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i><a href="{{route('section-menu',App\Section::where('id',$product_info->section_id)->value('slug') ) }}">{{ strtolower($product_info->section->section_name) }}</a></li>
                            @if(App\Category::where('id',App\Category::where('id', $product_info->category_id)->value('parent_id'))->value('parent_id') =='0')
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i><a href="{{ route('header-menu',App\Category::where('id',App\Category::where('id', $product_info->category_id)->value('parent_id'))->value('slug') ) }}">{{ strtolower(App\Category::where('id',App\Category::where('id', $product_info->category_id)->value('parent_id'))->value('category_name')) }}</a></li>
                            @endif
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i><a href="{{route('header-menu',$product_info->category_slug ) }}">{{ strtolower($product_info->category_slug) }}</a></li>
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i><a href="{{route('product-details',$product_info->slug ) }}">{{ strtolower($product_info->slug) }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================
    Breadcrumb Aera End
    =========================-->

    <!-- ========================
    Product Details Area Start
    ===========================-->
    <div class="product-area product-details-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-12 mt-50">

                        <!-- Product Zoom Image start -->
                        <div class="product-slider-container arrow-center text-center">
                            <div class="product-item">
                                <a href="{{ asset('backend/uploads/product_main_image/'.$product_info->main_image) }}"><img src="{{ asset('backend/uploads/product_main_image/'.$product_info->main_image) }}" class="img-fluid" alt="{{ $product_info->product_name }}" /></a>
                            </div>
                            @php
                                $flag=0;
                            @endphp
                            @foreach ($multiple_image as $image)
                            <div class="product-item">
                            <a href="{{ asset('backend/uploads/product/'.$image) }}"> <img src="{{ asset('backend/uploads/product/'.$image) }}" class="img-fluid" alt="{{ $product_info->product_name }}" /></a>
                            </div>
                            @php
                                $flag++;
                            @endphp
                            @endforeach

                        </div>
                        <!-- Product Zoom Image End -->
                        <!-- Product Thumb Zoom Image Start -->
                        <div class="product-details-thumbnail arrow-center text-center">
                            <div class="product-item-thumb">
                                <img src="{{ asset('backend/uploads/product_main_image/'.$product_info->main_image) }}" class="img-fluid" alt="{{ $product_info->product_name }}" />
                            </div>
                            @php
                            $flag=0;
                        @endphp
                        @foreach ($multiple_image as $image)
                        <div class="product-item-thumb">
                            <img src="{{ asset('backend/uploads/product/'.$image) }}" class="img-fluid" alt="{{ $product_info->product_name }}" />
                        </div>
                        @php
                            $flag++;
                        @endphp
                        @endforeach

                        </div>

                </div>
                <div class="col-lg-7 col-12 mt-45">
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
                                            <a  href="{{ url('/cart/view') }}">View Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (session('review_success'))
                            <div class="alert alert-success alert-dismissible" >
                                <strong><span style="color:#0152A2;">{{ session('review_success') }}</span></strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    @if (session('error_msg'))
                        <div class="alert alert-danger alert-dismissible" >
                            <strong>{{ session('error_msg') }}</strong>
                            <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <!-- Product Summery Start -->
                    <div class="product-summery position-relative">
                        <div class="product-head">
                            <h1 class="product-title">{{ $product_info->product_name }}</h1>
                        </div>
                        <div class="rating-meta d-flex">
                        <div class="rating">
                            @if ($print_star >0)
                                 @php
                                        $remain_star= 0;
                                    @endphp
                                @for ($i = 1; $i <= $print_star; $i++)
                                <span class="yellow"><i class="fa fa-star"></i></span>
                                    @php
                                        $remain_star= (5 - $print_star);
                                    @endphp
                                @endfor
                                @for ($j = 1; $j<=$remain_star; $j++)
                                    <span class="null-star">&#9734;</span>
                                @endfor
                            @else
                                @for ($k = 1; $k<=5; $k++)
                                    <span class="null-star">&#9734;</span>
                                @endfor
                            @endif
                            </div>
                            <ul class="meta d-flex">

                                <li>
                                    <a href="#read_review"><i class="fa fa-commenting-o"></i>Read reviews({{ $review_count }})</a>
                                </li>
                                <li>
                                    <a href="#review"><i class="fa fa-edit"></i>Write a review</a>
                                </li>
                            </ul>
                        </div>
                        <div class="product-description">
                            <p>
                            <table>
                                <tr><td><span><strong >@if ($product_info->offer_id != null) Offer Price @else Special Price @endif</strong></span></td>
                                    <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td><span class="d-flex flex-row">৳{{ number_format($product_info->price) }}</span></td>

                                @if ($product_info->previous_price != null)
                                     <tr><td><span><strong >Previous Price </strong></span></td>
                                    <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td><span class="d-flex flex-row"><del>৳{{ number_format($product_info->previous_price) }}</del></span></td>
                                </tr>
                                @endif
                                @if ($product_info->regular_price != null)
                                     <tr><td><span><strong >Regular Price(EMI) </strong></span></td>
                                    <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td><span class="d-flex flex-row">৳{{ number_format($product_info->regular_price) }}</span></td>
                                </tr>
                                @endif
                                <tr><td><span><strong >Status </strong></span></td>
                                    <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td><span class="d-flex flex-row" @if ($product_info->product_stock == "Out of Stock")
                                        style="color:red"
                                    @else
                                        @if ($product_info->product_stock == "In Stock")
                                                style="color:green"
                                            @else
                                            style="color:#F58220"
                                        @endif
                                    @endif>{{ $product_info->product_stock }}
                                </span></td>
                                </tr>
                                <tr><td><span><strong >Brand </strong></span></td>
                                    <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td><span class="d-flex flex-row">{{ $product_info->brand->name }}</span></td>
                                </tr>
                                @if ($product_info->product_code != null)
                                <tr><td><span><strong >Product Code </strong></span></td>
                                    <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td><span class="d-flex flex-row">{{ $product_info->product_code  }}</span></td>
                                </tr>
                                @endif
                                @if ($product_info->product_mpn != null)
                                <tr><td><span><strong >Product MPN </strong></span></td>
                                    <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td><span class="d-flex flex-row">{{ $product_info->product_mpn  }}</span></td>
                                </tr>
                                @endif
                            </table>
                            </p>
                            <div class="product-description">
                                <h6>Short Details:</h6>
                                <p>
                                <ul>
                                    @foreach ($product_features as $features)
                                            <li>&bull; {{ $features->fetures }}</li>
                                    @endforeach
                                </ul>
                                <p><a href="#specification">See More Details</a></p>
                                </p>
                            </div>
                        </div>

                        <div class="price-box">
                            <span class="regular-price">৳{{ number_format($product_info->price) }}</span>
                        </div>

                        <form action="{{ route('add-to-cart') }}" method="POST">
                            @csrf
                            <div class="price-box">
                                <input type="checkbox" name="emi" ><span class="ml-2 font-weight-bold">EMI Offer</span><span>(EMI for 6 to 24 Months)</span>
                            </div>
                            <input type="hidden" name="product_id" value="{{ $product_info->id }}">
                            <input type="hidden" name="category_id" value="{{ $product_info->category_id }}">
                            <div class="product-packeges">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="label"><span>Quantity</span></td>
                                            <td class="value">
                                                <div class="product-quantity">
                                                    <span class="qty-btn minus"><i class="fa fa-angle-down"></i></span>
                                                    <input type="text" class="input-qty" name="product_quantity" value="1">
                                                    <span class="qty-btn plus"><i class="fa fa-angle-up"></i></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="product-buttons grid_list">
                                <div class="action-link">
                                    @if ($product_info['product_stock'] == "Out of Stock")
                                        <P class="d-inline font-weight-bold mr-2" style="color:red">Out of Stock</P>
                                    @else
                                        @if ($product_info['product_stock'] == "Up Comming")
                                            <p class="d-inline font-weight-bold mr-2"  style="color:#F58220">Up Comming</p>
                                        @else
                                            <button class="btn-secondary">Add To Cart</button>
                                        @endif
                                    @endif
                                    <a class="wishlist-add same-link" href="wishlist.html" title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                </div>
                            </div>
                        </form>
                        <div class="product-meta">
                            <div class="desc-content">
                                <div class="social_sharing d-flex">
                                    <h5>share this:</h5>
                                        <div class="fb-share-button"
                                        data-href="{{route('product-details',$product_info->slug ) }}"
                                        data-layout="button_count">
                                        </div>
                                         <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                        <div class="addthis_inline_share_toolbox">

                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product Summery End -->
                </div>
                <div class="col-lg-5 col-12 ">

                </div>
            </div>

            <div class="row mt-40">
                <div class="col-lg-9 col-md-12">
                    <div class="nav-tabs">
                        <li data-area="specification">Specification</li>
                        <li data-area="description"> <a href="#description">Description</a></li>
                        <li class="hidden-xs" data-area="ask-question"><a href="#question">Questions</a></li>
                        <li data-area="write-review"><a href="#review">Reviews ({{ $review_count }})</a></li>
                    </div>
                    <section class="specification-tab m-tb-10 product_details_text" id="specification">
                         @foreach ($specification_header as $headerTitle)

                            <table class="data-table " cellspacing="0" cellpadding="0">
                                <colgroup>
                                    <col class="name">
                                    <col class="value">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <td class="heading-row" colspan="3">{{ $headerTitle->header }}</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( App\TitleDescOfSpecification::where('header_id',$headerTitle->id)->where('product_id',$headerTitle->product_id)->get() as $specification)
                                        <tr>
                                            <td class="name">{{ $specification->title }}</td>
                                            <td class="value">{!! $specification->description !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    </section>
                    <section class="specification-tab m-tb-10 scrolling-box" id="description">
                        <h4 >Descripton:</h4>
                        <br>
                         {!! $product_info->product_description !!}
                    </section>
                    <section class="specification-tab m-tb-10 scrolling-box" id="question">
                        <h4 class="mt-10">Ask Question:</h4>
                        <br>
                            <form class="form-row" method="POST" action="{{ route('user.question') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product_info->id }}">
                                <div class="form_group col-6">
                                    <label class="form-label">Name <span class="required">*</span></label>
                                    <input type="text" class="input-form " name="customer_name" value="{{ old('customer_name') }}" >
                                    @error('customer_name')
                                        <span class="text-danger" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form_group col-6">
                                    <label class="form-label">Number <span class="required">*</span></label>
                                    <input id="customer_number" type="text" class="input-form " name="customer_number" value="{{ old('customer_number') }}" >
                                    @error('customer_number')
                                        <span class="text-danger" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form_group col-12 position-relative">
                                    <label class="form-label">Question <span class="required">*</span></label>
                                    <textarea name="question" id="question" class="input-form"  rows="6"></textarea>
                                    @error('question')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form_group group_3 col-lg-3">
                                    <button class="login-register" type="submit">Submit</button>
                                </div>
                            </form>
                    </section>
                    <section class="specification-tab m-tb-10 scrolling-box" id="review">
                        <h4 class="mt-10">Review:</h4>
                        @foreach ($productReviews as $review)
                                <!-- Start Single Review -->
                                <div class="pro_review" id="read_review">
                                    <div class="review_thumb">
                                        <img src="{{ asset('frontend/assets/images/blog/comment/comment-3.jpg') }}" alt="review images">
                                    </div>
                                    <div class="review_details">
                                        <div class="review_info">
                                            <a class="last-title" href="#">{{ $review->name }}</a>
                                            <div class="rating">
                                                    @php
                                                        $remain= 0;
                                                    @endphp
                                                @for ($i = 1; $i<=$review->rating; $i++)
                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                    @php
                                                        $remain= (5 - $review->rating);
                                                    @endphp

                                                @endfor
                                                @for ($i = 1; $i<=$remain; $i++)
                                                        <span class="null-star">&#9734;</span>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="review_date">
                                            <span>{{ $review->created_at->translatedFormat('d-M-Y g:i A') }}</span>
                                        </div>
                                        <p>{{ $review->comment }}</p>
                                    </div>
                                </div>
                                <!-- End Single Review -->
                            @endforeach

                        <br>
                            <form class="form-row" method="POST" action="{{ route('user.review') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product_info->id }}">
                                 <div class="form_group col-6 position-relative">
                                    <label class="form-label">Your Comment <span class="required">*</span></label>
                                    <textarea name="comment" id="comment" class="input-form"  rows="6"></textarea>
                                    @error('comment')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form_group col-12 position-relative">
                                    <label class="form-label">Rating <span class="required">*</span></label>
                                    <div class="feedback">
                                        <div class="rating-emo">
                                        <input type="radio" name="rating" id="rating-5" value="5">
                                        <label for="rating-5"></label>
                                        <input type="radio" name="rating" id="rating-4" value="4">
                                        <label for="rating-4"></label>
                                        <input type="radio" name="rating" id="rating-3" value="3">
                                        <label for="rating-3"></label>
                                        <input type="radio" name="rating" id="rating-2" value="2">
                                        <label for="rating-2"></label>
                                        <input type="radio" name="rating" id="rating-1" value="1">

                                        <label for="rating-1"></label>
                                        <div class="emoji-wrapper">
                                            <div class="emoji">
                                            <svg class="rating-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                            <path d="M512 256c0 141.44-114.64 256-256 256-80.48 0-152.32-37.12-199.28-95.28 43.92 35.52 99.84 56.72 160.72 56.72 141.36 0 256-114.56 256-256 0-60.88-21.2-116.8-56.72-160.72C474.8 103.68 512 175.52 512 256z" fill="#f4c534"/>
                                            <ellipse transform="scale(-1) rotate(31.21 715.433 -595.455)" cx="166.318" cy="199.829" rx="56.146" ry="56.13" fill="#fff"/>
                                            <ellipse transform="rotate(-148.804 180.87 175.82)" cx="180.871" cy="175.822" rx="28.048" ry="28.08" fill="#3e4347"/>
                                            <ellipse transform="rotate(-113.778 194.434 165.995)" cx="194.433" cy="165.993" rx="8.016" ry="5.296" fill="#5a5f63"/>
                                            <ellipse transform="scale(-1) rotate(31.21 715.397 -1237.664)" cx="345.695" cy="199.819" rx="56.146" ry="56.13" fill="#fff"/>
                                            <ellipse transform="rotate(-148.804 360.25 175.837)" cx="360.252" cy="175.84" rx="28.048" ry="28.08" fill="#3e4347"/>
                                            <ellipse transform="scale(-1) rotate(66.227 254.508 -573.138)" cx="373.794" cy="165.987" rx="8.016" ry="5.296" fill="#5a5f63"/>
                                            <path d="M370.56 344.4c0 7.696-6.224 13.92-13.92 13.92H155.36c-7.616 0-13.92-6.224-13.92-13.92s6.304-13.92 13.92-13.92h201.296c7.696.016 13.904 6.224 13.904 13.92z" fill="#3e4347"/>
                                            </svg>
                                            <svg class="rating-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                            <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                            <path d="M328.4 428a92.8 92.8 0 0 0-145-.1 6.8 6.8 0 0 1-12-5.8 86.6 86.6 0 0 1 84.5-69 86.6 86.6 0 0 1 84.7 69.8c1.3 6.9-7.7 10.6-12.2 5.1z" fill="#3e4347"/>
                                            <path d="M269.2 222.3c5.3 62.8 52 113.9 104.8 113.9 52.3 0 90.8-51.1 85.6-113.9-2-25-10.8-47.9-23.7-66.7-4.1-6.1-12.2-8-18.5-4.2a111.8 111.8 0 0 1-60.1 16.2c-22.8 0-42.1-5.6-57.8-14.8-6.8-4-15.4-1.5-18.9 5.4-9 18.2-13.2 40.3-11.4 64.1z" fill="#f4c534"/>
                                            <path d="M357 189.5c25.8 0 47-7.1 63.7-18.7 10 14.6 17 32.1 18.7 51.6 4 49.6-26.1 89.7-67.5 89.7-41.6 0-78.4-40.1-82.5-89.7A95 95 0 0 1 298 174c16 9.7 35.6 15.5 59 15.5z" fill="#fff"/>
                                            <path d="M396.2 246.1a38.5 38.5 0 0 1-38.7 38.6 38.5 38.5 0 0 1-38.6-38.6 38.6 38.6 0 1 1 77.3 0z" fill="#3e4347"/>
                                            <path d="M380.4 241.1c-3.2 3.2-9.9 1.7-14.9-3.2-4.8-4.8-6.2-11.5-3-14.7 3.3-3.4 10-2 14.9 2.9 4.9 5 6.4 11.7 3 15z" fill="#fff"/>
                                            <path d="M242.8 222.3c-5.3 62.8-52 113.9-104.8 113.9-52.3 0-90.8-51.1-85.6-113.9 2-25 10.8-47.9 23.7-66.7 4.1-6.1 12.2-8 18.5-4.2 16.2 10.1 36.2 16.2 60.1 16.2 22.8 0 42.1-5.6 57.8-14.8 6.8-4 15.4-1.5 18.9 5.4 9 18.2 13.2 40.3 11.4 64.1z" fill="#f4c534"/>
                                            <path d="M155 189.5c-25.8 0-47-7.1-63.7-18.7-10 14.6-17 32.1-18.7 51.6-4 49.6 26.1 89.7 67.5 89.7 41.6 0 78.4-40.1 82.5-89.7A95 95 0 0 0 214 174c-16 9.7-35.6 15.5-59 15.5z" fill="#fff"/>
                                            <path d="M115.8 246.1a38.5 38.5 0 0 0 38.7 38.6 38.5 38.5 0 0 0 38.6-38.6 38.6 38.6 0 1 0-77.3 0z" fill="#3e4347"/>
                                            <path d="M131.6 241.1c3.2 3.2 9.9 1.7 14.9-3.2 4.8-4.8 6.2-11.5 3-14.7-3.3-3.4-10-2-14.9 2.9-4.9 5-6.4 11.7-3 15z" fill="#fff"/>
                                            </svg>
                                            <svg class="rating-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                            <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                            <path d="M336.6 403.2c-6.5 8-16 10-25.5 5.2a117.6 117.6 0 0 0-110.2 0c-9.4 4.9-19 3.3-25.6-4.6-6.5-7.7-4.7-21.1 8.4-28 45.1-24 99.5-24 144.6 0 13 7 14.8 19.7 8.3 27.4z" fill="#3e4347"/>
                                            <path d="M276.6 244.3a79.3 79.3 0 1 1 158.8 0 79.5 79.5 0 1 1-158.8 0z" fill="#fff"/>
                                            <circle cx="340" cy="260.4" r="36.2" fill="#3e4347"/>
                                            <g fill="#fff">
                                                <ellipse transform="rotate(-135 326.4 246.6)" cx="326.4" cy="246.6" rx="6.5" ry="10"/>
                                                <path d="M231.9 244.3a79.3 79.3 0 1 0-158.8 0 79.5 79.5 0 1 0 158.8 0z"/>
                                            </g>
                                            <circle cx="168.5" cy="260.4" r="36.2" fill="#3e4347"/>
                                            <ellipse transform="rotate(-135 182.1 246.7)" cx="182.1" cy="246.7" rx="10" ry="6.5" fill="#fff"/>
                                            </svg>
                                            <svg class="rating-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                        <path d="M407.7 352.8a163.9 163.9 0 0 1-303.5 0c-2.3-5.5 1.5-12 7.5-13.2a780.8 780.8 0 0 1 288.4 0c6 1.2 9.9 7.7 7.6 13.2z" fill="#3e4347"/>
                                        <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                        <g fill="#fff">
                                        <path d="M115.3 339c18.2 29.6 75.1 32.8 143.1 32.8 67.1 0 124.2-3.2 143.2-31.6l-1.5-.6a780.6 780.6 0 0 0-284.8-.6z"/>
                                        <ellipse cx="356.4" cy="205.3" rx="81.1" ry="81"/>
                                        </g>
                                        <ellipse cx="356.4" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347"/>
                                        <g fill="#fff">
                                        <ellipse transform="scale(-1) rotate(45 454 -906)" cx="375.3" cy="188.1" rx="12" ry="8.1"/>
                                        <ellipse cx="155.6" cy="205.3" rx="81.1" ry="81"/>
                                        </g>
                                        <ellipse cx="155.6" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347"/>
                                        <ellipse transform="scale(-1) rotate(45 454 -421.3)" cx="174.5" cy="188" rx="12" ry="8.1" fill="#fff"/>
                                    </svg>
                                            <svg class="rating-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                            <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                            <path d="M232.3 201.3c0 49.2-74.3 94.2-74.3 94.2s-74.4-45-74.4-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b"/>
                                            <path d="M96.1 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2C80.2 229.8 95.6 175.2 96 173.3z" fill="#d03f3f"/>
                                            <path d="M215.2 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff"/>
                                            <path d="M428.4 201.3c0 49.2-74.4 94.2-74.4 94.2s-74.3-45-74.3-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b"/>
                                            <path d="M292.2 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2-77.8-65.7-62.4-120.3-61.9-122.2z" fill="#d03f3f"/>
                                            <path d="M411.3 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff"/>
                                            <path d="M381.7 374.1c-30.2 35.9-75.3 64.4-125.7 64.4s-95.4-28.5-125.8-64.2a17.6 17.6 0 0 1 16.5-28.7 627.7 627.7 0 0 0 218.7-.1c16.2-2.7 27 16.1 16.3 28.6z" fill="#3e4347"/>
                                            <path d="M256 438.5c25.7 0 50-7.5 71.7-19.5-9-33.7-40.7-43.3-62.6-31.7-29.7 15.8-62.8-4.7-75.6 34.3 20.3 10.4 42.8 17 66.5 17z" fill="#e24b4b"/>
                                            </svg>
                                            <svg class="rating-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <g fill="#ffd93b">
                                                <circle cx="256" cy="256" r="256"/>
                                                <path d="M512 256A256 256 0 0 1 56.8 416.7a256 256 0 0 0 360-360c58 47 95.2 118.8 95.2 199.3z"/>
                                            </g>
                                            <path d="M512 99.4v165.1c0 11-8.9 19.9-19.7 19.9h-187c-13 0-23.5-10.5-23.5-23.5v-21.3c0-12.9-8.9-24.8-21.6-26.7-16.2-2.5-30 10-30 25.5V261c0 13-10.5 23.5-23.5 23.5h-187A19.7 19.7 0 0 1 0 264.7V99.4c0-10.9 8.8-19.7 19.7-19.7h472.6c10.8 0 19.7 8.7 19.7 19.7z" fill="#e9eff4"/>
                                            <path d="M204.6 138v88.2a23 23 0 0 1-23 23H58.2a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#45cbea"/>
                                            <path d="M476.9 138v88.2a23 23 0 0 1-23 23H330.3a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#e84d88"/>
                                            <g fill="#38c0dc">
                                                <path d="M95.2 114.9l-60 60v15.2l75.2-75.2zM123.3 114.9L35.1 203v23.2c0 1.8.3 3.7.7 5.4l116.8-116.7h-29.3z"/>
                                            </g>
                                            <g fill="#d23f77">
                                                <path d="M373.3 114.9l-66 66V196l81.3-81.2zM401.5 114.9l-94.1 94v17.3c0 3.5.8 6.8 2.2 9.8l121.1-121.1h-29.2z"/>
                                            </g>
                                            <path d="M329.5 395.2c0 44.7-33 81-73.4 81-40.7 0-73.5-36.3-73.5-81s32.8-81 73.5-81c40.5 0 73.4 36.3 73.4 81z" fill="#3e4347"/>
                                            <path d="M256 476.2a70 70 0 0 0 53.3-25.5 34.6 34.6 0 0 0-58-25 34.4 34.4 0 0 0-47.8 26 69.9 69.9 0 0 0 52.6 24.5z" fill="#e24b4b"/>
                                            <path d="M290.3 434.8c-1 3.4-5.8 5.2-11 3.9s-8.4-5.1-7.4-8.7c.8-3.3 5.7-5 10.7-3.8 5.1 1.4 8.5 5.3 7.7 8.6z" fill="#fff" opacity=".2"/>
                                            </svg>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    @error('rating')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>

                                <div class="form_group group_3 col-lg-3">
                                    <button class="login-register" type="submit">Submit</button>
                                </div>
                            </form>
                    </section>
                </div>
                <div class="col-lg-3 left-padding-0 col-md-12">
                    <div class="related-product bg-white">
                        <h3>Related Product {{ total_cart_product() }}</h3>
                        <section class="related-product-list">
                            @foreach ($related_product as $related)
                            <div class="single-related-product-object">
                                <div class="image-holder">
                                    <a href="{{  route('product-details',$related->slug) }}"><img src="{{ asset('backend/uploads/product_main_image/'.$related->main_image) }}" width="100" alt="{{ $related->product_name }}"></a>
                                </div>
                                <div class="caption">
                                        <a href="{{  route('product-details',$related->slug) }}">{{ $related->product_name }}</a>
                                    <div class="price">
                                        <span>৳{{ $related->price }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========================
    Product Details Area End
    ===========================-->
@endsection
@section('footer_script')
  <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ff6c15d02a436d5"></script>
@endsection

