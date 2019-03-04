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



                $('.ui.dropdown')
                    .dropdown()
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
        .abc {
            color: yellow!important;
            width: 100%!important;
        }

        .text-size {
            font-size: 20px;
        }



    </style>

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
@endsection

@section('content')

    <div class="ui container" style="margin-top:10px">

        <div class="ui segment">
            <div class="ui five statistics">
                <div class="statistics">
                    <div class="ui floating dropdown labeled search icon button bg-white">
                        <i class="calendar icon"></i>
                        <span class="text">Siste 7 dager</span>
                        <div class="menu">
                            <div class="item">Siste 14 dager</div>
                            <div class="item">Siste måned</div>
                            <div class="item">Siste to måneder</div>
                            <div class="item">Siste 6 måneder</div>
                            <div class="item">Siste 1 år</div>
                        </div>
                    </div>

                    <h6 id="range-trigger" style="color:darkgrey" class="ui horizontal divider header clearing">
                        Eller <i class="icon caret down"></i>
                    </h6>
                    <div id="range-content" style="display: none" class="ui form">
                        <div class="one fields">
                            <div class="field">

                                <div class="ui calendar" id="rangestart">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" placeholder="Fra dato">
                                    </div>
                                </div>
                            </div>


                        </div>
                        <h6 style="color:darkgrey; !important;" class="ui horizontal divider header clearing">
                            <i class="icon exchange"></i>
                        </h6>
                        <div class="one fields">


                            <div class="field">

                                <div class="ui calendar" id="rangeend">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" placeholder="Til dato">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="statistic">
                    <div class="value">22</div>
                    <div class="label">Ordre</div>
                </div>

                <div class="statistic">
                    <div class="value">14</div>
                    <div class="label">Dropp</div>
                </div>

                <div class="statistic">
                    <div class="value"><i class="car icon"></i> 523</div>
                    <div class="label">Kilometer kjørt</div>
                </div>
                <div class="statistic">
                    <div class="value"><i class="clock outline icon"></i> 143</div>
                    <div class="label">Timer brukt på veien</div>
                </div>
            </div>
        </div>


        <div class="ui grid">
            <div class="eight wide column">
                <div class="ui segment">
                    <div class="content-list"> <canvas id="myChart1"></canvas>
                    </div>
                </div>
            </div>
            <div class="eight wide column">
                <div class="ui  segment">
                    <div id="container" style="height: 260px; min-width: 310px; max-width: 800px; margin: 0 auto"></div>
                </div>

            </div>
            <div class="four wide column">
                <div class="ui segment">

                    <div class="ui fluid placeholder">
                        <div class="image header">
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                        <div class="paragraph">
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="four wide column">
                <div class="ui segment">

                    <div class="ui fluid placeholder">
                        <div class="image header">
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                        <div class="paragraph">
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="four wide column">
                <div class="ui segment">

                    <div class="ui fluid placeholder">
                        <div class="image header">
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                        <div class="paragraph">
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="four wide column">
                <div class="ui segment">

                    <div class="ui fluid placeholder">
                        <div class="image header">
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                        <div class="paragraph">
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
            </div>





    </div>

        <div class="ui embed segment" id="map" style="">
    </div>







@endsection

@section('bottom-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

    <!-- Highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/heatmap.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

            <script>
                $('#rangestart').calendar({
                    type: 'date',
                    endCalendar: $('#rangeend')
                });
                $('#rangeend').calendar({
                    type: 'date',
                    startCalendar: $('#rangestart')
                });
            </script>

    <script>
        Highcharts.chart('container', {

            chart: {
                type: 'heatmap',
                marginTop: 40,
                marginBottom: 80,
                plotBorderWidth: 1
            },


            title: {
                text: 'Antall dropp og ordre per dag'
            },

            xAxis: {
                categories: ['10', '11', '12','13','14']
            },

            yAxis: {
                categories: ['Mandag', 'Tirsdag', 'Onsdag', 'Torsdag', 'Fredag'],
                title: null
            },

            colorAxis: {
                min: 0,
                minColor: '#FFFFFF',
                maxColor: Highcharts.getOptions().colors[0]
            },

            legend: {
                align: 'right',
                layout: 'vertical',
                margin: 0,
                verticalAlign: 'top',
                y: 25,
                symbolHeight: 280
            },

            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.xAxis.categories[this.point.x] + '</b> dropp <br><b>' +
                        this.point.value + '</b> ordre på <br><b>' + this.series.yAxis.categories[this.point.y] + '</b>';
                }
            },

            series: [{
                name: 'Sales per employee',
                borderWidth: 1,
                data: [[0, 0, 10], [0, 1, 19], [0, 2, 8], [0, 3, 24], [0, 4, 67], [1, 0, 92], [1, 1, 58], [1, 2, 78], [1, 3, 117], [1, 4, 48], [2, 0, 35], [2, 1, 15], [2, 2, 123], [2, 3, 64], [2, 4, 52], [3, 0, 72], [3, 1, 132], [3, 2, 114], [3, 3, 19], [3, 4, 16], [4, 0, 38], [4, 1, 5], [4, 2, 8], [4, 3, 117], [4, 4, 115]],
                dataLabels: {
                    enabled: true,
                    color: '#000000'
                }
            }]

        });
    </script>

    <!-- End highcharts -->
    {!! $chart->script() !!}

    <script>
        var ctx = document.getElementById("myChart1");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Rute 10", "Rute 11", "Rute 12", "Rute 13", "Rute 14"],
                datasets: [{
                    label: 'Antall dropp per rute',
                    data: [12, 19, 13, 15, 12],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
    <script>

        // Initialize and add the map
        function initMap() {

            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'));


            bounds  = new google.maps.LatLngBounds();


            @foreach($routes as $route)

            @foreach($route->stops as $stop)

            var from{{ $stop->id }} = {lat:{!! $stop->workshop->lat !!}, lng:{!! $stop->workshop->lng !!}};

            var content{{ $stop->id }} = '<div id="content">'+
                '<div id="siteNotice">'+
                '</div>'+
                '<h4 id="firstHeading" class="firstHeading">{!! $stop->workshop->name !!}</h4>'+
                '<div id="bodyContent">'+
                '<h5><a target="_blank" href="https://www.google.com/maps?saddr=My+Location&daddr={!! $stop->workshop->adr !!}&destination_place_id={!! $stop->workshop->place_id !!}&travelmode=driving">' +
                '                Veibeskrivelse <i class="icon car"></i></a></h5>'+
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
                $("#range-trigger").click(function() {
                    $("#range-content").toggle("fast");
                });
            </script>
@endsection
