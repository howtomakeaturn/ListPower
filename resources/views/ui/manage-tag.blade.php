@extends('layout')

@section('content')

<div class="container">
    <!--
    <div class="row">
        <div class="col">
            <div class="mt-4">標籤編輯：Mikkeller Taipei 米凱</div>
        </div>
    </div>
    -->

    <div class="row">
        <div class="col-md-4">
            <div class="mt-4"><b>使用者給「Mikkeller Taipei 米凱樂」的熱門標籤：</b></div>
            <div class="card mt-2">
                <div class="card-body">

                    @foreach(['某個標籤', '某某標籤', '標籤', '標籤標籤', '標籤阿', '標籤阿', '標籤阿', '標籤', '標籤'] as $tag)
                        <div class="@if(!$loop->last) border-bottom pb-2 mb-2 @endif">
                            <span class='entity-tag standalone'>
                                {{ $tag }}
                            </span>
                            @if (rand()%2)
                            <a href="#!" class="btn btn-link btn-sm">取消</a>
                            @else
                            <a href="#!" class="btn btn-default btn-sm">
                                <i class="fas fa-plus-circle"></i>
                                <span>同意</span>
                            </a>
                            @endif
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="mt-4"><b>您給「Mikkeller Taipei 米凱樂啤酒吧」的標籤：</b></div>
            <div class="card mt-2">
                <div class="card-body">

                    @foreach(['某個標籤', '某某標籤', '標籤', '標籤標籤', '標籤阿', '標籤阿', '標籤阿', '標籤', '標籤'] as $tag)
                        <div class="@if(!$loop->last) border-bottom pb-2 mb-2 @endif">
                            <span class='entity-tag standalone'>
                                {{ $tag }}
                            </span>
                            <a href="#!" class="btn btn-link btn-sm">取消</a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        <div class="col-md-4">

            <div class="mt-4"><b>您有三種方式加上標籤：</b></div>

            <div class="card mt-2">
                <div class="card-body">
                    <div class="mb-2"><b>1. 手動新增標籤</b></div>

                    <div class="mb-1">請輸入可作為分類依據的名詞。</div>

                    <form class="form-inline" method="post" action='/tag/new-tag'>
                        {{csrf_field()}}
                        <input type='hidden' name='post_id' value='$post->id'>
                        <input type="text" class="form-control" placeholder="輸入標籤..." name="tag_name" required>
                        <input type="submit" class="btn btn-primary ml-2" value="新增標籤">
                    </form>

                    <hr>

                    <div class="mb-2"><b>2. 使用您之前給過的標籤</b></div>

                    <div class="fix-bottom">
                    @foreach(['某個標籤', '某某標籤', '標籤', '標籤標籤', '標籤阿', '標籤阿', '標籤阿', '標籤', '標籤'] as $tag)
                        <a class='entity-tag clickable apply' href="#!" data-tag-id="123">
                            <i class="fas fa-plus-circle"></i>&nbsp;
                            {{ $tag }}
                        </a>
                    @endforeach
                    </div>

                    <hr>

                    <div class="mb-2"><b>3. 使用其他常見標籤</b></div>

                    <div class="fix-bottom">
                    @foreach(['某個標籤', '某某標籤', '標籤', '標籤標籤', '標籤阿', '標籤阿', '標籤阿', '標籤', '標籤'] as $tag)
                        <a class='entity-tag clickable apply' href="#!" data-tag-id="123">
                            <i class="fas fa-plus-circle"></i>&nbsp;
                            {{ $tag }}
                        </a>
                    @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-4"></div>

@endsection
