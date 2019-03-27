<hr class="mt-4 mb-4">

<h5 class="mb-3"><b>{{ $entity->photos->count() }}張照片</b></h5>

<?php
    $photos = [
        'https://fakeimg.pl/250x100/',
        'https://fakeimg.pl/100x250/',
        'https://fakeimg.pl/700x500/',
        'https://fakeimg.pl/500x700/',
    ];
?>

<div class="row no-gutters" style="margin-left: -0.25rem; margin-right: -0.25rem;">
    @foreach ($entity->photos as $photo)
        <div class="col-md-6">
            <div class="ml-1 mr-1 mt-2">
                <div class="thumbnail bg-stripes ">
                    <img src="{{ $photo->url }}">
                </div>
            </div>
        </div>
    @endforeach
</div>

@if ($entity->photos->count() === 0)
    還沒有人提供相關照片。
@endif
