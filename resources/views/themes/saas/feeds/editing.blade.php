<li class="list-group-item">
    <div class="d-flex">
        <div class="">
            <img src="{{ $record['data']->user->avatar }}" style="height: 30px; width: 30px; border-radius: 50%;">
        </div>
        <div class="pl-3" style="min-width: 0;">
            <div class="text-muted -font-weight-bold" style="font-size: 0.875rem;">
                編修了一筆資料：<a href="/view/{{ $record['data']->entity->hashids() }}">{{ $record['data']->entity->name }}</a>
            </div>
            <div class="text-truncate py-2">
                <?php
                    $diffData = [];

                    foreach ($record['data']->editingCells as $cell) {
                        $diffData[] = $cell->meta_value;
                    }
                ?>
                <ul style="list-style-type: disc;" class="pl-4">
                    @foreach ($diffData as $key => $value)
                        <li>{{ $value }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="" style="font-size: 0.875rem;">
                <span class="text-muted">
                    <?php Carbon\Carbon::setLocale('zh-TW'); ?>
                    {{ $record['data']->created_at->diffForHumans() }}
                </span>
            </div>
        </div>
    </div>
</li>
