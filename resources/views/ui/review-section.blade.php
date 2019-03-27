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

<hr class="mt-3 mb-4">
<section class="">
    <h5 class="">
        <div class="d-inline-block"><b>22則評分</b></div>
        <div class="h6 m-0 d-inline-block ml-1 text-primary align-top">
            @foreach ([1,2,3,4,5] as $j)
                <i class="fas fa-star"></i>
            @endforeach
        </div>
    </h5>
    <div class="row">
        <div class="col-md-6">
            @for ($i = 0 ; $i < ceil(count($fields)/2) ; $i++)
                <div class="mt-2">
                    <div class="row">
                        <div class="col">
                        {{ $fields[$i][0] }}
                        </div>
                        <div class="col text-right text-primary">
                            @foreach ([1,2,3,4,5] as $j)
                                <i class="fas fa-star"></i>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endfor
        </div>
        <div class="col-md-6">
            @for ($i = ceil(count($fields)/2) ; $i < count($fields) ; $i++)
                <div class="mt-2">
                    <div class="row">
                        <div class="col">
                        {{ $fields[$i][0] }}
                        </div>
                        <div class="col text-right text-primary">
                            @foreach ([1,2,3,4,5] as $j)
                                <i class="fas fa-star"></i>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</section>
