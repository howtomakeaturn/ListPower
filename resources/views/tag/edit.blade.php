@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">

            @include('repo-top')

        </div>
    </div>
</div>

<div class="container">

    <div class="row">
        <div class="col">
            <div class="card mt-4">
                <div class="card-body">
                    <div>
                        您正在對「{{ $entity->name }}」編輯標籤。
                        <a href="/view/{{ $entity->hashids() }}">點這裡可以回到「{{ $entity->name }}」資料頁面。</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="mt-4"><b>使用者給「{{ $entity->name }}」的熱門標籤：</b></div>
            <div class="card mt-2">
                <div class="card-body">

                    @foreach($entity->uniqueTags()->sortByDesc(function($tag)use($entity){return $tag->countOnEntity($entity);}) as $tag)
                    <div class="@if(!$loop->last) border-bottom pb-2 mb-2 @endif">
                        <span class='entity-tag standalone'>
                            {{ $tag->name }}
                        </span>

                        @if(!$tag->isUsed(Auth::user(), $entity))
                            @include('tag/_apply')
                        @else
                            <?php
                            /*
                            @include('tag/_unapply')
                            */
                            ?>
                        @endif

                    </div>
                    @endforeach

                    @if($entity->tags->count() === 0)
                    還沒有使用者給標籤。
                    @endif

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="mt-4"><b>您給「{{ $entity->name }}」的標籤：</b></div>
            <div class="card mt-2">
                <div class="card-body">

                    @if($userTags->count() === 0)
                    您還沒有給標籤。
                    @endif

                    @foreach($userTags as $tag)
                    <div class="@if(!$loop->last) border-bottom pb-2 mb-2 @endif">
                        <span class='entity-tag standalone'>
                            {{ $tag->name }}
                        </span>

                        @include('tag/_unapply')

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

                    <div class="mb-1">請輸入可作為分類依據的名詞。<br>一次新增一個，不需要加上#字號。</div>

                    <form class="form-inline" method="post" action='/tag/new-tag'>
                        {{csrf_field()}}
                        <input type='hidden' name='entity_id' value='{{ $entity->id }}'>
                        <input type='hidden' name='topic_id' value='{{ $entity->topic->id }}'>
                        <input type="text" class="form-control" placeholder="輸入標籤..." name="tag_name" required>
                        <input type="submit" class="btn btn-primary ml-2" value="新增標籤">
                    </form>

                    <hr>

                    <div class="mb-2"><b>2. 使用您之前給過的標籤</b></div>

                    <div class="fix-bottom">
                    @foreach($userOtherTags->sortByDesc(function($tag){return $tag->entityTags->count();}) as $tag)
                        <a class='entity-tag clickable apply' href="#!" data-tag-id="{{ $tag->id }}">
                            <i class="fas fa-plus-circle"></i>&nbsp;
                            {{ $tag->name }}
                        </a>
                    @endforeach
                    </div>

                    @if($userOtherTags->count() === 0)
                    您還沒有給過標籤。
                    @endif

                    <hr>

                    <div class="mb-2"><b>3. 使用其他常見標籤</b></div>

                    <div class="fix-bottom">
                    @foreach($otherTags->sortByDesc(function($tag){return $tag->entityTags->count();}) as $tag)
                        <a class='entity-tag clickable apply' href="#!" data-tag-id="{{ $tag->id }}">
                            <i class="fas fa-plus-circle"></i>&nbsp;
                            {{ $tag->name }}
                        </a>
                    @endforeach
                    </div>

                    @if($otherTags->count() === 0)
                    還沒有其他標籤。
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-4"></div>

<script>
    $(document).ready(function(){
        $('.entity-tag.apply').click(function(e){
            post('/tag/apply-tag', {
                "_token": "{{ csrf_token() }}",
                entity_id: {{ $entity->id }},
                tag_id: $(this).data('tag-id')
            });
        });
    })

    function post(path, params, method) {
        method = method || "post"; // Set method to post by default if not specified.

        // The rest of this code assumes you are not using a library.
        // It can be made less wordy if you use one.
        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);

        for(var key in params) {
            if(params.hasOwnProperty(key)) {
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", key);
                hiddenField.setAttribute("value", params[key]);

                form.appendChild(hiddenField);
            }
        }

        document.body.appendChild(form);
        form.submit();
    }
</script>

@endsection
