@extends('ui/layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="h6 mb-0">建立新清單</h3>
                </div>
                <div class="card-body">
                    <h4><b>基本資訊</b></h4>
                    <div class="text-muted">請給這張清單取個名稱、寫點簡介，讓大家知道是在蒐集什麼資訊。</div>
                    <div class="mt-3">
                        <b>清單名稱</b>
                        <input type="text" class="mt-2 form-control col-md-6" placeholder="" value="">
                    </div>
                    <div class="mt-3">
                        <b>清單簡介</b>
                        <input type="text" class="mt-2 form-control" placeholder="" value="">
                    </div>
                    <hr>
                    <h4><b>評分欄位</b></h4>
                    <div class="text-muted">這些欄位會給網友們共同評分，評1-5分。</div>
                    <div class="mt-3">
                        <div class="row">
                            <!--
                            <div class="col-4">
                                <b>Field Key</b>
                            </div>
                            -->
                            <div class="col-4">
                                <b>Field Label</b>
                            </div>
                        </div>
                    </div>
                    @foreach ([1,2,3] as $i)
                    <div class="mt-3">
                        <div class="row no-gutters">
                            <!--
                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="field key" value="">
                            </div>
                            -->
                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="field label" value="">
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
                    <hr>
                    <h4><b>資訊欄位</b></h4>
                    <div class="text-muted">這些欄位會給網友們一起協助編輯。</div>
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-4">
                                <b>Field Type</b>
                            </div>
                            <!--
                            <div class="col-4">
                                <b>Field Key</b>
                            </div>
                            -->
                            <div class="col-4">
                                <b>Field Label</b>
                            </div>
                        </div>
                    </div>
                    @foreach ([1,2,3] as $i)
                    <div class="mt-3">
                        <div class="row no-gutters">
                            <div class="col-4">
                                <select class="form-control">
                                    <option value="">文字</option>
                                    <option value="">網址</option>
                                    <option value="">Yes / No</option>
                                    <option value="">(skipped?) 多選一</option>
                                    <option value="">(skipped?) 多選多</option>
                                    <option value="">地址</option>
                                </select>
                            </div>
                            <!--
                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="field key" value="">
                            </div>
                            -->
                            <div class="col-4 ml-2">
                                <input type="text" class="form-control" placeholder="field label" value="">
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
                    <div class="mt-3">
                        TODO: tabelog ... 健行筆記 ... 一樣的資訊分區塊 ...
                    </div>
                    <hr>
                    <h4><b>建立完成</b></h4>
                    <div class="text-muted">按下按鈕，您就建立好清單了。別擔心，您之後隨時可以修改清單設定。</div>
                    <div class="mt-3">
                        <button class="btn btn-primary">建立清單</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-4"></div>

@endsection
