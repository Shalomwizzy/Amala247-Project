<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

        {{-- Javascript --}}

      

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        <!-- google font -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
          href="https://fonts.googleapis.com/css2?family=Lobster&family=Lobster+Two:ital,wght@0,700;1,400;1,700&display=swap"
          rel="stylesheet"
        />

         {{-- LOGO --}}
         <link rel="shortcut icon" href="{{ asset('main logo-fotor-edit black 20.57.31.png') }}">


        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


        {{-- font awesome --}}
        <script src="https://kit.fontawesome.com/cc71075486.js" crossorigin="anonymous"></script>

        {{-- CSS AMINATION --}}
        <link
        rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Scripts -->
    @vite([
        // JS
    'resources/sass/app.scss', 'resources/js/app.js','resources/js/welcome.js','resources/js/reviews.js',
    

    // CSS
    
    'resources/css/app.css','resources/css/style.css','resources/css/menu.css','resources/css/about-us.css','resources/css/contact-us.css','resources/css/bachelor.css','resources/css/event.css','resources/css/navbar.css','resources/css/footer.css','resources/css/login.css','resources/css/register.css','resources/css/order-now.css','resources/css/welcome.css','resources/css/dashboard.css','resources/css/account-details.css','resources/css/address.css','resources/css/order-tracking.css','resources/css/sales-chart.css','resources/css/reviews.css','resources/css/career.css', 'resources/css/value.css', 'resources/css/mission.css','resources/css/privacy-terms.css',])
</head>
{{-- <style>
    .body{
        background-image: url('{{ asset('images/amala247 bacground white.jpg') }}') !important;
    background-size: contain;
    background-position: center;
    }
</style> --}}
<body>
    <div id="app">
      @include('partials.navbar')

      @include('partials.error')
        <main class="py-4">
            @yield('content')
        </main>

        @include('partials.footer')
    </div>
      

         <!-- Back to Top Button -->
         <div id="backToTopBtn" title="Go to top">
            {{-- <i class="fas fa-arrow-up"></i> --}}
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M8 256C8 119 119 8 256 8s248 111 248 248-111 248-248 248S8 393 8 256zm143.6 28.9l72.4-75.5V392c0 13.3 10.7 24 24 24h16c13.3 0 24-10.7 24-24V209.4l72.4 75.5c9.3 9.7 24.8 9.9 34.3.4l10.9-11c9.4-9.4 9.4-24.6 0-33.9L273 107.7c-9.4-9.4-24.6-9.4-33.9 0L106.3 240.4c-9.4 9.4-9.4 24.6 0 33.9l10.9 11c9.6 9.5 25.1 9.3 34.4-.4z"></path></svg>
        </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>
