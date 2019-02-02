
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

    @php
        $count = count($route->stops);

        $widthPer = 100 / $count;

        $totalWidth = 0;

        foreach($route->stops as $s){
            if($s->delivered === 1){
                $totalWidth += $widthPer;

            }
        }
    @endphp
    <div class="container">
        <div class="col-xs-12 old-marign-top">

            <input type="hidden" id="amount" value="{{ count($route->stops) }}">

            <h3 class="text-center">Rute <strong>{{ $route->route }}</strong> klokken  <strong>{{ $route->time }}</strong></h3>


            <a href="{{ route('transport.route-endkm', ['id' => $route->id])  }}" class="btn btn-danger btn-block @if(\Illuminate\Support\Facades\Auth::user()->designmode === 2)  @else btn-lg @endif  btn-old" >STOPP KJØRING</a>
            <hr>
            <div class="progress">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ $totalWidth }}%" aria-valuenow="{{ $count }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <hr>

            <div id="accordion" class="animated bounceInLeft">

                @foreach($stops as $stop)
                    @if($stop->delivered != 1)
                        <form method="post" action="{{ route('markdelivered') }}">
                            @csrf

                            <input type="hidden" name="id" value="{{ $stop->id }}">

                            <div id="wrapper-1" class="card text-white bg-secondary">
                                <div class="card-header d-flex justify-content-between align-items-centerd-flex justify-content-between align-items-center ">

                                    <i id="icon-1-undo" style="display: none" class="fa fa-undo fa-2x align-middle text-white" onclick="if(confirm('Sikker på at du ønsker å angre?')){undoFinished(1)}"></i>

                                    <button class="btn" type="submit">
                                        <i id="icon-1-check" class="fa fa-check-square fa-2x align-middle text-white" ></i>
                                    </button>
                                    <a class="collapsed card-link card-collapse-link btn text-white " data-toggle="collapse" href="#collapse{{ $stop->id }}">
                                        {{ $stop->workshop->name }}
                                    </a>

                                    <div class="float-right text-center ">{{ count($stop->orders) }}<i class="fa fa-caret-down fa-lg align-middle text-white" ></i>
                                    </div>



                                </div>
                                <div id="collapse{{ $stop->id }}" class="collapse" data-parent="#accordion">
                                    <div class="card-body">

                                        @foreach($stop->orders as $order)
                                            <div class="custom-control form-control-lg custom-checkbox">
                                                <input name="{{ $order->ordernumber }}" checked type="checkbox" class="custom-control-input" id="{{ $order->ordernumber }}">
                                                <label class="custom-control-label" for="{{ $order->ordernumber }}">{{ $order->ordernumber }}</label>
                                            </div>
                                        @endforeach




                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <form method="post" action="{{ route('undodelivered') }}">
                            @csrf

                            <input type="hidden" name="id" value="{{ $stop->id }}">
                            <div id="wrapper-1" class="card text-white bg-success">
                                <div class="card-header d-flex justify-content-between align-items-centerd-flex justify-content-between align-items-center ">


                                    <button onclick="//confirm('Sikker på at du ønsker å angre?')" class="btn" type="submit">
                                        <i id="icon-1-undo" class="fa fa-undo fa-2x align-middle text-white"  ></i>
                                    </button>
                                    <a class="collapsed card-link card-collapse-link btn text-white " data-toggle="collapse" href="#collapse{{ $stop->id }}">
                                        {{ $stop->workshop->name }}
                                    </a>

                                    <div class="float-right text-center ">{{ count($stop->orders) }}<i class="fa fa-caret-down fa-lg align-middle text-white" ></i></div>



                                </div>
                                <div id="collapse{{ $stop->id }}" class="collapse" data-parent="#accordion">
                                    <div class="card-body">

                                        @foreach($stop->orders as $order)
                                            <div class="custom-control form-control-lg custom-checkbox">
                                                <input {{ ($order->delivered === 1 ) ? 'checked' :  '' }} type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">{{ $order->ordernumber }} </label>
                                            </div>
                                        @endforeach




                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
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

                    @php
                        //Just one stop left on the route that has not been delivered
                        $laststop = false;

                        $stopsleft =  count($route->stops->where("delivered", 0));

                        $value = ""; //Value for checking if condition is true easily.
                        //If there is just one stop
                        if($stopsleft === 1){
                           $value = "";
                           $laststop = false; //Going to be set to true if you want to init the logic for animation or similar things when one stop is left
                        }
                    @endphp

                    @foreach($route->stops as $stop)

            var from{{ $stop->id }} = {lat:{!! $stop->workshop->lat !!}, lng:{!! $stop->workshop->lng !!}};

            var content{{ $stop->id }} = '<div id="content">'+
                '<div id="siteNotice">'+
                '</div>'+
                '<h5 id="firstHeading" class="firstHeading">{!! $stop->workshop->name . $value !!}</h5>'+
                '<div id="bodyContent">'+
                '<h6><a target="_blank" href="https://www.google.com/maps?saddr=My+Location&daddr={!! $stop->workshop->adr !!}&destination_place_id={!! $stop->workshop->place_id !!}&travelmode=driving">' +
                '                Veibeskrivelse <i class="fa fa-car"></i></a></h6>'+
                '</div>'+
                '</div>';

            var infowindow{{ $stop->id }} = new google.maps.InfoWindow({
                content: content{{ $stop->id }}
            });

                    @if($stop->delivered === 1)
            var icon{{ $stop->id }} = {
                    url: "http://maps.google.com/mapfiles/kml/paddle/grn-blank.png", // url
                    scaledSize: new google.maps.Size(50, 50), // scaled size
                    origin: new google.maps.Point(0,0), // origin
                    anchor: new google.maps.Point(0, 0) // anchor
                };
                    @endif

            var marker{{ $stop->id }} = new google.maps.Marker({position: from{{ $stop->id }},@if($stop->delivered === 1)icon: icon{{ $stop->id  }},@endif map: map, label:'{{ $stop->route_position }}'});

            //http://maps.google.com/mapfiles/kml/paddle/grn-blank.png

            loc{{ $stop->id }} = new google.maps.LatLng(marker{{ $stop->id }}.position.lat(), marker{{ $stop->id }}.position.lng());



            bounds.extend(loc{{ $stop->id }});


            marker{{ $stop->id }}.addListener('click', function() {
                infowindow{{ $stop->id }}.open(map, marker{{ $stop->id }});
            });
            @endforeach

            map.fitBounds(bounds);
            map.panToBounds(bounds);

            var trafficLayer = new google.maps.TrafficLayer();
            trafficLayer.setMap(map);





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

        var width = $('.progress-bar').attr('aria-valuenow');

        var count = $("#amount").val();

        var incrementWith = 100 / count;

        function setFinished(e){


            var wrapper = document.getElementById('wrapper-'+e);

            wrapper.classList.remove("bg-secondary");

            wrapper.classList.add("bg-success");

            document.getElementById('icon-'+e+'-check').style.display = "none";
            document.getElementById('icon-'+e+'-undo').style.display = "inline-block";


            width = width + incrementWith;

            $('.progress-bar').css('width', width+'%').attr('aria-valuenow', width);



        }
        function undoFinished(e){


            var wrapper = document.getElementById('wrapper-'+e);

            wrapper.classList.remove("bg-success");

            wrapper.classList.add("bg-secondary");

            document.getElementById('icon-'+e+'-check').style.display = "inline-block";
            document.getElementById('icon-'+e+'-undo').style.display = "none";

            width = width - incrementWith;

            $('.progress-bar').css('width', width+'%').attr('aria-valuenow', width);



        }
    </script>

@endsection
