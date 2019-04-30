<div class="card-body">
    <h4><b>基本資訊</b></h4>
    <div class="text-muted">請給這張清單取個名稱、寫點簡介，讓大家知道是在蒐集什麼資訊。</div>
    <div class="mt-3">
        <b>清單名稱</b>
        @if (isset($topic))
        <input type="text" class="mt-2 form-control col-md-6" placeholder="" value="{{ $topic->name }}" name="title" required>
        @else
        <input type="text" class="mt-2 form-control col-md-6" placeholder="" name="title" required>
        @endif
    </div>
    <div class="mt-3">
        <b>清單簡介</b>
        @if (isset($topic))
        <input type="text" class="mt-2 form-control" placeholder="" value="{{ $topic->description }}" name="description" required>
        @else
        <input type="text" class="mt-2 form-control" placeholder="" value="" name="description" required>
        @endif
    </div>
    <hr>
    <h4><b>評分欄位</b></h4>
    <div class="text-muted">這些欄位會給網友們共同評分，評1-5分。</div>
    <div class="text-muted">若您覺得這張清單內的資料不適合開放共同評分，請將評分欄位全部刪除。</div>

    <div id="review-columns-setting-app"><div class="mt-3">載入中...</div></div>

    @if (isset($topic))
    <input type="hidden" id="review-columns-setting-state" name="review-columns-setting-state" value="{{ $topic->generateReviewColumnsJson() }}">
    @else
    <input type="hidden" id="review-columns-setting-state" name="review-columns-setting-state">
    @endif

    <hr>
    <h4><b>資訊欄位</b></h4>
    <div class="text-muted">資訊欄位會給網友們一起協助編輯。</div>
    <div class="text-muted">相關的資訊欄位可以放在同一個區塊底下，比較清楚。</div>
    <div class="text-muted">區塊名稱只是一個分類，不會給網友編輯，資訊欄位才是開放編輯的。</div>

    <div id="info-columns-setting-app"><div class="mt-3">載入中...</div></div>

    @if (isset($topic))
    <input type="hidden" id="info-columns-setting-state" name="info-columns-setting-state" value="{{ $topic->generateInfoSectionsJson() }}">
    @else
    <input type="hidden" id="info-columns-setting-state" name="info-columns-setting-state">
    @endif

    <?php
    /*
    @foreach ([1,2] as $i)
    <hr class="mb-0">

    <div class="">
        <div class="row">
            <div class="col-md-5">
                <div class="mt-3"><b>區塊名稱</b></div>
                <div class="row no-gutters mt-3">
                    <div class="col-9">
                        <input type="text" class="form-control" placeholder="請輸入區塊名稱" value="基本資訊{{ $i === 1 ? '' : $i }}">
                    </div>
                    <div class="col-2 ml-2">
                        <button class="btn btn-default"><i class="fas fa-times"></i></button>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="mt-3"><b>欄位名稱</b></div>
                @foreach ([1,2,3] as $j)
                <div class="mt-3">
                    <div class="row no-gutters">
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="請輸入欄位名稱" value="資訊欄位{{ $j }}">
                        </div>
                        <div class="col-2 ml-2">
                            <button class="btn btn-default"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="mt-3">
                    <button class="btn btn-default"><i class="fas fa-plus-circle"></i>&nbsp; 增加一欄</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <hr>

    <div class="mt-3">
        <button class="btn btn-default"><i class="fas fa-plus-circle"></i>&nbsp; 增加區塊</button>
    </div>
    */
    ?>

    <hr>
    @if (isset($topic))
    <div class="mt-3">
        <button class="btn btn-primary" type="submit">更新清單設定</button>
    </div>
    @else
    <h4><b>建立完成</b></h4>
    <div class="text-muted">按下按鈕，您就建立好清單了。別擔心，您之後隨時可以修改清單設定。</div>
    <div class="mt-3">
        <button class="btn btn-primary" type="submit">建立清單</button>
    </div>
    @endif
</div>
