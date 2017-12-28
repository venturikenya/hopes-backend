function initMap() {
  var church = {lat: -1.283572, lng: 36.759583};
    var map = new google.maps.Map(document.getElementById('map'),{
        zoom: 10,
        center: church
    });
    var marker = new google.maps.Marker({
        position: church,
        map: map
    });
}
