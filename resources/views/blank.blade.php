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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}?v=1" rel="stylesheet">

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

    <style>
        /*
        .text-wrap {
            word-wrap: break-word;
            word-break: break-all;
        }
        */
        .text-break {
            word-break: break-all;
        }
        .btn.btn-default {
            color: #292b2c;
            background-color: #fff;
            border-color: #ccc;
        }
        .btn.btn-default:hover {
            color: #292b2c;
            background-color: #e6e6e6;
            border-color: #adadad;
        }
        .btn.btn-default:active {
            color: #292b2c;
            background-color: #e6e6e6;
            background-image: none;
            border-color: #adadad;
        }
        .text-amber {
            color: #FFC107;
        }
        .bg-amber {
            background-color: #FFC107;
        }
        .nav.nav-tabs.main .nav-link.active {
            font-weight: bold;
        }
        .nav.nav-tabs.main .nav-link.active span {
            display: inline !important;
        }
        .entity-tag {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            background-color: #EEEEEE;
            color: #616161;
            /*
            padding: 5px 10px;
            margin-bottom: 5px;
            */
            /*
            font-size: 0.875rem;
            */
            margin-bottom: 5px;
            border-radius: 3px;
        }
        .entity-tag.standalone {
            margin-bottom: 0;
        }
        .entity-tag.clickable:hover {
            cursor: pointer;
            background-color: #E0E0E0;
            color: #616161;
            text-decoration: none;
        }
        .entity-tag.sub {
          margin-bottom: 0;
          padding: 0.2rem 0.4rem;
          font-size: 0.875rem;
        }
        .entity-tag .dismiss {
            display: inline-block;
            /*
            padding-left: 10px;
            */
            padding-left: 0.8rem;
            padding-right: 0px;
        }
        .fix-bottom {
            margin-bottom: -5px;
        }

        .bg-stripes {
            background: repeating-linear-gradient( 45deg,
                var(--oc-gray-2), var(--oc-gray-2) 10px,
                var(--oc-gray-3) 10px, var(--oc-gray-3) 20px
            );
        }

        .thumbnail {
            position: relative;
            width: 100%;
            height: 250px;
            overflow: hidden;
        }

        .thumbnail img {
            position: absolute;
            left: 50%;
            top: 50%;
            max-height: 100%;
            width: auto;
            -webkit-transform: translate(-50%,-50%);
            -ms-transform: translate(-50%,-50%);
            transform: translate(-50%,-50%);
        }
    </style>

    @yield('head')

</head>
<body>

    @include('message-bar')

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
