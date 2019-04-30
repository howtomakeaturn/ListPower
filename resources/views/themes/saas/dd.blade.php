@extends(theme_path('ui/layout'))

@section('content')

<div class="container">
    <div class="row">
        <div class="col-6">
            <br>
            <h3>review columns</h3>
            <hr>
            @foreach ($topics as $topic)
                <pre>{{ json_encode(json_decode($topic->review_columns), JSON_PRETTY_PRINT) }}</pre>
                <hr>
            @endforeach
        </div>
        <div class="col-6">
            <br>
            <h3>info columns</h3>
            <hr>
            @foreach ($topics as $topic)
                <pre>{{ json_encode(json_decode($topic->info_columns), JSON_PRETTY_PRINT) }}</pre>
                <hr>
            @endforeach
        </div>
    </div>
</div>

@endsection
