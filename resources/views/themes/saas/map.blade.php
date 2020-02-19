
<div id="map">

</div>

<script>
    var map, markerCluster, markers;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            gestureHandling: 'greedy',
            mapTypeControl: false,
            fullscreenControl: false,
            streetViewControl: false,
            center: { lat: {{ $center['lat'] }}, lng: {{ $center['lng'] }} },
            zoom: {{ $center['zoom'] }},
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_TOP
            },
        });

        var myLocattionButton = new howtomakeaturn.MyLocationButton(map);

        markers = [];

        @foreach ($entities as $entity)
            @if ($entity->showLatitude() && $entity->showLongitude())
                var marker = new google.maps.Marker({
                  position: {lat: {{ $entity->showLatitude() }}, lng: {{ $entity->showLongitude() }}},
                  map: map,
                  label : {text: {!! json_encode($entity->name) !!}, color: 'black'},
                });

                google.maps.event.addListener(marker, 'click', function() {
                    // $('#modal-{{ $entity->id }}').modal('show')
                    window.open('/view/{{ $entity->hashids() }}','_blank');
                });

                markers.push(marker);
            @endif
        @endforeach

        markerCluster = new MarkerClusterer(map, markers, {
            imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m',
            maxZoom: {{ 12 }}
        });

        addMainlink();
    }

    function addMainlink()
    {
        var div = document.createElement('div');

        div.className = 'map-main-link';

        var link = document.createElement('a');

        @if (AppCore::getCurrentFilter())
        $(link).text('{{ AppCore::getCurrentFilter()['filter'] }} · {{ $topic->name }}');
        $(link).attr('href', '/list/{{ $topic->hashids() }}?f{{ AppCore::getCurrentFilter()['column']->id }}={{ AppCore::getCurrentFilter()['filter'] }}');
        @else
        $(link).text('{{ $topic->name }}');
        $(link).attr('href', '/list/{{ $topic->hashids() }}');
        @endif

        div.appendChild(link);

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(div);
    }
</script>

<script src="/js/markerclusterer.min.js"></script>

<script src='/js/my-location-button.js'></script>

<script defer
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap">
</script>

<style>
    #map {
        height: calc(100vh - 56px);
        width: 100vw;
        background-color: #EEEEEE;
        position: relative;
        left: calc(-50vw + 50%);
    }
</style>

<?php
/*
@foreach ($entities as $entity)
<!-- Modal -->
<div class="modal" id="modal-{{ $entity->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="mb-0"><b>{{ $entity->name }}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include(theme_path('tag-section'))
                @if ($entity->topic->reviewColumns->count())
                    @include(theme_path('review-section'))
                @endif
                @include(theme_path('info-section'))
                <hr>
                <span style="" class="mr-1">資料由 {{ $entity->getContributors()->count() }} 位貢獻者提供</span>
                @include(theme_path('user-faces'), ['users' => $entity->getContributors()])
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" href="/view/{{ $entity->hashids() }}" target="_blank">查看詳情&nbsp; <i class="fas fa-external-link-alt"></i></a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
*/
?>

<style>
    .map-main-link {
        padding: 15px;
        background-color: white;
        font-size: 15px;
        margin-top: 10px;
        margin-left: 10px;
        font-weight: bold;
        border-radius: 3px;
        border: 1px solid #dee2e6;
        -webkit-box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
</style>
