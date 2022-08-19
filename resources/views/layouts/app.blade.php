<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("fontawesome-free-6.1.2-web/css/all.css") }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', "public/js/fontawesome.js"])
</head>
<body class="{{ isset($overflow) ? "overflow-y-hidden" : "" }} bg-gray-50">
    <div id="app">
        <div class="bg-blue-800 text-white">
            @include("inc.header")
        </div>
        
        <main>
            @yield('content')
        </main>
    </div>

    <footer class="text-center text-gray-600 mt-12">
        Copyright <i class="fa-solid fa-copyright"></i> 1996–2022 Booking.com™. All rights reserved.
    </footer>
    <script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.2/dist/datepicker.js"></script>
</body>
</html>
