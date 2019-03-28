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


        .highcharts-credits{
            display: none!important;
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
                    <div class="ui floating dropdown  search icon labeled bg-white">
                        <i class="calendar icon"></i>
                        <span class="text">Siste {{ $time }} dager</span>
                        <div class="menu">
                            <a href="{{ route('dashboard', ['time' => 1]) }}" class="item">Siste 1 dag</a>
                            <a href="{{ route('dashboard', ['time' => 7]) }}" class="item">Siste 7 dager</a>
                            <a href="{{ route('dashboard', ['time' => 14]) }}" class="item">Siste 14 dager</a>
                            <a href="{{ route('dashboard', ['time' => 30]) }}" class="item">Siste 30 dager</a>
                            <a href="{{ route('dashboard', ['time' => 60]) }}" class="item">Siste 60 dager</a>
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
                    <div class="value">{{ $orders }}</div>
                    <div class="label">Ordre</div>
                </div>

                <div class="statistic">
                    <div class="value">{{ $stops }}</div>
                    <div class="label">Dropp</div>
                </div>

                <div class="statistic">
                    <div class="value"><i class="car icon"></i> {{ $totalKM }}</div>
                    <div class="label">Kilometer kjørt</div>
                </div>
                <div class="statistic">
                    <div class="value"><i class="clock outline icon"></i> {{ $totalHours }}t <span style="font-size: 0.6em">{{ $totalMinutes }} min</span></div>
                    <div class="label">Tid brukt på veien</div>
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
            @if(Auth::check() && Auth::user()->hasRole('admin'))
                <!-- Admin KPI's
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
            </div>-->
            @endif

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
                text: 'Antall dropp'
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
                    return '<b>Rute ' + this.series.xAxis.categories[this.point.x] + '</b><br><b>' +
                        this.point.value + '</b> dropp på <br><b>' + this.series.yAxis.categories[this.point.y] + '</b>';
                }
            },

            series: [{
                name: 'Sales per employee',
                borderWidth: 1,
                data: [
                    [{!! $mon10[0] !!},{!! $mon10[1] !!},{!! $mon10[2] !!}],
                    [{!! $mon11[0] !!},{!! $mon11[1] !!},{!! $mon11[2] !!}],
                    [{!! $mon12[0] !!},{!! $mon12[1] !!},{!! $mon12[2] !!}],
                    [{!! $mon13[0] !!},{!! $mon13[1] !!},{!! $mon13[2] !!}],
                    [{!! $mon14[0] !!},{!! $mon14[1] !!},{!! $mon14[2] !!}],

                    [{!! $tue10[0] !!},{!! $tue10[1] !!},{!! $tue10[2] !!}],
                    [{!! $tue11[0] !!},{!! $tue11[1] !!},{!! $tue11[2] !!}],
                    [{!! $tue12[0] !!},{!! $tue12[1] !!},{!! $tue12[2] !!}],
                    [{!! $tue13[0] !!},{!! $tue13[1] !!},{!! $tue13[2] !!}],
                    [{!! $tue14[0] !!},{!! $tue14[1] !!},{!! $tue14[2] !!}],

                    [{!! $wen10[0] !!},{!! $wen10[1] !!},{!! $wen10[2] !!}],
                    [{!! $wen11[0] !!},{!! $wen11[1] !!},{!! $wen11[2] !!}],
                    [{!! $wen12[0] !!},{!! $wen12[1] !!},{!! $wen12[2] !!}],
                    [{!! $wen13[0] !!},{!! $wen13[1] !!},{!! $wen13[2] !!}],
                    [{!! $wen14[0] !!},{!! $wen14[1] !!},{!! $wen14[2] !!}],

                    [{!! $thu10[0] !!},{!! $thu10[1] !!},{!! $thu10[2] !!}],
                    [{!! $thu11[0] !!},{!! $thu11[1] !!},{!! $thu11[2] !!}],
                    [{!! $thu12[0] !!},{!! $thu12[1] !!},{!! $thu12[2] !!}],
                    [{!! $thu13[0] !!},{!! $thu13[1] !!},{!! $thu13[2] !!}],
                    [{!! $thu14[0] !!},{!! $thu14[1] !!},{!! $thu14[2] !!}],

                    [{!! $fri10[0] !!},{!! $fri10[1] !!},{!! $fri10[2] !!}],
                    [{!! $fri11[0] !!},{!! $fri11[1] !!},{!! $fri11[2] !!}],
                    [{!! $fri12[0] !!},{!! $fri12[1] !!},{!! $fri12[2] !!}],
                    [{!! $fri13[0] !!},{!! $fri13[1] !!},{!! $fri13[2] !!}],
                    [{!! $fri14[0] !!},{!! $fri14[1] !!},{!! $fri14[2] !!}],],
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
                    data: [{!! $ant10 !!}, {!! $ant11 !!}, {!! $ant12 !!}, {!! $ant13 !!}, {!! $ant14 !!}],
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

            var heatmapData = [
                @foreach($routes as $route)

                @foreach($route->stops as $stop)
                new google.maps.LatLng({!! $stop->workshop->lat !!}, {!! $stop->workshop->lng !!}),


                @endforeach
                @endforeach
            ];

            var heatmap = new google.maps.visualization.HeatmapLayer({
                data: heatmapData
            });
            heatmap.set('radius', heatmap.get('radius') ? null : 30);
            heatmap.setMap(map);


            @foreach($routes as $route)

            @foreach($route->stops as $stop)



            loc{{ $stop->id }} = new google.maps.LatLng({lat:{!! $stop->workshop->lat !!}, lng:{!! $stop->workshop->lng !!}});



            bounds.extend(loc{{ $stop->id }});



            @endforeach
            @endforeach



            map.fitBounds(bounds);
            map.panToBounds(bounds);


          //  var trafficLayer = new google.maps.TrafficLayer();
            //trafficLayer.setMap(map);



        }
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?&libraries=visualization&key=AIzaSyBbs_N37A9PUe80-qtBc4EzC4_GJ_0PJKs&callback=initMap">
    </script>

            <script>
                $("#range-trigger").click(function() {
                    $("#range-content").toggle("fast");
                });
            </script>
@endsection
