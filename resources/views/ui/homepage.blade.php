@extends('ui/layout')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-8">
            <div class="jumbotron mt-4 mb-0">
                <h1 class="">
                    <span class="display-4">ListBox 清單盒子</span>
                    <span class="badge badge-info align-top">Beta</span>
                </h1>
                <p class="lead">打開清單盒子，裡面有網友們整理的各種酷炫清單。<br>
找幾張你有興趣的逛逛，或是自己動手做一張，與同好們互相分享情報。</p>
                <!--
                <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                <a class="btn btn-primary btn-lg" href="#" role="button">看看有什麼清單</a>
                -->
                <a class="btn btn-primary btn-lg" href="#" role="button">動手做一張清單</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3 class="mt-4 mb-0"><b>熱門清單</b></h3>
        </div>
    </div>

    <div class="row no-gutters" style="margin-left: -0.5rem; margin-right: -0.5rem;">
        @foreach ([1,2,3,4,5,6,7,8] as $int)
            <div class="col-xl-3 col-lg-4 col-md-6">
                @include('ui/list-card')
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3 class="mt-4 mb-0"><b>最新清單</b></h3>
        </div>
    </div>

    <div class="row no-gutters" style="margin-left: -0.5rem; margin-right: -0.5rem;">
        @foreach ([1,2,3,4,5,6,7,8] as $int)
            <div class="col-xl-3 col-lg-4 col-md-6">
                @include('ui/list-card')
            </div>
        @endforeach
    </div>

</div>

<div class="mt-4"></div>

@endsection
