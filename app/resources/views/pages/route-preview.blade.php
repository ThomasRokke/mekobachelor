@extends('layouts.transport')

@section('header')
    <script type="text/javascript">
        $(document)
            .ready(function() {

                //Make the message box that appear on successfull insert be closable
                $('.message .close')
                    .on('click', function() {
                        $(this)
                            .closest('.message')
                            .transition('fade')
                        ;
                    })
                ;

                //Sidebar with overlay transition. Button is attached even to show the navbar.
                $('.left.demo.sidebar').first()
                    .sidebar('attach events', '.open.button', 'show')
                    .sidebar('setting', 'transition', 'overlay');
                $('.open.button')
                    .removeClass('disabled');



                $('.ui.accordion')
                    .accordion()
                ;


            });

        //Is called to open the modal when an order is pressed.
        function editOrder(id) {
            $("#modal-header").text(id); //Set the header to id. You can make ur own data passed from onclick by adding more data paramters to the function.
            $('.ui.modal.order')
                .modal({
                    blurring: true //What kind of background around the modal
                })
                .modal('show'); //Show the modal
        }


    </script>

    <style>

        .meko-color-text {
            color: #fff100 !important;
        }

        .ui.corner.label{
            border-color: transparent!important;
        }

        .sidebar .item {
            color: gray !important;
        }

        .ui.cards > .card {

            margin: 0 !important;
            padding:0 !important;
            font-size: 0.9em !important;
        }

        .title{
            font-size: inherit !important;
        }

        .ui.selection.dropdown {
            border: 1px solid rgba(34, 36, 38, 0.5);
        }

        /*
            Sure we need that kind of selector? It does affect a lot of the elements on the site.
            Can you make a more narrow selection?
            - TR
        */
        .ui.form input:not([type]), .ui.form input[type="date"], .ui.form input[type="datetime-local"], .ui.form input[type="email"], .ui.form input[type="number"], .ui.form input[type="password"], .ui.form input[type="search"], .ui.form input[type="tel"], .ui.form input[type="time"], .ui.form input[type="text"], .ui.form input[type="file"], .ui.form input[type="url"] {
            border: 1px solid rgba(34, 36, 38, 0.5);
        }

        .ui.basic.button {
            border: 1px solid rgba(34, 36, 38, 0.5);
        }

        /*
            Fixes styling etc.
        */
        .ui.horizontal.list > .item {

            margin-left: 0 !important;
        }

        /*
            Got data indicates that the tab got any content within it.
        */

        .gotData{
            background-color: red !important;
        }


        .overflow-dots{
            text-overflow: ellipsis;
            width: 100%;

        }
    </style>


    <style>
        .toggle-spacing{
            margin:5px;
        }

        .ui.toggle.checkbox input:checked ~ .box:before, .ui.toggle.checkbox input:checked ~ label:before {
            background-color: #47d036 !important;
        }
    </style>
@endsection

@section('content')

    <main style="margin-bottom: 60vh;">
        <div class="ui container" style="margin-top:80px;">
            <div class="ui segment">

                <a href="{{ route('transport.route-startkm') }}" class="fluid ui button positive">Start kjøring</a>

                <div class="ui divider"></div>

                <div class="ui middle aligned divided list accordion ">


                    @php

                    $gotCash = false;
                    $totalCash = 0;
                    $amountOfCashOrders = 0;
                    foreach($stops as $s){
                        foreach($s->orders as $o){
                            if($o->amount !== null){
                                $totalCash = $totalCash + $o->amount;
                                $amountOfCashOrders++;
                                $gotCash = true;
                            }
                        }
                    }

                    @endphp

                    @if($gotCash)
                    <div class="item title">
                        <div class="content">
                            <a style="color:#2f2f2f !important; border: 1px solid orange; border-radius: 5px; padding:10px; font-size: 1.1em" class="ui header">  <i style="color:green!important;" class="green money bill alternate outline icon"></i>OBS! Kontant! Ta med terminal </a>
                        </div>
                    </div>

                    <div class="content">



                            <div class="ui toggle checkbox toggle-spacing">

                                <p class="">Totalt: <strong style="color:black!important;">{{ $totalCash }}kr </strong> fordelt på <strong style="color:black!important;">{{ $amountOfCashOrders }} ordre.</strong></p>
                            </div>

                            <div class="ui fitted divider"></div>

                    </div>

                    @endif

                    @foreach($stops as $stop)

                        <div class="item title">
                           <div class="content">
                              <a style="color:black !important; font-size: 0.9em" class="ui header">  <i style="color:gray!important;" class="icon wrench"></i>{{ $stop->workshop->name }} </a>
                            </div>
                        </div>

                        <div class="content">

                            @foreach($stop->orders as $order)

                                <div class="ui toggle checkbox toggle-spacing">
                                    <input type="checkbox" value="{{ $order->ordernumber }}" checked name="public">
                                    <label>{{ $order->ordernumber }}</label>
                                </div>

                                <div class="ui fitted divider"></div>
                            @endforeach
                        </div>

                    @endforeach

                </div>
            </div>

            <div class="ui segment">
                <div class="animated bounceInUp" id="map" style="width: 100%; height: 400px;">
                </div>

            </div>
        </div>




    </main>

@endsection

@section('bottom-scripts')
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
    </script>

@endsection
