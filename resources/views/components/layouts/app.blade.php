<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/gif" sizes="18x18">

    {{-- Styles --}}
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('sites/css/style.css') }}" data-navigate-track>
    <link rel="stylesheet" href="{{ asset('sites/css/output.css') }}" data-navigate-track>

    {{-- vite --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class', // or 'media' for system-based dark mode
            theme: {
                screens: {
                    xs: "540px",
                    sm: "640px",
                    md: "768px",
                    lg: "1025px",
                    xl: "1280px",
                    "2xl": "1536px",
                },
            },
        };
    </script>
</head>

<body class="dark:bg-title">

    {{-- Header --}}
    @include('components.layouts.includes.header')

    {{-- Main Content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    @include('components.layouts.includes.footer')

    {{-- Back to top --}}
    <a href="#" onclick="topFunction()" id="back-to-top"
        class="back-to-top fixed hidden text-lg rectangle-full z-10 bottom-5 end-5 h-9 w-9 text-center bg-[#bb976d] text-white leading-9">
        <i class="mdi mdi-arrow-up"></i>
    </a>

    <script src="{{ asset('sites/js/scripts.js') }}" data-navigate-track></script>

</body>

</html>
