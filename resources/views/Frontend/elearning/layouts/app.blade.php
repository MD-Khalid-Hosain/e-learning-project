<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Learn Academy</title>

    @include('Frontend.elearning.partials.header')
</head>
<body class="gray-bg">
    @include('Frontend.elearning.partials.navbar')
    @yield('content')
    @include('Frontend.elearning.partials.footer')
    @include('Frontend.elearning.partials.scripts')
</body>
</html>
