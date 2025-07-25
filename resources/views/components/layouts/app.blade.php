<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=1">

    <title>{{ config('app.name') }}</title>
    <!-- Add site Favicon -->
    <link rel="icon" href="{{ asset('sites/images/favicon/favicon.png') }}" />

    {{-- Stylesheets --}}
    <link rel="stylesheet" href="{{ asset('sites/css/vendor/vendor.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('sites/css/plugins/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('sites/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sites/css/style.css') }}" />
</head>

<body>

    {{-- Header --}}
    @include('components.layouts.includes.header')

    {{-- Content --}}
    {{ $slot }}

    {{-- Footer --}}
    @include('components.layouts.includes.footer')

    {{-- Scripts --}}
    <script src="{{ asset('sites/js/vendor/vendor.min.js') }}"></script>
    <script src="{{ asset('sites/js/plugins/plugins.min.js') }}"></script>
    <script src="{{ asset('sites/js/main.js') }}"></script>
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
</body>

</html>
