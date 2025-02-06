$(document).ready(function () {
    let defaultLocation = [36.18, 37.17];
    if (!(typeof com_lat === 'undefined') && !(typeof com_lang === 'undefined')) {
        defaultLocation = [com_lat, com_lang];
    }
    let map = L.map('map').setView(defaultLocation, 10);
    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png'
    ).addTo(map);
    let marker = L.marker(defaultLocation, { draggable: true }).addTo(map);
    $('#latitude').val(defaultLocation[0]);
    $('#longitude').val(defaultLocation[1]);

    marker.on('dragend', function (event) {
        let position = marker.getLatLng();
        $('#latitude').val(position.lat);
        $('#longitude').val(position.lng);
    });

    let drawControl = new L.Control.Draw({
        draw: {
            polygon: false,
            polyline: false,
            rectangle: false,
            circle: false,
            circlemarker: false
        },
        edit: {
            featureGroup: L.featureGroup([marker])
        }
    });
    map.addControl(drawControl);
    map.on('draw:created', function (event) {
        let layer = event.layer;
        marker.setLatLng(layer.getLatLng());
        $('#latitude').val(layer.getLatLng().lat);
        $('#longitude').val(layer.getLatLng().lng);
        map.addLayer(marker);
    });
});