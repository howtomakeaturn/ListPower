@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">

            @include('repo-top')

        </div>
    </div>
</div>

<?php
    $review = \App\Review::where('entity_id', $entity->id)
        ->where('user_id', Auth::user()->id)
        ->first();
?>

<div class='container'>

    <div class='row'>
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-body">
                    <h3 class="card-title">您正在對「{{ $entity->name }}」評分。</h3>
                    <p>
                        如果之後對「{{ $entity->name }}」有新評價，您隨時可以回來修改評分。
                    </p>
                    <form method="post" action="/submit-review">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $entity->id }}">
                        @foreach ($entity->topic->reviewColumns as $column)
                        <div class="form-group">
                            <label for="">{{ $column->meta_label }}</label>
                            <select class="form-control" name="{{ $column->meta_key }}">
                                <option value="">請選擇（滿分5顆星）</option>
                                @foreach ([1,2,3,4,5] as $int)
                                    @if ($review)
                                        <option value="{{ $int }}" @if($review->value($column->meta_key) === $int) selected @endif>{{ $int }}.0 ★</option>
                                    @else
                                        <option value="{{ $int }}">{{ $int }}.0 ★</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary btn-block">送出評分</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<br>

@endsection
