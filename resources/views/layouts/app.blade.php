<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('dason/assets/images/logo-stikes-single.png') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

    @stack('css-plugins')
</head>
<body data-topbar="dark">

    @yield('content')

    @stack('javascript-plugins')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

</body>
</html>
