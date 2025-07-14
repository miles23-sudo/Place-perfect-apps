<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{ config('app.name') }}</title>
    <!-- Add site Favicon -->
    <link rel="icon" href="{{asset('template/images/favicon/favicon.png')}}" />

    {{-- Stylesheets --}}
    <link rel="stylesheet" href="{{asset('template/css/vendor/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('template/css/vendor/simple-line-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('template/css/vendor/ionicons.min.css')}}" />
    <link rel="stylesheet" href="{{asset('template/css/plugins/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('template/css/plugins/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{asset('template/css/plugins/jquery-ui.min.css')}}" />
    <link rel="stylesheet" href="{{asset('template/css/plugins/jquery.lineProgressbar.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/plugins/nice-select.css')}}" />
    <link rel="stylesheet" href="{{asset('template/css/plugins/venobox.css')}}" />
    <link rel="stylesheet" href="{{asset('template/css/style.css')}}" />

</head>

<body>

    {{-- Header --}}
    @include('components.layouts.includes.header')

    {{-- Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('components.layouts.includes.footer')

    {{-- Scripts --}}
    <script src="{{asset('template/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('template/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('template/js/vendor/jquery-migrate-3.3.2.min.js')}}"></script>
    <script src="{{asset('template/js/vendor/modernizr-3.11.2.min.js')}}"></script>
    <script src="{{asset('template/js/plugins/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('template/js/plugins/jquery-ui.min.js')}}"></script>
    <script src="{{asset('template/js/plugins/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('template/js/plugins/countdown.js')}}"></script>
    <script src="{{asset('template/js/plugins/scrollup.js')}}"></script>
    <script src="{{asset('template/js/plugins/jquery.waypoints.js')}}"></script>
    <script src="{{asset('template/js/plugins/jquery.lineProgressbar.js')}}"></script>
    <script src="{{asset('template/js/plugins/jquery.zoom.min.js')}}"></script>
    <script src="{{asset('template/js/plugins/venobox.min.js')}}"></script>
    <script src="{{asset('template/js/plugins/ajax-mail.js')}}"></script>
    <script src="{{asset('template/js/main.js')}}"></script>
</body>

</html>