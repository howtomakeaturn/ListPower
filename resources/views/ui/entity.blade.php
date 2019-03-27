@extends('ui/layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-8">

            <div class="card mt-4">
                <div class="card-body">
                    <h3><b>Tzemdas Kaffa 手作.獨立思考咖啡</b></h3>
                    @include('ui/review-section')
                    @include('ui/info-section')
                    @include('ui/comment-section')
                </div>
            </div>

        </div>
        <div class="col-lg-4">
            <div class="card mt-4">
                <div class="card-header">
                    參與貢獻資訊
                </div>
                <div class="card-body">
                    <div>
                        <div class="btn-group w-100" role="group">
                            <button class="btn btn-default">
                                <i class="fas fa-edit"></i>&nbsp;我要評分
                            </button>
                            <button class="btn btn-default">
                                <i class="far fa-comment-dots"></i>&nbsp;我要留言
                            </button>
                            <button class="btn btn-default">提出修改</button>
                        </div>
                    </div>
                    <!--
                    <div class="mt-2">
                        <div class="btn-group" role="group">
                            <button class="btn btn-default">編輯標籤</button>
                            <button class="btn btn-default">上傳照片</button>
                            <button class="btn btn-default">提出修改建議</button>
                        </div>
                    </div>
                    -->
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    清單簡介
                </div>
                <div class="card-body">
                    <div><a href="#">台北最適合工作的咖啡廳清單</a></div>
                    <div class="mt-2 text-muted">出沒在不同咖啡廳，找地方工作、看書、喝咖啡的人們。由台灣各地的 cafe nomad 社群，一起整理的咖啡廳清單與地圖。</div>
                </div>
            </div>
            <!--
            <div class="card mt-3">
                <div class="card-body">
                    <div>隸屬於：台北最適合工作的咖啡廳清單</div>
                    <div class="mt-2">basic info ...</div>
                    <hr>
                    contributor info ...
                </div>
            </div>
            -->
        </div>
    </div>
</div>

<div class="mt-4"></div>

@endsection
