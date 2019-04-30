<?php
    $fetch = new \App\FetchFeeds();

    $records = $fetch->fetchAll($topic);

    $records = $records->take(1);
?>

<div class="row">
    <div class="col">
        <div class="card mt-2">
            <ul class="list-group list-group-flush">
                @foreach ($records as $record)
                    <li class="list-group-item py-2">
                        <div class="d-flex align-items-center">
                            <div>
                                <img src="{{ $record['data']->user->avatar }}" style="height: 30px; width: 30px; border-radius: 50%;">
                                <span class="ml-1">{{ $record['data']->user->name }}</span>
                                @if ($record['type'] === 'add')
                                    新增了一筆資料。
                                @endif
                                @if ($record['type'] === 'editing')
                                    編修了一筆資料。
                                @endif
                                @if ($record['type'] === 'review')
                                    新增了一則評分。
                                @endif
                                @if ($record['type'] === 'comment')
                                    新增了一個留言。
                                @endif
                                @if ($record['type'] === 'tag')
                                    新增了一個標籤。
                                @endif
                                @if ($record['type'] === 'photo')
                                    上傳了一張照片。
                                @endif
                                <span class="text-muted">
                                    －
                                    <?php Carbon\Carbon::setLocale('zh-TW'); ?>
                                    {{ $record['data']->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
