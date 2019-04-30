@if (AppCore::getCurrentFilter())
<a href="/list/{{ $topic->hashids() }}?f{{ AppCore::getCurrentFilter()['column']->id }}={{ AppCore::getCurrentFilter()['filter'] }}&map=1" class="btn btn-default">
@else
<a href="/list/{{ $topic->hashids() }}?map=1" class="btn btn-default">
@endif
    <i class="far fa-map"></i>&nbsp;
    地圖模式
</a>
