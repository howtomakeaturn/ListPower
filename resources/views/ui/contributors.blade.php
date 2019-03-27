@extends('ui/layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">

            @include('ui/repo-top')

            <ul class="nav nav-tabs mt-3">
                <li class="nav-item">
                    <a class="nav-link" href="/repo">資料</a>
                </li>
                @foreach (['編修紀錄', '貢獻者名單', /*'留言板',*/ '設定'] as $tab)
                <li class="nav-item">
                    <a class="nav-link @if ($tab==='貢獻者名單') active @endif" href="#">{{ $tab }}</a>
                </li>
                @endforeach
            </ul>

            <div class="row no-gutters" style="margin-left: -0.5rem; margin-right: -0.5rem;">
                @foreach ([1,2,3,4,5,6,7,8] as $contribution)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    @include('ui/contributor-card')
                </div>
                @endforeach
            </div>


        </div>
    </div>

</div>

<div class="mt-4"></div>

@endsection
