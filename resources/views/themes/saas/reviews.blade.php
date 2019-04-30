@extends(theme_path('layout'))

@section('content')

<br>

<div class='container'>

    <div class='row'>
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">「{{ $entity->name }}」的全部評分：</h3>
                    @foreach($entity->reviews as $review)
                    <div class="@if(!$loop->last) mb-3 @endif">
                        <img class="mr-2" src="{{ $review->user->avatar }}" style="border-radius: 50%; width: 40px; height: 40px; display: inline-block; vertical-align: top;">
                        <div style="font-size: 0.875rem; display: inline-block; width: calc(100% - 55px);">
                            <div class="mb-1">
                                {{ $review->user->name }}
                            </div>
                            <div>
                                @foreach ($entity->topic->reviewColumns as $column)
                                    <div class="d-inline-block">
                                        {{ $column->meta_label }}：
                                        @if($review->value($column->meta_key))
                                            {{ $review->value($column->meta_key) }} ★
                                        @else
                                            未評
                                        @endif
                                        @if(!$loop->last)
                                            、
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>

<br>

@endsection
