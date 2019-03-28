@extends('layouts.proto')

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

           <h3 class="text-center">Rute <strong>15</strong> klokken <strong>10:00</strong></h3>

            <a href="{{ route('drivestart') }}" class="btn btn-success btn-block btn-lg">START KJØRING</a>
            <hr>

            <div id="accordion">

                <div class="card  ">
                    <div class="card-header ">


                        
                        <a class="collapsed card-link  btn  " data-toggle="collapse" href="#collapseOne">
                            Kvickstop strømmen
                        </a>

                        <div class="float-right align-middle"><i class="fa fa-file fa-lg align-middle " onclick="confirm('Har du levert alle ordre?')"></i>
                            3</div>

                    </div>
                    <div id="collapseOne" class="collapse" data-parent="#accordion">
                        <div class="card-body">

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8243242
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8238482
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" checked id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                   8234823
                                </label>
                            </div>



                        </div>
                    </div>
                </div>


                <div class="card  ">
                    <div class="card-header ">


                        
                        <a class="collapsed card-link  btn  " data-toggle="collapse" href="#collapseTwo">
                            Stovnerbrua servicesenter
                        </a>

                        <div class="float-right align-middle"><i class="fa fa-file fa-lg align-middle " onclick="confirm('Har du levert alle ordre?')"></i>
                            1</div>

                    </div>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">


                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" checked id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8234823
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card  ">
                    <div class="card-header ">


                  
                        <a class="collapsed card-link  btn  " data-toggle="collapse" href="#collapseThree">
                            Mekonomen Lillestrøm
                        </a>

                        <div class="float-right align-middle"><i class="fa fa-file fa-lg align-middle " onclick="confirm('Har du levert alle ordre?')"></i>
                            4</div>

                    </div>
                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body">


                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" checked id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8234823
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" checked id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8234823
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" checked id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8234823
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" checked id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8234823
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card  ">
                    <div class="card-header ">


                  
                        <a class="collapsed card-link  btn  " data-toggle="collapse" href="#collapseFour">
                            Bergersen Bil
                        </a>

                        <div class="float-right align-middle"><i class="fa fa-file fa-lg align-middle " onclick="confirm('Har du levert alle ordre?')"></i>
                            2</div>

                    </div>
                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                        <div class="card-body">


                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" checked id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8234823
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" checked id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8212313
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

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


            var from1 = {lat:59.948133, lng:11.002002};

            var too1 = {lat:59.952591, lng:11.074896};


            var from2 = {lat:59.947339, lng:10.938855};

            var too2 = {lat:59.928790, lng:10.837700};

            bounds  = new google.maps.LatLngBounds();

            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'));

            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: from1, map: map});
            loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
            bounds.extend(loc);


            var marker2 = new google.maps.Marker({position: too1, map: map});

            loc2 = new google.maps.LatLng(marker2.position.lat(), marker2.position.lng());
            bounds.extend(loc2);

            // The marker, positioned at Uluru
            var marker3 = new google.maps.Marker({position: from2, map: map});
            loc3= new google.maps.LatLng(marker.position.lat(), marker3.position.lng());
            bounds.extend(loc3);


            var marker4 = new google.maps.Marker({position: too2, map: map});

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
