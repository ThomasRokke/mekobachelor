@extends('layouts.proto')

@section('header-resources')





@endsection



@section('content')

    <div class="container">
        <div id="map" style="width: 100%; height: 400px;">
        </div>
    </div>

@endsection

@section('scripts')
    <script>


        // Initialize and add the map
        function initMap() {


            var from1 = {lat:59.948133, lng:11.002002};

            var too1 = {lat:59.952591, lng:11.074896};


            var from2 = {lat:59.947339, lng:10.938855};

            var too2 = {lat:59.928790, lng:10.837700};

            bounds  = new google.maps.LatLngBounds();

            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'));

            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: from1, map: map, icon: 'http://maps.google.com/mapfiles/kml/paddle/3.png'});
            loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
            bounds.extend(loc);


            var marker2 = new google.maps.Marker({position: too1, map: map, icon: 'http://maps.google.com/mapfiles/kml/paddle/2.png'});

            loc2 = new google.maps.LatLng(marker2.position.lat(), marker2.position.lng());
            bounds.extend(loc2);

            // The marker, positioned at Uluru
            var marker3 = new google.maps.Marker({position: from2, map: map, icon: 'http://maps.google.com/mapfiles/kml/paddle/4.png'});
            loc3= new google.maps.LatLng(marker.position.lat(), marker3.position.lng());
            bounds.extend(loc3);


            var marker4 = new google.maps.Marker({position: too2, map: map, icon: 'http://maps.google.com/mapfiles/kml/paddle/1.png'});

            loc4 = new google.maps.LatLng(marker2.position.lat(), marker4.position.lng());
            bounds.extend(loc4);


            map.fitBounds(bounds);
            map.panToBounds(bounds);
        }
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbs_N37A9PUe80-qtBc4EzC4_GJ_0PJKs&callback=initMap">
    </script>
@endsection
