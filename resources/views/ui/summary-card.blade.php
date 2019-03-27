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
    <div class="card-header">
        Featured
    </div>
    -->
    <div class="card-body">
        <h5 class=""><b>Card title</b></h5>
        <h6 class="card-subtitle mt-2 mb-2">北門站 · 大同區</h6>
        <div class="text-primary">
            @foreach ([1,2,3,4,5] as $j)
                <i class="fas fa-star"></i>
            @endforeach
        </div>
        <div class="row no-gutters" style="margin-left: -0.5rem; margin-right: -0.5rem;">
            <div class="col-6">
                @for ($i = 0 ; $i < ceil(count($fields)/2) ; $i++)
                    <div class="mt-2 ml-2 mr-2">
                        <div class="">
                            {{ $fields[$i][0] }}<span class="text-primary float-right">{{ number_format($fields[$i][1], 1) }}</span>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="col-6">
                @for ($i = ceil(count($fields)/2) ; $i < count($fields) ; $i++)
                    <div class="mt-2 ml-2 mr-2">
                        <div class="">
                            {{ $fields[$i][0] }}<span class="text-primary float-right">{{ number_format($fields[$i][1], 1) }}</span>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
        <!--
        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a>
        -->
    </div>
    <!--
    <div class="card-footer text-muted">
        2 days ago
    </div>
    -->
</div>
