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

                $('.ui.rating')
                    .rating('disable')
                ;

            $('.table.row').on('click', function() {
                    $('.longer.modal')
                        .modal('show')
                    })

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

        .item.title .content{
            margin: 5px 0 5px 0;
        }

        .ui.fitted.divider{
            margin: 5px 0 5px 0;
        }
    </style>


    <style>
        .toggle-spacing{
            margin:5px;
        }

        .ui.toggle.checkbox input:checked ~ .box:before, .ui.toggle.checkbox input:checked ~ label:before {
            background-color: #47d036 !important;
        }

        .dots-max-width{
            width: 100%!important;
            text-overflow: ellipsis !important;
            overflow: hidden;
            white-space: nowrap;
        }
    </style>


@endsection

@section('content')

    <main style="margin-bottom: 60vh;">
        <div class="animated bounceInUp" id="map" style="width: 100%; height: 400px; margin-top:45px">
        </div>

        <div class="ui container" style="margin-top:25px">

            <h4 class="ui horizontal divider header">
                <i class="wrench icon"></i>
                Godkjente verksteder


            </h4>
            <table class="ui celled padded table definition ">
                <thead>
                <tr>
                    <th></th>
                    <th class="ui"><i class="icon wrench"></i>Verksted</th>
                    <th>Brukeromtaler</th>

                    <th>Godkjenninger</th>

                    <th><i class="icon info"></i></th>


                </tr></thead>
                <tbody>
                @foreach($workshops as $w)
                    <tr class="table row">
                        <td>
                            <button class="circular ui icon button positive">
                                <i class="icon add"></i> &nbsp;Be om tilbud
                            </button>
                        </td>
                        <td>
                            <h4 class="ui header">{{ $w->name }}</h4>
                        </td>
                        <td>
                            <div class="ui star rating" data-rating="{{ rand(3,5) }}" data-max-rating="5"></div>
                            <br>
                            <a href="">{{ rand(1,223) }} omtaler</a>
                        </td>
                        <td>

                            <div class="ui list">

                                @php



                                        @endphp

                                <div class="item">
                                    <i class="check green icon"></i>
                                    <div class="content">
                                        Bilverksted - alle typer kjøretøy
                                    </div>
                                </div>
                                @if(rand(1,5) === 5)
                                <div class="item">
                                    <i class="check green icon"></i>
                                    <div class="content">
                                        Kontrollorgan 04 - EU-kontroll av alle kjøretøy
                                    </div>
                                </div>
                                @endif
                                @if(rand(1,10) === 10)
                                <div class="item">
                                    <i class="check green icon"></i>
                                    <div class="content">
                                        Arbeid på fartsskriver
                                    </div>
                                </div>
                                @endif

                            </div>

                        </td>
                        <td>
                            <i class="icon caret down"></i>
                        </td>
                    </tr>
                @endforeach


                </tbody>
                <tfoot>
                <tr><th colspan="5">
                        <div class="ui right floated pagination menu">
                            <a class="icon item">
                                <i class="left chevron icon"></i>
                            </a>
                            <a class="item">1</a>
                            <a class="item">2</a>
                            <a class="item">3</a>
                            <a class="item">4</a>
                            <a class="icon item">
                                <i class="right chevron icon"></i>
                            </a>
                        </div>
                    </th>
                </tr></tfoot>
            </table>
        </div>




        <div class="ui longer test modal transition hidden">
            <div class="header">
                Berghagan bil
            </div>
            <div class="scrolling image content">
                <div class="ui medium image">
                    <img src="https://www.berghaganbil.no/wp-content/uploads/2016/04/berghagan-bil-logo-1.png">
                    <div class="ui list">
                        <div class="item">
                            <i class="marker icon"></i>
                            <div class="content">
                                Trondheimsveien 27, 0560
                            </div>
                        </div>
                        <div class="item">
                            <i class="mail icon"></i>
                            <div class="content">
                                <a href="mailto:thomas.roekke@gmail.com">thomas.roekke@gmail.com</a>
                            </div>
                        </div>
                        <div class="item">
                            <i class="linkify icon"></i>
                            <div class="content">
                                <a href="http://www.rokke.tech">berghaganbil.mo</a>
                            </div>
                        </div>

                    </div>
                    <div class="ui divider"></div>
                    <h5 class="header">Godkjenninger:</h5>
                    <div class="ui list">


                        <div class="item">
                            <i class="check green icon"></i>
                            <div class="content">
                                Bilverksted - alle typer kjøretøy
                            </div>
                        </div>
                        @if(rand(1,5) === 5)
                            <div class="item">
                                <i class="check green icon"></i>
                                <div class="content">
                                    Kontrollorgan 04 - EU-kontroll av alle kjøretøy
                                </div>
                            </div>
                        @endif
                        @if(rand(1,10) === 10)
                            <div class="item">
                                <i class="check green icon"></i>
                                <div class="content">
                                    Arbeid på fartsskriver
                                </div>
                            </div>
                        @endif

                    </div>






                </div>

                <div class="description">
                    <div class="ui header">Omtaler</div>
                    <p>Det er omtaler kun fra bekreftede kunder av Berghagan bil.</p>
                    <div class="ui feed">


                        <div class="event">
                            <div class="label">
                                <img src="https://semantic-ui.com/images/avatar/small/joe.jpg">
                            </div>
                            <div class="content">
                                <div class="summary">
                                    <a>Joe Henderson</a>
                                    <br>
                                    <div class="ui star rating" data-rating="{{ rand(3,5) }}" data-max-rating="5"></div>
                                    <div class="date">
                                        3 days ago
                                    </div>
                                </div>
                                <div class="extra text">
                                    Ours is a life of constant reruns. We're always circling back to where we'd we started, then starting all over again. Even if we don't run extra laps that day, we surely will come back for more of the same another day soon.
                                </div>
                                <div class="meta">
                                    <a class="like">
                                        <i class="like icon"></i> {{ rand(0,9) }} Likes
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="event">
                            <div class="label">
                                <img src="https://semantic-ui.com/images/avatar/small/joe.jpg">
                            </div>
                            <div class="content">
                                <div class="summary">
                                    <a>Joe Henderson</a>
                                    <br>
                                    <div class="ui star rating" data-rating="{{ rand(3,5) }}" data-max-rating="5"></div>
                                    <div class="date">
                                        3 days ago
                                    </div>
                                </div>
                                <div class="extra text">
                                    Ours is a life of constant reruns. We're always circling back to where we'd we started, then starting all over again. Even if we don't run extra laps that day, we surely will come back for more of the same another day soon.
                                </div>
                                <div class="meta">
                                    <a class="like">
                                        <i class="like icon"></i> {{ rand(0,9) }} Likes
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="event">
                            <div class="label">
                                <img src="https://semantic-ui.com/images/avatar/small/joe.jpg">
                            </div>
                            <div class="content">
                                <div class="summary">
                                    <a>Joe Henderson</a>
                                    <br>
                                    <div class="ui star rating" data-rating="{{ rand(3,5) }}" data-max-rating="5"></div>
                                    <div class="date">
                                        3 days ago
                                    </div>
                                </div>
                                <div class="extra text">
                                    Ours is a life of constant reruns. We're always circling back to where we'd we started, then starting all over again. Even if we don't run extra laps that day, we surely will come back for more of the same another day soon.
                                </div>
                                <div class="meta">
                                    <a class="like">
                                        <i class="like icon"></i> {{ rand(0,9) }} Likes
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="event">
                            <div class="label">
                                <img src="https://semantic-ui.com/images/avatar/small/joe.jpg">
                            </div>
                            <div class="content">
                                <div class="summary">
                                    <a>Joe Henderson</a>
                                    <br>
                                    <div class="ui star rating" data-rating="{{ rand(3,5) }}" data-max-rating="5"></div>
                                    <div class="date">
                                        3 days ago
                                    </div>
                                </div>
                                <div class="extra text">
                                    Ours is a life of constant reruns. We're always circling back to where we'd we started, then starting all over again. Even if we don't run extra laps that day, we surely will come back for more of the same another day soon.
                                </div>
                                <div class="meta">
                                    <a class="like">
                                        <i class="like icon"></i> {{ rand(0,9) }} Likes
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="event">
                            <div class="label">
                                <img src="https://semantic-ui.com/images/avatar/small/joe.jpg">
                            </div>
                            <div class="content">
                                <div class="summary">
                                    <a>Joe Henderson</a>
                                    <br>
                                    <div class="ui star rating" data-rating="{{ rand(3,5) }}" data-max-rating="5"></div>
                                    <div class="date">
                                        3 days ago
                                    </div>
                                </div>
                                <div class="extra text">
                                    Ours is a life of constant reruns. We're always circling back to where we'd we started, then starting all over again. Even if we don't run extra laps that day, we surely will come back for more of the same another day soon.
                                </div>
                                <div class="meta">
                                    <a class="like">
                                        <i class="like icon"></i> {{ rand(0,9) }} Likes
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="event">
                            <div class="label">
                                <img src="https://semantic-ui.com/images/avatar/small/joe.jpg">
                            </div>
                            <div class="content">
                                <div class="summary">
                                    <a>Joe Henderson</a>
                                    <br>
                                    <div class="ui star rating" data-rating="{{ rand(3,5) }}" data-max-rating="5"></div>
                                    <div class="date">
                                        3 days ago
                                    </div>
                                </div>
                                <div class="extra text">
                                    Ours is a life of constant reruns. We're always circling back to where we'd we started, then starting all over again. Even if we don't run extra laps that day, we surely will come back for more of the same another day soon.
                                </div>
                                <div class="meta">
                                    <a class="like">
                                        <i class="like icon"></i> {{ rand(0,9) }} Likes
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="event">
                            <div class="label">
                                <img src="https://semantic-ui.com/images/avatar/small/joe.jpg">
                            </div>
                            <div class="content">
                                <div class="summary">
                                    <a>Joe Henderson</a>
                                    <br>
                                    <div class="ui star rating" data-rating="{{ rand(3,5) }}" data-max-rating="5"></div>
                                    <div class="date">
                                        3 days ago
                                    </div>
                                </div>
                                <div class="extra text">
                                    Ours is a life of constant reruns. We're always circling back to where we'd we started, then starting all over again. Even if we don't run extra laps that day, we surely will come back for more of the same another day soon.
                                </div>
                                <div class="meta">
                                    <a class="like">
                                        <i class="like icon"></i> {{ rand(0,9) }} Likes
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="event">
                            <div class="label">
                                <img src="https://semantic-ui.com/images/avatar/small/joe.jpg">
                            </div>
                            <div class="content">
                                <div class="summary">
                                    <a>Joe Henderson</a>
                                    <br>
                                    <div class="ui star rating" data-rating="{{ rand(3,5) }}" data-max-rating="5"></div>
                                    <div class="date">
                                        3 days ago
                                    </div>
                                </div>
                                <div class="extra text">
                                    Ours is a life of constant reruns. We're always circling back to where we'd we started, then starting all over again. Even if we don't run extra laps that day, we surely will come back for more of the same another day soon.
                                </div>
                                <div class="meta">
                                    <a class="like">
                                        <i class="like icon"></i> {{ rand(0,9) }} Likes
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="event">
                            <div class="label">
                                <img src="https://semantic-ui.com/images/avatar/small/joe.jpg">
                            </div>
                            <div class="content">
                                <div class="summary">
                                    <a>Joe Henderson</a>
                                    <br>
                                    <div class="ui star rating" data-rating="{{ rand(3,5) }}" data-max-rating="5"></div>
                                    <div class="date">
                                        3 days ago
                                    </div>
                                </div>
                                <div class="extra text">
                                    Ours is a life of constant reruns. We're always circling back to where we'd we started, then starting all over again. Even if we don't run extra laps that day, we surely will come back for more of the same another day soon.
                                </div>
                                <div class="meta">
                                    <a class="like">
                                        <i class="like icon"></i> {{ rand(0,9) }} Likes
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="event">
                            <div class="label">
                                <img src="https://semantic-ui.com/images/avatar/small/joe.jpg">
                            </div>
                            <div class="content">
                                <div class="summary">
                                    <a>Joe Henderson</a>
                                    <br>
                                    <div class="ui star rating" data-rating="{{ rand(3,5) }}" data-max-rating="5"></div>
                                    <div class="date">
                                        3 days ago
                                    </div>
                                </div>
                                <div class="extra text">
                                    Ours is a life of constant reruns. We're always circling back to where we'd we started, then starting all over again. Even if we don't run extra laps that day, we surely will come back for more of the same another day soon.
                                </div>
                                <div class="meta">
                                    <a class="like">
                                        <i class="like icon"></i> {{ rand(0,9) }} Likes
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="actions">
                <div class="ui  approve button">
                    Lukk
                    <i class="right close icon"></i>
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


            @foreach($stops as $stop)

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
            var marker{{ $stop->id }} = new google.maps.Marker({position: from{{ $stop->id }}, map: map, label: {
                    text: ' ',
                    color: "#4b4b4b",
                    fontSize: "11px",
                    fontWeight: "bold",
                }});



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
