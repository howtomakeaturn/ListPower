@extends(theme_path('layout'))

@section('content')

<br>

<div class='container'>
    <div class='row'>
        <div class="col-md-6 offset-md-3">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $title }}</h5>
                    <p class="card-text">{{ $text }}</p>
                </div>
            </div>

        </div>
    </div>
</div>

<br>

@endsection
