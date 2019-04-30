<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-85456048-7"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-85456048-7');
    </script>

    <meta name="google-site-verification" content="WyZWU197miTFFqI6SEQUv-HlXkEC6xXjvjdAA5F9c-8" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ AppCore::getOpenGraphTitle() }}
    </title>

    <meta property='og:title' content="{{ AppCore::getOpenGraphTitle() }}">
    <meta property='og:description' content="{{ AppCore::getOpenGraphTitle() }}">
    <meta property='og:image' content="{{ AppCore::getOpenGraphImage() }}">

    <!-- Scripts -->
    <!--
    <script src="{{ asset('js/app.js') }}" defer></script>
    -->
    <link rel="stylesheet" type="text/css" href="/vendor/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="/vendor/css/open-color.css">

    <script src='/vendor/js/jquery-3.3.1.min.js'></script>
    <script src='/vendor/js/popper-1.14.0.min.js'></script>
    <script src='/vendor/js/bootstrap.min.js'></script>

    <script src="/vendor/toastr/toastr.min.js" defer></script>
    <link href="/vendor/toastr/toastr.min.css" rel="stylesheet">

    <!--
    <link rel="stylesheet" type="text/css" href="/vendor/css/fontawesome-all.css">
    -->
    <!--
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    -->

    <link rel="stylesheet" type="text/css" href="/vendor//fontawesome-5.6.3/css/all.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/autosize.js/4.0.2/autosize.min.js"></script>

    <script src="/vendor/linkify/linkify.min.js"></script>
    <script src="/vendor/linkify/linkify-jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.linkify').linkify({
                target: "_blank"
            });
        });
    </script>

    @yield('head')

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ url('/admin') }}">
            <b>Classical</b>
            <!--
            <span class="badge badge-info align-top">Beta 測試版</span>
            -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <!--
                <li class="nav-item">
                    <a class="nav-link" href="/about">網站介紹</a>
                </li>
                -->
                <!--
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        社群連結
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="https://www.facebook.com/groups/567425433698763/">
                            FB社團
                        </a>
                        <a class="dropdown-item" href="https://www.facebook.com/Devstw-389199321619519/">
                            FB粉專
                        </a>
                        <a class="dropdown-item" href="https://line.me/R/ti/g/LdxKCapKiF">
                            Line：自學網頁の新手交流群組
                        </a>
                    </div>
                </li>
                -->
            </ul>

        </div>

    </nav>

    @include(theme_path('message-bar'))

    @yield('content')

    <script>
        $(document).ready(function(){
            @if (session('status'))
                toastr.success('{{ session('status') }}');
            @endif

            autosize(document.querySelectorAll('textarea'));
        });
    </script>

</body>
</html>
