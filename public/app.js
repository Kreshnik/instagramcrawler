var map, mapView = $('#mapView');
$(document).on('click', '.btnViewMap' ,function(){
    var $self = $(this);
    var latitude = $self.data('latitude');
    var longitude = $self.data('longitude');
    var locationName = $self.data('locationName');
    setMarker(latitude,longitude,locationName);
});

function setMarker(latitude,longitude,locationName)
{
    map = new GMaps({
        div: '#map',
        lat: latitude,
        lng: longitude
    });
    map.addMarker({
        lat: latitude,
        lng: longitude,
        title: locationName
    });

    map.fitZoom();
    mapView.find('.modal-title').text(locationName);
}

mapView.on('shown.bs.modal', function (e) {
    map.refresh();
});