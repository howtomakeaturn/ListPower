@extends(theme_path('layout'))

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="h6 mb-0">建立新清單</h3>
                </div>
                <form method="post" action="/submit-list">
                    {{ csrf_field() }}
                    @include(theme_path('add-edit-topic'))
                </form>
            </div>
        </div>
    </div>
</div>

<div class="mt-4"></div>

<script src="/js/review-columns-setting-app.js?v={{ time() }}"></script>

<script src="/js/info-columns-setting-app.js?v={{ time() }}"></script>

@endsection
