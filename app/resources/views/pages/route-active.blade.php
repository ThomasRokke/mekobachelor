@extends('layouts.semantic')

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


                $('#example2').progress();

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

    @php
        $count = count($route->stops);
        $deliveredCount = 0;

        $widthPer = 100 / $count;

        $totalWidth = 0;

        foreach($route->stops as $s){
            if($s->delivered === 1){
                $totalWidth += $widthPer;
                $deliveredCount++;
            }
        }
    @endphp

    <main style="margin-bottom: 60vh;">
        <div class="ui container" style="margin-top:80px;">
            <div class="ui segment">

                <a href="{{ route('transport.route-endkm', ['id' => $route->id])  }}" class="fluid ui button negative">Stopp kjøring</a>

                <div class="ui divider"></div>

                <div class="ui green progress" data-percent="{{ $totalWidth }}" id="example2">
                    <div class="bar"></div>
                    <div class="label">{{ $deliveredCount }}/{{ $count }} levert</div>
                </div>

                <div class="ui divider"></div>

                <div class="ui middle aligned divided list accordion ">

                    @foreach($stops as $stop)

                        <div class="item title">
                            @if($stop->delivered != 1)
                            <img class="ui avatar image" src="https://www.freeiconspng.com/uploads/black-x-png-27.png">
                            @else
                            <img class="ui avatar image" src="data:image/png;base64,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">
                            @endif


                            <div class="content">
                                <a class="ui header">{{ $stop->workshop->name }} </a>
                            </div>



                        </div>


                        <div class="content">
                            @if($stop->delivered != 1)
                            <form method="post" action="{{ route('markdelivered') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{ $stop->id }}">

                            @foreach($stop->orders as $order)


                                <div class="ui toggle checkbox toggle-spacing">
                                    <input type="checkbox"  checked name="{{ $order->ordernumber }}">
                                    <label>{{ $order->ordernumber }}</label>
                                </div>

                                <div class="ui fitted divider"></div>
                            @endforeach


                                <button class="fluid ui button positive">Merk som levert  &nbsp;<i class="icon check"></i></button>



                            </form>

                            @else

                            <form method="post" action="{{ route('undodelivered') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{ $stop->id }}">

                                @foreach($stop->orders as $order)


                                    <div class="ui toggle checkbox toggle-spacing">
                                        <input type="checkbox" value="{{ $order->ordernumber }}" {{ ($order->delivered === 1 ) ? 'checked' :  '' }} name="{{ $order->ordernumber }}">
                                        <label>{{ $order->ordernumber }} </label>
                                    </div>

                                    <div class="ui fitted divider"></div>
                                @endforeach


                                <button class="fluid ui button negative">Angre levering  &nbsp;<i class="icon check"></i></button>



                            </form>

                            @endif
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
