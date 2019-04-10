<?php
    $fields = [
        ['準確性', rand(1,10)/2],
        ['溝通', rand(1,10)/2],
        ['乾淨程度', rand(1,10)/2],
        ['位置', rand(1,10)/2],
        ['入住', rand(1,10)/2],
        ['性價比呢', rand(1,10)/2]
    ];
?>

<div class="card mt-3 ml-2 mr-2">
    <!--
    <img class="card-img-top" src=".../100px180/" alt="Card image cap">
    -->
    <div class="card-body">
        <h6 class="card-title text-truncate"><b><a href="/list/{{ $topic->hashids() }}">{{ $topic->name }}</a></b></h6>
        <div class="topic-description">{{ $topic->description }}</div>

        <div class="mt-2 text-muted" style="font-size: 0.875rem;">
            {{ $topic->entityCount() }} 筆資料 · {{ $topic->reviewCount() }} 則評分 · {{ $topic->commentCount() }} 個留言
        </div>

        <!--
        <a href="#" class="btn btn-primary">前往這張清單</a>
        -->
        <!--
        <div class="text-muted mt-2">
            <div class="">
                <img src="https://avatars2.githubusercontent.com/u/1255050?v=4" style="height: 20px;" class="rounded-circle">
                <div class="d-inline-block ml-1 mt-2" style="font-size: 0.875rem;">
                    <span class="text-dark font-weight-bold-">尤川豪</span>
                    <span class="text-muted"> 於 2018年十一月 更新</span>
                </div>
            </div>
        </div>
        -->
    </div>
</div>
