@extends('ui/layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">

            @include('ui/repo-top')

            <ul class="nav nav-tabs mt-3">
                <li class="nav-item">
                    <a class="nav-link" href="/repo">資料</a>
                </li>
                @foreach (['編修紀錄', '貢獻者名單', /*'留言板',*/ '設定'] as $tab)
                <li class="nav-item">
                    <a class="nav-link @if ($tab==='編修紀錄') active @endif" href="#">{{ $tab }}</a>
                </li>
                @endforeach
            </ul>

            <?php
                $commits = [
                    '新增了一筆資料。',
                    '提出了一個修改建議。',
                    /*
                    '提出了「B612 restaurant & bar」的修改建議：' . json_encode([
                        'info-field-1' => '台北市大同區南京西路241號',
                        'info-field-3' => '16:00 - 0:00，週五週六開到1點，週二未營業',
                        'info-field-5' => 'https://www.facebook.com/mikkellertaipei/'
                    ], JSON_UNESCAPED_UNICODE),
                    */
                    '打了一則評分。',
                    '留下了一則留言。',
                ];
            ?>

            <div class="row">
                <div class="col-lg-8">

                    <div class="card mt-3" style="">
                        <ul class="list-group list-group-flush">
                            @foreach ([1,2] as $int)
                            @foreach ($commits as $commit)
                                <li class="list-group-item">
                                    <div>
                                        <div>
                                            {{ $commit }}
                                            <i class="fas fa-check-circle text-success"></i>
                                        </div>
                                        <div class="">
                                            <img src="https://avatars2.githubusercontent.com/u/1255050?v=4" style="height: 20px;" class="rounded-circle">
                                            <div class="d-inline-block ml-1 mt-2" style="font-size: 0.875rem;">
                                                <span class="text-dark font-weight-bold-">尤川豪</span>
                                                <span class="text-muted"> · 2018年十一月</span>
                                            </div>
                                        </div>
                                        <!--
                                        <div class="d-flex justify-content-between align-items-baseline">
                                            <div class="">B612 restaurant & bar</div>
                                            <div class="">
                                                <img src="https://avatars2.githubusercontent.com/u/1255050?v=4" style="height: 20px;">
                                                <div class="d-inline-block ml-1 mt-2" style="font-size: 0.875rem;">
                                                    <span class="text-dark font-weight-bold-">尤川豪</span>
                                                    <span class="text-muted"> · 2018年十一月</span>
                                                </div>
                                            </div>
                                        </div>
                                        -->
                                    </div>
                                </li>
                            @endforeach
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

<div class="mt-4"></div>

@endsection
