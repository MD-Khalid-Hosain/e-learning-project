<?php
 use App\Section;
    $sections = Section::sections();
?>

    <!-- ========================
    Offcanvas Menu Area Start
    ===========================-->
    <div class="offcanvas_overlay">

    </div>
    <div class="offcanvas_menu">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-2 col-sm-2 col-md-1">
                            <div class="canvas_open">
                                <a class="menu" href="#"><i class="zmdi zmdi-menu"></i></a>
                            </div>
                        </div>
                        <div class="col-10 col-sm-10 col-md-11">
                            <form action="{{ route('search.result') }}" method="GET">
                                <input type="text" class="aa-input-search" placeholder="Enter Your Keywords" id="aa-search-input">
                                <button type="submit"><i class="zmdi zmdi-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="offcanvas_menu_wrapper">
                        <div class="canvas_close">
                            <a href="#"><i class="zmdi zmdi-close"></i></a>
                        </div>
                        <!-- Offcanvas Menu Start -->
                        <div class="offcanvas_menu_cover text-left">
                            <ul class="offcanvas_main_menu">
                            @foreach ($sections  as $section)
                                <li class="menu-item-has-children">
                                    <a href="{{ route('section-menu',$section['slug']) }}">{{ $section['section_name'] }}</a>
                                     @if (count($section['categories'] ) > 0)
                                    <ul class="sub-menu">
                                    @foreach ($section['categories'] as $category)
                                        <li class="menu-item-has-children">
                                            <a href="{{ route('header-menu',$category['slug']) }}">{{ $category['category_name'] }}</a>
                                            @if(count($category['subcategories']) >0)
                                            <ul class="sub-menu">
                                                  @foreach ($category['subcategories'] as $subcategory)
                                                    <li><a href="{{ route('header-menu',$subcategory['slug']) }}">{{ $subcategory['category_name'] }}</a></li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                            @endforeach
                            </ul>
                        </div>
                        <!-- Offcanvas Menu End -->
                        <div class="offcanvas_footer">
                            <span><a href="#"><i class="fa fa-envelope"></i> info@originalstorebd.com</a></span>
                            <div class="footer_social">
                                <ul class="d-flex">
                                    <li><a class="facebook" href="https://www.facebook.com/originalstorebd" target="_blank"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a class="insta" href="https://www.instagram.com/originalstoreltd/" target="_blank"><i class="zmdi fa fa-instagram"></i></a></li>
                                    <li><a class="youtube" href="https://www.youtube.com/originalstorebd" target="_blank"><i class="zmdi zmdi-youtube"></i></a></li>
                                    <li><a class="twitter" href="https://twitter.com/originalstorebd" target="_blank"><i class="zmdi zmdi-twitter"></i></a></li>
                                    <li><a class="linkedin" href="https://www.linkedin.com/company/originalstorebd" target="_blank"><i class="zmdi zmdi-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========================
    Offcanvas Menu Area End
    ===========================-->

    <!-- =================
    Header Area Start
    =====================-->
    <section id="header-part">
        <!-- header overlay start -->
        <div class="header-overlay">
            <!-- top start -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="top">
                        <!-- container start -->
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-5 pr-0">
                                    <div class="phone">
                                        <a href="tel:+880 1739 438877"><i class="zmdi zmdi-phone"></i>+880 1739
                                            438877</a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-7 pl-0">
                                    <div class="buttons">
                                        <a class="{{ count(App\Offer::Offers()->get()) == 0 ? 'offer-button-null' : 'offer-button' }}" href="{{ route('our.offers') }}">Offers</a>
                                          @if(!Auth::guard('ecomUser')->check())
                                          <a class="reg" href=" {{ url('ecom/user/registration') }}">Registration</a>
                                          <a href="{{ url('ecom/user/login') }}">Login</a>
                                          <a class="reg" href="{{ route('blog.page') }}">Blog</a>
                                          @else
                                          <a class="reg" href="{{ route('my.account') }}">My Account</a>
                                          <a href="{{ route('ecom-user-logout') }}">Logout</a>
                                          <a class="reg" href="{{ route('blog.page') }}">Blog</a>
                                          @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- container end -->
                    </div>
                </div>
            </div>
            <!-- top end -->
            <!-- middle start -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="middle">
                        <!-- container start -->
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="logo middle-item">
                                        <div class="img">
                                            <a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/images/logo/original.png') }}" alt="Original Store Ltd logo"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="search middle-item">
                                        <form action="{{ route('search.result') }}" method="GET">
                                            <input type="text" class="aa-input-search aa-search-input2" placeholder="Enter Your Keyword"    name="filter[product_name]">
                                            <button type="submit"><i class="zmdi zmdi-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="icons middle-item">
                                    <a href="{{ url('/pc-build') }}"><span class="pc-build">PC Build - <i class="zmdi zmdi-desktop-windows"></i></span></a>
                                        <a href="{{ route('product.compare') }}"><span class="inner-icon"><i class="fa fa-sliders"></i> <span class="count-num">0</span> </span></a>
                                        <a href="{{ url('/cart/view') }}" class="inner-icon shopping-drop"><i class="zmdi zmdi-shopping-cart"></i> <span class="count-num">{{ total_cart_product() }}</span> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- container end -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- container start -->
                    <div class="container">
                        <div class="mobile-view">
                            <div class="main">
                                <div class="logo middle-item">
                                    <div class="img">
                                       <a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/images/logo/original.png') }}" alt="Original Store Ltd logo"></a>
                                    </div>
                                </div>
                                <div class="icons middle-item">
                                <a href="{{ url('/pc-build') }}"><span class="pc-build">PC Build - <i class="zmdi zmdi-desktop-windows"></i></span></a>
                                    <a href="{{ route('product.compare') }}"><span class="inner-icon"><i class="fa fa-sliders"></i> <span class="count-num">0</span></span></a>
                                    <a href="{{ url('/cart/view') }}"><span class="inner-icon shopping-drop"><i class="zmdi zmdi-shopping-cart"></i> <span class="count-num">{{ total_cart_product() }}</span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- container end -->
                </div>
            </div>
            <!-- middle end -->
            <!-- bottom start -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="bottom sticker">
                        <div class="overlay">
                            <div class="sticky-border">
                                <!-- container start -->
                                    <div class="container">
                                        <div class="menu-part">
                                            <nav class="navbar navbar-expand-lg">
                                                <ul>
                                                    @foreach ($sections  as $section)
                                                    <li class="drop">
                                                        <a href="{{ route('section-menu',$section['slug']) }}" class="top-arrow">{{ $section['section_name'] }} </a>
                                                        @if (count($section['categories'] ) > 0)
                                                            <ul class="drop-down dropdown-width ">
                                                                @foreach ($section['categories'] as $category)
                                                                    <li class="sub-drop">
                                                                        <a href="{{ route('header-menu',$category['slug']) }}" class="down-arrow font-size-drop-down">{{ $category['category_name'] }} @if(count($category['subcategories']) >0)<i class="zmdi zmdi-caret-right float-right"></i>@endif</a>
                                                                        @if(count($category['subcategories']) >0)
                                                                            <ul class="sub-menu dropdown-width">
                                                                                @foreach ($category['subcategories'] as $subcategory)
                                                                                    <li><a href="{{ route('header-menu',$subcategory['slug']) }}" class="font-size-sub-menu">{{ $subcategory['category_name'] }}</a></li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                    @endforeach

                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                        <!-- container end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- bottom end -->
        </div>
        <!-- header overlay end -->
    </section>
    <!-- =================
    Header Area  End
    =====================-->

    <div class="rolling_text ">
    <marquee direction="left">Welcome to Original Store Ltd.  | {{ scrollStatus() }}</marquee>
    </div>
    <!-- =================
    Header Area  End
    =====================-->
