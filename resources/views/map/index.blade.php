@extends('layouts.map')

@section('content')
    <div id="map-canvas" style="height:100%; width:100%"></div>
    <input type="hidden" name="latlong" id="latlong"/>
@stop
@section('scripts')

    <script type="text/javascript">
        var geocoder;
        var map;
        var pointA = null;
        var pointB = null;

        var coords = [];

        function initialize() {
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(55.0026009,-1.7269812);
            var mapOptions = {
                zoom: 17,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            var locations = [
                @foreach($bars as $bar)
                ['{{ $bar['name'] }}', '{{ $bar['stime'] }}', '{{ $bar['etime'] }}'],
                @endforeach
            ];
            for(i=0;i<locations.length; i++) {
                var count = i + 1;
                codeAddress(locations[i][0], locations[i][1], locations[i][2], count);
                //break;
            }
        }

        function codeAddress(bar_name, stime, etime, count) {
            var address = bar_name+", Newcastle upon Tyne";

            geocoder.geocode( { 'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                    var infowindow = new google.maps.InfoWindow();
                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            infowindow.setContent(count +". "+bar_name+" ("+stime+" - "+etime+")");
                            infowindow.open(map, marker);
                        }
                    })(marker, i));

                    /*var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();
                    pointA = latitude+","+longitude;
                    coords.push(latitude+","+longitude);
                    if(pointB != null) {
                        var directionsDisplay = new google.maps.DirectionsRenderer({map: map});
                        var directionsService = new google.maps.DirectionsService();

                        var request = {
                            origin:pointA,
                            destination:pointB,
                            travelMode: 'WALKING'
                        };
                        directionsService.route(request, function(response, status) {
                            if (status == google.maps.DirectionsStatus.OK) {
                                directionsDisplay.setDirections(response);
                            }
                        });
                    }
                    pointB = pointA;*/

                } else {
                    setTimeout(codeAddress, 1000, bar_name, stime, etime, count);
                }
            });
        }

        function calcRoute() {

            var start = document.getElementById("routeStart").value;
            var end = $("#latlong").val();

            var request = {
                origin:start,
                destination:end,
                travelMode: google.maps.DirectionsTravelMode.DRIVING
            };
            directionsService.route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                }
            });
            alert("Start.."+start+"..End.."+end);
        }


    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKdYCGNfJYoY9SgWK18niNNtIVmI20APk&callback=initialize">
    </script>

@stop