@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">

            @include('repo-top')

        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-body">
                    <h3 class="card-title">新增一筆資料到「{{ $topic->name }}」。</h3>
                    <form method="post" action="/submit-add">
                        {{ csrf_field() }}

                        <input type="hidden" name="id" value="{{ $topic->id }}">

                        <div class="form-group">
                            <label for="">名稱</label>
                            <input type="text" name="name" class="form-control" value="" required>
                        </div>

                        @foreach ($topic->sortedInfoSections() as $section)
                            @foreach ($section->sortedInfoColumns() as $column)
                                @include('_new-edit-form-column')
                            @endforeach
                        @endforeach

                        <button type="submit" class="btn btn-primary btn-block">送出資料</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="mt-4"></div>

@endsection
