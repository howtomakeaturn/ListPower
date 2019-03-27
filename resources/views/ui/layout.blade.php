<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}?v=1" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/vendor/css/open-color.css">

    <script src='/vendor/js/jquery-3.3.1.slim.min.js'></script>

    <script src="/vendor/toastr/toastr.min.js" defer></script>
    <link href="/vendor/toastr/toastr.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/vendor/css/fontawesome-all.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/autosize.js/4.0.2/autosize.min.js"></script>

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
    </style>

    @yield('head')

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <a class="navbar-brand" href="{{ url('/') }}">
            <b>ListBox</b>
            <span class="badge badge-info align-top">Beta</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

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
