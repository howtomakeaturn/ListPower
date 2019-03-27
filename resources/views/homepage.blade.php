@extends('layout')

@section('content')

<div class="container">

    @if (true)
    <div class="row">
        <div class="col">
            <div class="jumbotron mt-4 mb-0">
                <h1 class="">
                    <span class="display-5 font-weight-bold">ListBox 清單盒子</span>
                    <!--
                    <span class="badge badge-info align-top">Beta 測試版</span>
                    -->
                </h1>
                <p class="lead mt-3">蒐集與整理各種實用、有趣的清單。</p>
                <p class="lead">資料持續蒐集中，歡迎幫忙補充各清單的資料。</p>
                <p class="lead mb-0">如果有想要整理的其他清單，請透過 FB 粉專與站長討論，謝謝您。</p>
                <!--
                <a class="btn btn-primary btn-lg" href="#" role="button">動手做一張清單</a>
                -->
            </div>
        </div>
    </div>
    @endif

    <?php
    /*
    <div class="row">
        <div class="col-md-12">
            <h3 class="mt-4 mb-0"><b>熱門清單</b></h3>
        </div>
    </div>

    <div class="row no-gutters" style="margin-left: -0.5rem; margin-right: -0.5rem;">
        @foreach ($topics as $topic)
            <div class="col-xl-3 col-lg-4 col-md-6">
                @include('list-card')
            </div>
        @endforeach
    </div>
    */
    ?>

    <div class="row">
        <div class="col-md-12">
            <h5 class="mt-4 mb-0"><b>網友們建立的各種清單</b></h5>
        </div>
    </div>

    <div class="row no-gutters" style="margin-left: -0.5rem; margin-right: -0.5rem;">
        @foreach ($topics as $topic)
            <div class="col-xl-3 col-lg-4 col-md-6">
                @include('list-card')
            </div>
        @endforeach
    </div>

</div>

<div class="mt-4"></div>

@include('footer')

<style>
    .topic-title {

    }
    .topic-description {
        height: 96px;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

@endsection
