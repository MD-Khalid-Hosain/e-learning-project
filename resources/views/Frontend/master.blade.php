<?php
 use App\Section;
    $sections = Section::sections();
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="ipSFOm5zsf0MxlYRNx-WSbuFRSJe0ydoaycGTYwhO6Y" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="{{ URL::current() }}" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/images/favicon.ico') }}">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap Min Css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/vendor/bootstrap.min.css') }}">
    <!-- Font Awesome Css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/vendor/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/all.css') }}">
    <!-- Material Design Font Css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/vendor/material-design-iconic-font.min.css') }}">
    <!-- Animate Css -->
    {{-- <link rel="stylesheet" href="{{ asset('frontend/assets/css/vendor/animate.min.css') }}"> --}}
    <!-- Magnific Popup CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/magnific-popup.css') }}"> --}}
    <!-- jQuery UI CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/jquery-ui.min.css') }}"> --}}
    <!-- Plugin CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/plugins.css') }}">

    @yield('header_script')

    <!-- Style CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('backend/assets/css/others.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">

</head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-201233072-1">
</script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-201233072-1');
</script>

<body>



    <!-- =================
    Header Area Start
    =====================-->
    @include('Frontend.partials.header_menu')
    <!-- =================
    Header Area  End
    =====================-->

    <!-- =================
    Dynamic part start
    =====================-->
    @yield('content')

    <!-- =================
    Dynamic part end
    =====================-->

    <!--===================
     footer area start
    ===================-->
    @include('Frontend.partials.footer_part')
    <!--===================
     footer area end
    ===================-->

    <!-- Scroll To Top Start -->
    <a class="scroll-to-top" href=""><i class="fa fa-angle-up"></i></a>
    <!-- Scroll To Top End -->

    <!-- JS
============================================ -->
    <!-- jQuery JS -->
    <script src="{{ asset('frontend/assets/js/vendor/jquery-3.4.1.min.js') }}"></script>
    <!-- jQuery Migrate JS -->
    <script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.1.0.min.js') }}"></script>
    <!-- Modernizer JS -->
    <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.8.0.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('frontend/assets/js/vendor/bootstrap.min.js') }}"></script>
    <!-- Plugins JS -->
    <script src="{{ asset('frontend/assets/js/plugins/plugins.js') }}"></script>
    <!-- Jquery ui JS -->
    <script src="{{ asset('frontend/assets/js/plugins/jquery.ui.js') }}"></script>
    <!-- Mailchimp JS -->
    <script src="{{ asset('frontend/assets/js/plugins/jquery.ajaxchimp.min.js') }}"></script>
    <!-- Jquery Magnific Popup JS -->
    {{-- <script src="{{ asset('frontend/assets/js/plugins/jquery.magnific-popup.min.js') }}"></script> --}}
    <!-- Slick JS -->
    <script src="{{ asset('frontend/assets/js/plugins/slick.min.js') }}"></script>
    <!-- Modal JS -->
    <script src="{{ asset('frontend/assets/js/plugins/modal.min.js') }}"></script>
    <!-- Sticky Sidebar JS -->
    <script src="{{ asset('frontend/assets/js/plugins/sticky-sidebar.min.js') }}"></script>
    <!-- Countdown JS -->
    {{-- <script src="{{ asset('frontend/assets/js/plugins/countdown.min.js') }}"></script> --}}
    <!-- jQuery Nice Select JS -->
    <script src="{{ asset('frontend/assets/js/plugins/jquery.nice-select.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

    <!--share in social media-->



    <!--custom script-->

    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>


    <script src="{{ asset('frontend/assets/js/custom_script.js') }}"></script>


    @yield('footer_script')

</body>

</html>
