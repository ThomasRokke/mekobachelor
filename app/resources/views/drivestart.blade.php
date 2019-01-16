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

            <div class="btn btn-danger btn-block btn-lg" onclick="confirm('Ønsker du å avslutte ruten? Du kan IKKE angre!')">STOPP KJØRING</div>
            <hr>

            <div id="accordion" class="animated bounceInLeft">

                <div id="wrapper-1" class="card text-white bg-secondary">
                    <div class="card-header ">

                        <i id="icon-1-undo" style="display: none" class="fa fa-undo fa-2x align-middle text-white" onclick="if(confirm('Sikker på at du ønsker å angre?')){undoFinished(1)}"></i>

                        <i id="icon-1-check" class="fa fa-check-square fa-2x align-middle text-white" onclick="if(confirm('Har du levert alle ordre?')){setFinished(1)}"></i>
                        <a class="collapsed card-link  btn text-white " data-toggle="collapse" href="#collapseOne">
                            Kvickstop strømmen
                        </a>

                        <div class="float-right align-middle"><i class="fa fa-file fa-lg align-middle text-white" onclick="confirm('Har du levert alle ordre?')"></i>
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


                <div id="wrapper-2" class="card text-white bg-secondary">
                    <div class="card-header ">


                        <i id="icon-2-undo" style="display: none" class="fa fa-undo fa-2x align-middle text-white" onclick="if(confirm('Har du levert alle ordre?')){undoFinished(2)}"></i>
                        <i id="icon-2-check" class="fa fa-check-square fa-2x align-middle text-white" onclick="if(confirm('Har du levert alle ordre?')){setFinished(2)}"></i>
                        <a class="collapsed card-link  btn text-white " data-toggle="collapse" href="#collapseTwo">
                            Stovnerbrua servicesenter
                        </a>

                        <div class="float-right align-middle"><i class="fa fa-file fa-lg align-middle text-white" onclick="confirm('Har du levert alle ordre?')"></i>
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

                <div id="wrapper-3" class="card text-white bg-secondary">
                    <div class="card-header ">

                        <i id="icon-3-undo" style="display: none" class="fa fa-undo fa-2x align-middle text-white" onclick="if(confirm('Sikker på at du ønsker å angre?')){undoFinished(3)}"></i>

                        <i id="icon-3-check" class="fa fa-check-square fa-2x align-middle text-white" onclick="if(confirm('Har du levert alle ordre?')){setFinished(3)}"></i>
                        <a class="collapsed card-link  btn text-white " data-toggle="collapse" href="#collapseThree">
                            Mekonomen Lillestrøm
                        </a>

                        <div class="float-right align-middle"><i class="fa fa-file fa-lg align-middle text-white" onclick="confirm('Har du levert alle ordre?')"></i>
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

                <div id="wrapper-4" class="card text-white bg-success">
                    <div class="card-header ">

                        <i id="icon-4-undo"  class="fa fa-undo fa-2x align-middle text-white" onclick="if(confirm('Sikker på at du ønsker å angre?')){undoFinished(4)}"></i>

                        <i id="icon-4-check" style="display: none" class="fa fa-check-square fa-2x align-middle text-white" onclick="if(confirm('Har du levert alle ordre?')){setFinished(4)}"></i>
                        <a class="collapsed card-link  btn text-white " data-toggle="collapse" href="#collapseFour">
                            Bergersen Bil
                        </a>

                        <div class="float-right align-middle"><i class="fa fa-file fa-lg align-middle text-white" onclick="confirm('Har du levert alle ordre?')"></i>
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
            var marker = new google.maps.Marker({position: from1, map: map, icon: 'http://maps.google.com/mapfiles/kml/paddle/grn-blank.png'});
            loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
            bounds.extend(loc);


            var marker2 = new google.maps.Marker({position: too1, map: map, icon: 'http://maps.google.com/mapfiles/kml/paddle/wht-stars.png'});

            loc2 = new google.maps.LatLng(marker2.position.lat(), marker2.position.lng());
            bounds.extend(loc2);

            // The marker, positioned at Uluru
            var marker3 = new google.maps.Marker({position: from2, map: map, icon: 'http://maps.google.com/mapfiles/kml/paddle/wht-stars.png'});
            loc3= new google.maps.LatLng(marker.position.lat(), marker3.position.lng());
            bounds.extend(loc3);


            var marker4 = new google.maps.Marker({position: too2, map: map, icon: 'http://maps.google.com/mapfiles/kml/paddle/wht-stars.png'});

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

        function setFinished(e){


            var wrapper = document.getElementById('wrapper-'+e);

            wrapper.classList.remove("bg-secondary");

            wrapper.classList.add("bg-success");

            document.getElementById('icon-'+e+'-check').style.display = "none";
            document.getElementById('icon-'+e+'-undo').style.display = "inline-block";



        }
        function undoFinished(e){


            var wrapper = document.getElementById('wrapper-'+e);

            wrapper.classList.remove("bg-success");

            wrapper.classList.add("bg-secondary");

            document.getElementById('icon-'+e+'-check').style.display = "inline-block";
            document.getElementById('icon-'+e+'-undo').style.display = "none";



        }
    </script>

@endsection
