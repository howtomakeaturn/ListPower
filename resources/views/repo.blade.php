@extends('layout')

@section('content')

<div class="container">

    @if (AppCore::getCurrentMode() !== 'map')
    <div class="row">
        <div class="col">

            @include('repo-top')

        </div>
    </div>
    @endif

    @if (!AppCore::getCurrentFilter() && AppCore::getCurrentMode() !== 'map')

    <div class="mt-3">{{ $topic->description }}</div>

    @include('summary-bar')

    @include('feed-bar')

    @endif

    @include('filter-bar')

    @if (AppCore::getCurrentMode() === 'map')
        @include('map')
    @else
        <div class="row no-gutters" style="margin-left: -0.5rem; margin-right: -0.5rem;">
            @if ($entities->count() === 0)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card mt-3 ml-2 mr-2">
                        <div class="card-body">
                            <p>清單內還沒有任何資料喔！</p>
                            <p>馬上幫這張清單蒐集資料吧！</p>
                            <a href="/add/{{ $topic->hashids() }}" class="btn btn-primary">新增資料</a>
                        </div>
                    </div>
                </div>
            @endif

            @foreach ($entities as $entity)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    @include('summary-card')
                </div>
            @endforeach
        </div>
        <div class="mt-4"></div>
    @endif
</div>


@endsection
