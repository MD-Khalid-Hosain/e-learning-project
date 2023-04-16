
<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}">

@yield('header_section')
<!-- Custom Css -->
<link rel="stylesheet" href="{{ asset('backend/assets/css/style.min.css') }}">

</head>

<body class="theme-blush">

{{-- <!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="{{ asset('backend/assets/images/loader.svg') }}" width="48" height="48" alt="Aero"></div>
        <p>Please wait...</p>
    </div>
</div> --}}

<!-- Overlay For Sidebars -->
<div class="overlay"></div>




<!-- Left Sidebar -->
@include('backend.partials.left_sidebar')


<!-- Right Sidebar -->
@include('backend.partials.right_sidebar')

<!-- Main Content -->
<section class="content">
    @yield('content')
</section>



<!-- Jquery Core Js -->
<script src="{{ asset('backend/assets/bundles/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{ asset('backend/assets/bundles/vendorscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->

<script src="{{ asset('backend/assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script><!-- Sweet Alert2 Plugin Js -->


@yield('footer_section')
</body>
</html>

