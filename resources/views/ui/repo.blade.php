@extends('ui/layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">

            @include('ui/repo-top')

            <ul class="nav nav-tabs mt-3">
                <li class="nav-item">
                    <a class="nav-link active" href="#">資料</a>
                </li>
                @foreach (['編修紀錄', '貢獻者名單', /*'留言板',*/ '設定'] as $tab)
                <li class="nav-item">
                    <a class="nav-link" href="/commits">{{ $tab }}</a>
                </li>
                @endforeach
            </ul>

        </div>
    </div>

    <div class="row no-gutters" style="margin-left: -0.5rem; margin-right: -0.5rem;">
        @for ($i = 0 ; $i < 20 ; $i ++)
            <div class="col-xl-3 col-lg-4 col-md-6">
                @include('ui/summary-card')
            </div>
        @endfor
    </div>
</div>

<div class="mt-4"></div>

@endsection
