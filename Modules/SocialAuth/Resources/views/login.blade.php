<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>歡迎登入</title>

        <link rel="stylesheet" type="text/css" href="/vendor/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/vendor/css/fontawesome-all.css">
        <link rel="stylesheet" type="text/css" href="/vendor/css/open-color.css">

        <script src='/vendor/js/jquery-3.3.1.slim.min.js'></script>
        <script src='/vendor/js/popper-1.14.0.min.js'></script>
        <script src='/vendor/js/bootstrap.min.js'></script>

        <style>
            .card-body div {
                margin-top: 1rem;
            }
            .card-body div:first-child {
                margin-top: 0;
            }
        </style>

    </head>
    <body>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-4">

                    <div class="card mt-5">
                        <div class="card-header">
                            歡迎登入 {{ config('app.name') }}
                        </div>
                        <div class="card-body">

                            @if (config('socialauth.twitter'))
                            <div>
                                <a class="" href="/auth/twitter">
                                    <i class="fab fa-twitter"></i>
                                    用 Twitter 帳號登入
                                </a>
                            </div>
                            @endif

                            @if (config('services.facebook.client_id'))
                            <div>
                                <a class="" href="/auth/facebook">
                                    <i class="fab fa-facebook"></i>
                                    用 Facebook 帳號登入
                                </a>
                            </div>
                            @endif

                            @if (config('socialauth.google'))
                            <div>
                                <a class="" href="/auth/google">
                                    <i class="fab fa-google"></i>
                                    用 Google 帳號登入
                                </a>
                            </div>
                            @endif

                            @if (config('services.github.client_id'))
                            <div>
                                <a class="" href="/auth/github">
                                    <i class="fab fa-github"></i>
                                    用 Github 帳號登入
                                </a>
                            </div>
                            @endif

                        </div>
                    </div>
                    @if (config('services.github.client_id'))
                    <div class="mt-3">
                        <a href="https://github.com/join" target="_blank">還沒有 Github 帳號嗎？請先點此註冊。</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
