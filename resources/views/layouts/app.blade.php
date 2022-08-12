<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{-- <script src="https://kit.fontawesome.com/67f8e199dc.js" crossorigin="anonymous"></script> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- <link rel="stylesheet" href="{{ asset("css/all.min.css") }}"> --}}
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', "public/js/fontawesome.js"])
</head>
<body class="{{ isset($overflow) ? "overflow-hidden" : "" }}">
    <div id="app">
        <div class="bg-primary text-white">
            @include("inc.header")
        </div>

        <main>
            @yield('content')
        </main>
    </div>
    <script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.2/dist/datepicker.js"></script>
</body>
</html>
