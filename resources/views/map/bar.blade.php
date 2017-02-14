@extends('layouts.default')

@section('content')
    <h1>{{ $bar->name }}</h1>
    <div id="map-canvas" style="width:100%; height:480px; display: block;"></div>
@stop
@section('scripts')

    <script type="text/javascript">
        var geocoder;
        var map;

        function initialize() {
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(55.0026009,-1.7269812);
            var mapOptions = {
                zoom: 19,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            codeAddress();
        }

        function codeAddress() {
            var address = "{{ $bar->name }}, Newcastle upon Tyne";
            geocoder.geocode( { 'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKdYCGNfJYoY9SgWK18niNNtIVmI20APk&callback=initialize">
    </script>

@stop