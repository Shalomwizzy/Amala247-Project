<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
           <link rel="shortcut icon" href="{{ asset('images/main logo-fotor-edit black 20.57.31.png') }}">

       {{-- Java script --}}

       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    'resources/css/app.css','resources/css/style.css','resources/css/menu.css','resources/css/about-us.css','resources/css/contact-us.css','resources/css/bachelor.css','resources/css/event.css','resources/css/navbar.css','resources/css/footer.css','resources/css/login.css','resources/css/register.css','resources/css/admin-nav.css','resources/css/categorycreate.css','resources/css/categoryedit.css','resources/css/categoryindex.css', 'resources/css/product-create.css',
    'resources/css/product-edit.css','resources/css/sales-chart.css','resources/css/reviews.css','resources/css/career.css', 'resources/css/value.css', 'resources/css/mission.css','resources/css/privacy-terms.css',])
</head>
<body>
    <div id="app">
      @include('partials.admin-nav')

      @include('partials.error')
        <main class="py-4">
            @yield('content')
        </main>

        @include('partials.footer')
    </div>
</body>
</html>