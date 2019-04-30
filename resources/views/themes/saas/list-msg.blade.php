@extends(theme_path('layout'))

@section('content')

<div class="container">
    <div class="row">
        <div class="col">

            @include(theme_path('repo-top'))

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $title }}</h5>
                    <p class="card-text">{{ $text }}</p>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="mt-4"></div>

@endsection
