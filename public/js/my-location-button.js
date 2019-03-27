
var howtomakeaturn = {

}

howtomakeaturn.MyLocationButton = function(map) {

    var controlDiv = document.createElement('div');

    var controlUI = document.createElement('div');
    controlUI.style.backgroundColor = '#fff';
    controlUI.style.border = '2px solid #fff';
    controlUI.style.borderRadius = '3px';
    controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
    controlUI.style.cursor = 'pointer';
    controlUI.style.marginBottom = '0px';
    controlUI.style.marginRight = '10px';
    controlUI.style.textAlign = 'center';
    // controlUI.style.width = '29px';
    // controlUI.style.height = '29px';
    controlUI.style.width = '40px';
    controlUI.style.height = '40px';
    controlDiv.appendChild(controlUI);

    // Set CSS for the control interior.
    var controlText = document.createElement('div');
    controlText.style.backgroundImage = 'url(/img/misc/my_location.svg)';
    // controlText.style.width = '18px';
    // controlText.style.height = '18px';
    controlText.style.width = '28px';
    controlText.style.height = '28px';
    controlText.style.marginTop = '4px';
    controlText.style.marginLeft = '4px';
    controlText.style.backgroundSize = 'cover';
    controlText.style.backgroundRepeat = 'no-repeat';
    controlText.style.backgroundPosition = 'center center';

    controlUI.appendChild(controlText);

    var currentLocationMarker = null;

    controlUI.addEventListener('click', function() {
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                if (!currentLocationMarker) {
                    currentLocationMarker = new google.maps.Marker({
                        position: pos,
                        animation: google.maps.Animation.DROP,
                        map: map,
                        icon: '/img/misc/blue-dot.png'
                    });
                }

                map.setCenter(pos);
                map.setZoom(16);
            }, function() {
                // no-op
            });
        } else {
          // Browser doesn't support Geolocation
          // no-op
        }

    });

    // map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(controlDiv);
    map.controls[google.maps.ControlPosition.RIGHT_TOP].push(controlDiv);

}
