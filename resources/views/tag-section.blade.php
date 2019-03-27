<?php
    $tags = $entity->getSortedTags();
?>

<section class="">
    @if($tags->count() !== 0)
        <div class="fix-bottom">
            @foreach ($tags as $tag)
            <span class="entity-tag">{{ $tag->name }}</span>
            @endforeach
        </div>
    @else
        還沒有人給 {{ $entity->name }} 加上標籤。
        <a href="/tag/{{ $entity->hashids() }}" class=""><i class="fas fa-tags"></i> 幫忙加幾個標籤</a>
    @endif
</section>
