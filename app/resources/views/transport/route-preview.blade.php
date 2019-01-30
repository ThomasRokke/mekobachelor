
@extends('layouts.main')

@section('header-resources')


    <style>
        .card{
            margin: 0px 10px 10px 0px;
        }

        .card-header{
            padding: 5px 10px 5px 10px !important;
        }
    </style>
@endsection




@section('content')
    <div class="container">
        <div class="col-xs-12">

            <h3 class="text-center">Rute <strong>{{ $route->route }}</strong> klokken <strong>{{ $route->time }}</strong></h3>

            <a href="{{ route('transport.route-startkm') }}" class="btn btn-success btn-block btn-lg btn-old">START KJØRING</a>
            <hr>

            <div id="accordion" class="">

                @foreach($stops as $stop)

                    <div id="wrapper-1" class="card ">
                        <div class="card-header d-flex justify-content-between align-items-centerd-flex justify-content-between align-items-center ">

                            <a class="collapsed card-link card-collapse-link btn  " style="width:80%" data-toggle="collapse" href="#collapse{{ $stop->workshop->workshop_id }}">
                                {{ $stop->workshop->name }}
                            </a>

                            <div class="float-right "><i class="fa fa-file fa-lg align-middle " ></i>
                                {{ count($stop->orders) }}</div>

                        </div>
                        <div id="collapse{{ $stop->workshop->workshop_id }}" class="collapse" data-parent="#accordion">
                            <div class="card-body">

                                @foreach($stop->orders as $order)

                                    <div class="custom-control form-control-lg custom-checkbox">
                                        <input checked type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">{{ $order->ordernumber }}</label>
                                    </div>
                                @endforeach



                            </div>
                        </div>
                    </div>

                @endforeach



            </div>
        </div>

        <div class="animated bounceInUp" id="map" style="width: 100%; height: 400px;">
        </div>

    </div>

@endsection

@section('scripts')
    <script>



        // Initialize and add the map
        function initMap() {

            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'));


            bounds  = new google.maps.LatLngBounds();


                    @foreach($route->stops as $stop)

            var from{{ $stop->id }} = {lat:{!! $stop->workshop->lat !!}, lng:{!! $stop->workshop->lng !!}};

            var content{{ $stop->id }} = '<div id="content">'+
                '<div id="siteNotice">'+
                '</div>'+
                '<h5 id="firstHeading" class="firstHeading">{!! $stop->workshop->name !!}</h5>'+
                '<div id="bodyContent">'+
                '<h6><a target="_blank" href="https://www.google.com/maps?saddr=My+Location&daddr={!! $stop->workshop->adr !!}&destination_place_id={!! $stop->workshop->place_id !!}&travelmode=driving">' +
                '                Veibeskrivelse <i class="fa fa-car"></i></a></h6>'+
                '</div>'+
                '</div>';

            var infowindow{{ $stop->id }} = new google.maps.InfoWindow({
                content: content{{ $stop->id }}
            });

            // The marker, positioned at Uluru
            var marker{{ $stop->id }} = new google.maps.Marker({position: from{{ $stop->id }}, map: map, label:'{{ $stop->route_position }}'});



            loc{{ $stop->id }} = new google.maps.LatLng(marker{{ $stop->id }}.position.lat(), marker{{ $stop->id }}.position.lng());



            bounds.extend(loc{{ $stop->id }});


            marker{{ $stop->id }}.addListener('click', function() {
                infowindow{{ $stop->id }}.open(map, marker{{ $stop->id }});
            });
            @endforeach

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
    <script>



        //check if jquery is loaded
        window.onload = function() {
            if (window.jQuery) {
                // jQuery is loaded
                //alert("Yeah!");
            } else {
                // jQuery is not loaded
                alert("Jquery is not loaded");
            }
        }
    </script>

@endsection
