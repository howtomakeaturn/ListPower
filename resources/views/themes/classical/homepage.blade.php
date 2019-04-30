@extends(theme_path('layout'))

@section('content')

<div class="container">

    @if (true)
    <div class="row">
        <div class="col">
            <div class="jumbotron mt-4 mb-0 p-5 text-center bg-white">
                <h1 class="">
                    <span class="display-5 font-weight-bold">Classical Theme</span>
                    <!--
                    <span class="badge badge-info align-top">Beta 測試版</span>
                    -->
                </h1>
                <p class="lead mt-3">This is ListBox Classical theme.</p>
                <p class="lead mb-0">{{ greet() }}</p>
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
                @include(theme_path('list-card'))
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
                @include(theme_path('list-card'))
            </div>
        @endforeach

        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card mt-3 ml-2 mr-2">
                <div class="card-body">
                    <div style="height: 198px;">
                        <div style="font-size: 1.125rem;">您有想要整理的清單嗎？歡迎透過 Facebook 粉絲專頁，聯絡站長討論！</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="mt-4"></div>

@include(theme_path('footer'))

<style>
    body {
        background-color: white;
    }
    .topic-title {

    }
    .topic-description {
        height: 96px;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

@endsection
