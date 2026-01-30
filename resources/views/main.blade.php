<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {!! app('seotools')->generate() !!}

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bossku Tours</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/Icon.png') }}?v=2">
    <link rel="apple-touch-icon" href="{{ asset('img/Icon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

    @if (env('APP_ENV') === 'production')
        <link rel="stylesheet" href="{{ asset('build/assets/app-B875Js0p.css') }}">
    @else
        @vite('resources/css/app.css')
    @endif


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>

    <script src="https://unpkg.com/lenis@1.3.11/dist/lenis.min.js"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

</head>

<body class="bg-[#f4f4f4] scroll-smooth">

    @if (!isset($excludeNavbar))
    @include('layout.navbar')
    @endif

    @yield('content')

    @if (!isset($excludeFooter))
    @include('layout.footer')
    @endif

	@if (env('APP_ENV') === 'production')
        <script src="{{ asset('build/assets/app-C4jk1yJQ.js') }}" defer></script>
    @else
        @vite('resources/js/app.js')
    @endif


    <script>
        const lenis = new Lenis({
            duration: 2.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            smoothWheel: true,
            smoothTouch: false,
        });

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>