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

<div id="gallery-links" class="row no-gutters" style="margin-left: -0.25rem; margin-right: -0.25rem;">
    @foreach ($entity->photos as $photo)
        <div class="col-md-6">
            <div class="ml-1 mr-1 mt-2">
                <div class="thumbnail bg-stripes ">
                    <a href="{{ $photo->url }}">
                        <img src="{{ $photo->url }}">
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if ($entity->photos->count() === 0)
    還沒有人提供相關照片。
@endif

<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <!--
    <a class="prev" style="color:white; line-height: 40px;">‹</a>
    <a class="next" style="color:white; line-height: 40px;">›</a>
    <a class="close" style="color:white;">×</a>
    -->
    <ol class="indicator"></ol>
</div>

<script src="/vendor/gallery/js/blueimp-gallery.min.js"></script>

<script>
document.getElementById('gallery-links').onclick = function (event) {
    event = event || window.event;
    var target = event.target || event.srcElement,
        link = target.src ? target.parentNode : target,
        options = {index: link, event: event, thumbnailIndicators: false},
        links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};
</script>
