@extends('Frontend.master')

@section('content')


    <!--======================
    Shop area Start
    ==========================-->
    <div class="shop-area">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 order-first order-lg-last">
                    <!-- Shop Banner Start -->
                    <div class="single-banner mt-50 mb-50">
                        <a href="#"><img src="assets/images/banner/shop-banner-1.jpg" alt="" class="img-fluid"></a>
                    </div>
                    <!-- Shop Banner End -->
                    <form action="{{ route('component.product',$component_id) }}" method="get">
                        <div class="category-search">
                            <input class="search-hear" type="text" placeholder="Enter your search key ..."  name="filter[product_name]"
                                autocomplete="off" >

                            <button class="srch-btn" type="submit"><i class="zmdi zmdi-search"></i></button>
                        </div>
                    </form>

                    <!-- Shop Toolbar Start -->
                    <div class="toolbar-shop mb-50">
                        <div class="shop_toolbar_btn">
                            <button data-role="grid_3" class="btn-grid-3 active"></button>
                            <button data-role="grid_list" class="btn-list "></button>
                        </div>
                        <div class="page-amount">
                            <p> {{ $component_product_count }} Products are avilable in this category</p>
                        </div>
                        <div>


                        </div>
                    </div>
                    <!-- Shop Toolbar End -->
                    <!-- Shop Wrapper Start -->
                    <div class="row shop-wrapper grid_3 filter_prodcuts">

                        @foreach ($component_product as $product)
                            <div class="col-lg-4 col-cust-5 col-12 mb-20">
                            <!-- Single-Product-Start -->
                            <div class="item-product pt-0">
                                <div class="product-thumb">
                                    <a href="{{ route('product-details',$product['slug']) }}">
                                        <img src="{{ asset('backend/uploads/product_main_image/'.$product['main_image']) }}" alt="{{ $product['product_name'] }}" class="img-fluid">
                                    </a>
                                    @if ($product['offer_id'] != null)
                                        @if (App\Offer::where('id', $product['offer_id'])->value('status') == 1)
                                        <div class="box-label">
                                            <div class="label-product-discount">
                                                <a href="{{ route('our.offers.details',App\Offer::where('id', $product['offer_id'])->where('status', 1)->value('slug')) }}"><span>{{ App\Offer::where('id', $product['offer_id'])->where('status', 1)->value('offer_title') }}</span></a>
                                            </div>
                                        </div>
                                        @endif
                                    @else

                                    @endif
                                    <div class="action-link">
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html" title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-name">
                                        <a href="{{ route('product-details',$product['slug']) }}">{{ $product['product_name'] }}</a>
                                    </div>
                                    <div class="rating">
                                        @php
                                        $productReviews = App\Review::where('product_id', $product['id'])->where('status',1)->get();
                                            //array variable initialization
                                        $allStars= [];
                                        $flag=0;
                                        //geting this product review rating
                                        foreach($productReviews as $review){
                                            $allStars[] = $review->rating;
                                            $flag++;
                                        }
                                        // highest value in all rating
                                        $print_star = 0;
                                        foreach($allStars as $key=>$val){
                                            if($val > $print_star){
                                                $print_star = $val;
                                            }
                                        }
                                        @endphp
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
                                    <div class="product-tax mb-20">
                                        <ul>
                                            @php
                                                $i=0;
                                            @endphp
                                            @foreach (App\ProductFetures::where('product_id', $product['id'])->get() as $features)
                                            <li>&diams; {{ $features['fetures'] }}</li>
                                            @php
                                                $i++;
                                                if($i==3) break;
                                            @endphp
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">৳{{ number_format($product['price']) }}</span>
                                        @if ($product['previous_price'] != null)

                                        <del><span >৳{{ number_format($product['previous_price']) }}</span></del>
                                        @else

                                        @endif
                                    </div>
                                    <div class="cart">

                                        <div class="add-to-cart">
                                            <form action="{{ route('add-to-pcBuild') }}" method="POST">
                                            @csrf

                                                <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                                <input type="hidden" name="component_id" value="{{ $component_id }}">
                                                <input type="hidden" name="support" value="{{ $product['support'] }}">
                                                <input type="hidden" name="processor" value="{{ $product['processor'] }}">
                                                <button type="submit">Add</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                                <div class="grid-list-caption align-items-center">
                                    <div class="product-name">
                                        <a href="{{ route('product-details',$product['slug']) }}">{{ $product['product_name'] }}</a>
                                    </div>
                                    <div class="rating">
                                        @php
                                        $productReviews = App\Review::where('product_id', $product['id'])->where('status',1)->get();
                                            //array variable initialization
                                        $allStars= [];
                                        $flag=0;
                                        //geting this product review rating
                                        foreach($productReviews as $review){
                                            $allStars[] = $review->rating;
                                            $flag++;
                                        }
                                        // highest value in all rating
                                        $print_star = 0;
                                        foreach($allStars as $key=>$val){
                                            if($val > $print_star){
                                                $print_star = $val;
                                            }
                                        }
                                        @endphp
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
                                    <div class="product-tax mb-20">
                                        <ul>
                                            @foreach (App\ProductFetures::where('product_id', $product['id'])->get() as $features)
                                            <li>&diams; {{ $features['fetures'] }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="text-available">
                                        <p><strong>Brand:</strong><span> {{ $product['brand']['name'] }}</span></p>
                                    </div>
                                    <div class="price-box">
                                        <span class="regular-price">৳{{ number_format($product['price']) }}</span>
                                        @if ($product['previous_price'] != null)

                                        <del><span >৳{{ number_format($product['previous_price']) }}</span></del>
                                        @else

                                        @endif
                                    </div>
                                    <div class="action-link">
                                        <a class="compare-add same-link" href="compare.html" title="Add to compare"><i class="zmdi zmdi-refresh-alt"></i></a>
                                        <a class="wishlist-add same-link" href="wishlist.html" title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
                                    </div>
                                    <div class="cart-list-button">
                                        <form action="{{ route('add-to-pcBuild') }}" method="POST">
                                        @csrf

                                            <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                            <input type="hidden" name="component_id" value="{{ $component_id }}">
                                            <button type="submit" class="cart-btn">Add</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Single-Product-End -->
                        </div>
                        @endforeach

                    </div>
                    <!-- Shop Wrapper End -->
                    <!-- Shop Toolbar Start -->
                    <div class="toolbar-shop toolbar-bottom">
                        <div class="page-amount">
                            <p>Showing 1-{{ $component_product_count }} results</p>
                        </div>

                    </div>
                <!-- Shop Toolbar End -->
            </div>
        </div>
    </div>

@endsection


