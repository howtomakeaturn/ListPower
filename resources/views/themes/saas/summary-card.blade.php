<?php
    $fields = [];

    foreach ($topic->sortedReviewColumns() as $column) {
        $fields[] = [$column->meta_label, $entity->review($column->meta_key)];
    }
?>

<div class="card mt-3 ml-2 mr-2">

    <div class="card-body">
        <h6 class="mb-0 text-truncate"><b><a href="/view/{{ $entity->hashids() }}">{{ $entity->name }}</a></b></h6>

        @if ($entity->topic->hasCityColumn())
        <div class="mt-2">
            {{ $entity->showCitySummary() }}
        </div>
        @endif

        <div class="mt-2" style="height: 28px;">
            @if ($entity->getSortedTags()->count())
                <div class="text-truncate">
                    @foreach ($entity->getSortedTags() as $tag)
                        <span class="entity-tag sub">{{ $tag->name }}</span>
                    @endforeach
                </div>
            @else
                <span class="text-muted" style="font-size: 0.875rem;">尚無標籤</span>
            @endif
        </div>

        <div class="row no-gutters" style="margin-left: -0.5rem; margin-right: -0.5rem;">
            <div class="col-6">
                @for ($i = 0 ; $i < ceil(count($fields)/2) ; $i++)
                    <div class="mt-2 ml-2 mr-2">
                        <div class="">
                            {{ $fields[$i][0] }}<span class="float-right {{ star_color($fields[$i][1]) }}">{{ number_format($fields[$i][1], 1) }}</span>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="col-6">
                @for ($i = ceil(count($fields)/2) ; $i < count($fields) ; $i++)
                    <div class="mt-2 ml-2 mr-2">
                        <div class="">
                            {{ $fields[$i][0] }}<span class="float-right {{ star_color($fields[$i][1]) }}">{{ number_format($fields[$i][1], 1) }}</span>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

</div>
