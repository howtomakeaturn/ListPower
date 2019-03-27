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
                <form method="post" action="/submit-settings">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $topic->id }}">
                    @include('add-edit-topic')
                </form>
            </div>
        </div>
    </div>

</div>

<div class="mt-4"></div>

<script src="/js/review-columns-setting-app.js?v={{ time() }}"></script>

<script src="/js/info-columns-setting-app.js?v={{ time() }}"></script>

@endsection
