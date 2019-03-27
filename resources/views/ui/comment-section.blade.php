<hr class="mt-4 mb-4">
<h5 class="mb-3"><b>14則留言</b></h5>
@foreach ([1,2,3] as $int)
    <div class="">
        <div class="">
            <img src="https://avatars2.githubusercontent.com/u/1255050?v=4" style="height: 45px; border-radius: 50%;">&nbsp;
            <div class="d-inline-block ml-2" style="vertical-align: top;">
                <div>尤川豪</div>
                <div class="text-muted" style="font-size: 93.333333%;">2018年十一月</div>
            </div>
        </div>
        <div class="mt-2">
            @if ($int%2)
            餐點便宜好吃！很常坐滿有時候去真的要看運氣。店家不併桌，之前遇過奧客因不給併桌來吵架的，但店家很堅持超讚。
            @else
            Clean & Nice studio , when im first step into airbnb is really wow , walking distance to Metro around 5 min.
            Definitely will go back Roger airbnb when visit paris again.
            @endif
        </div>
    </div>
    @if (!$loop->last)
    <hr>
    @endif
@endforeach
