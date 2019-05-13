@extends('layouts.semantic')

@section('header')



    <script type="text/javascript">

        $(document)
            .ready(function() {

                //Init tab js
                $('.menu .item')
                    .tab();

                //Init accordion.
                $('.ui.accordion')
                    .accordion({
                        animateChildren: false //Set to false because
                    });

                //Make the message box that appear on successfull insert be closable
                $('.message .close')
                    .on('click', function() {
                        $(this)
                            .closest('.message')
                            .transition('fade')
                        ;
                    })
                ;

                $('.prog').progress();

                //Sidebar with overlay transition. Button is attached even to show the navbar.
                $('.left.demo.sidebar').first()
                    .sidebar('attach events', '.open.button', 'show')
                    .sidebar('setting', 'transition', 'overlay');
                $('.open.button')
                    .removeClass('disabled');


                //Init hover
                $('.activating.element')
                    .popup()
                ;

                //Init the dropdowns used.
                $('.ui.dropdown')
                    .dropdown({
                        clearable: true
                    });

                //Validate forms
                $('.ui.form.order')
                    .form({
                        fields: {
                            integer: {
                                identifier: 'kundenummer',
                                rules: [{
                                    type: 'integer[100000..1000000]',
                                    prompt: 'Kundenummeret må være mellom x og y'
                                }]
                            },
                            //Rest of the types grabbed from the documentation.
                            decimal: {
                                identifier: 'decimal',
                                rules: [{
                                    type: 'decimal',
                                    prompt: 'Please enter a valid decimal'
                                }]
                            },
                            number: {
                                identifier: 'number',
                                rules: [{
                                    type: 'number',
                                    prompt: 'Please enter a valid number'
                                }]
                            },
                            email: {
                                identifier: 'email',
                                rules: [{
                                    type: 'email',
                                    prompt: 'Please enter a valid e-mail'
                                }]
                            },
                            url: {
                                identifier: 'url',
                                rules: [{
                                    type: 'url',
                                    prompt: 'Please enter a url'
                                }]
                            },
                            regex: {
                                identifier: 'ordrenummer',
                                rules: [{
                                    type: 'regExp[/^[a-z0-9_-]{6,8}$/]',
                                    prompt: 'Ordrenummeret må bestå av mellom 6 til 8 siffer'
                                }]
                            }
                        }

                    });

                if ($('.ui.form.order').form('is valid', 'ordrenummer')) {
                    // email is valid
                }
                if ($('.ui.form.order').form('is valid')) {

                }




            });




    </script>

    <style>

        .progress .bar{
            height: 1em !important;
            min-width: 0em !important;
        }

        .progress .label{
            font-size: 0.8em !important;
        }

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
            white-space: nowrap;
            text-overflow: ellipsis;
            display: block;
            overflow: hidden;
            max-width: 200px;

        }

        .overflow-scroll{
            max-height: 50vh!important;
            overflow:hidden;
            overflow-y:scroll;
        }

        ::-webkit-scrollbar {
            width: 0px !important;  /* remove scrollbar space */
            background: transparent !important;  /* optional: just make scrollbar invisible */
        }
        /* optional: show position indicator in red */
        ::-webkit-scrollbar-thumb {
            background: #FF0000 !important;
        }
    </style>

    <style>

        /*
            Hide rails at a certain width.
        */
        @media screen and (max-width: 1424px) {
            .rail {
                display: none !important;
            }
        }
    </style>



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/no.js"></script>


    <style>

        .gm-style-iw.gm-style-iw-c{
            background-color: #ffe629;
        }

        .gm-ui-hover-effect{
            width: 100px;
            height: 100px;
        }

        #iw-container .iw-title {
            font-family: 'Open Sans Condensed', sans-serif;
            font-size: 18px;
            font-weight: 400;
            padding: 10px;

            color: #272727;
            margin: 0;

        }

        .gm-style-iw-d{
            overflow: hidden !important;
        }
        #iw-container{
            font-size: 13px;
            line-height: 18px;
            font-weight: 400;
            margin-right: 1px;
            min-height: 80px;
            max-height: 180px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .iw-subTitle {
            font-size: 14px;
            font-weight: 700;
            padding-left:15px;
            padding-right:15px;

        }

        .gm-style-iw-t::after{
            background: #ffe629 !important;
        }

    </style>


@endsection

@section('content')

    <div class="ui segment" style="margin-left:-70px;">
        <div class="animated bounceInUp" id="map" style="width: 100%; height: 700px;">
        </div>

    </div>



    <div class="ui text container" style="margin-top:10px;">

        <div class="ui bottom attached tab active ">
            <div class="ui attached cards" style="margin:0 !important">
                @foreach($route->stops as $stop)
                    <div class="card active" style="width:100%">
                        <div class="content">
                            <div class="header">
                               @if($stop->delivered == 1 ) <a class="ui green ribbon label"><i class="icon clock"></i> {{ $stop->deliver_time }}</a>@endif{{ $stop->workshop->name }} <span style="color:grey; font-size:0.8em">{{ $stop->workshop->workshop_id }}</span>
                            </div>
                            <!-- Set to active to display -->
                            <div class="ui list horizontal attached">
                                @foreach($stop->orders as $order)
                                    <a class="item" style="border: 1px solid lightgray; border-radius: 5px; margin:5px">
                                        <div class="content" style="padding:5px 10px 5px 10px">

                                            @if($order->ordernumber <= 6000 && $order->ordernumber >= 2000)
                                                <div class="header activating element" data-title="Henteordre!" data-content="Husk å ta med henteordren.  {{ (!empty($order->pickupcomment)) ? 'Beskjed: '.$order->pickupcomment : '' }}">  @if(!empty($order->pickupcomment)) <i class="comment alternate outline icon"></i> @endif    <i class="icon  {{ ($order->delivered === 1) ? 'green box icon ' : 'orange box icon' }}"></i>   {{ $order->ordernumber }} &nbsp;</div>

                                            @else
                                                @if($order->amount === null)
                                                    @if(!empty($order->pickupcomment))
                                                        <div class="header activating element" data-title="Beskjed: {{ ($order->kkode === 1) ? 'OG K-KODE!' : '' }}" data-content="{{ $order->pickupcomment }}"> <i class="comment alternate outline icon"></i> <i class="icon  {{ ($order->delivered === 1) ? 'green check square outline' : 'orange cogs circle' }}"></i>  {{ $order->ordernumber }}  @if($order->kkode === 1)<span style="color:red">K</span>@endif &nbsp;</div>

                                                    @else
                                                        <div  class="header"> <i class="icon  {{ ($order->delivered === 1) ? 'green check square outline' : 'orange cogs circle' }}"></i>{{ $order->ordernumber }} &nbsp; @if($order->kkode === 1)<span style="color:red" class=" activating element" data-title="K-KODE" data-content="Dette er en bestilling. {{ (!empty($order->pickupcomment)) ? 'Beskjed: '.$order->pickupcomment : '' }}">K</span>@endif</div>


                                                    @endif
                                                @else
                                                    <div class="header activating element" data-title="OBS! KONTANT {{ ($order->kkode === 1) ? 'OG K-KODE!' : '' }}" data-content="{{ $order->amount }} kr. {{ (!empty($order->pickupcomment)) ? 'Beskjed: '.$order->pickupcomment : '' }}"> <i class="icon  {{ ($order->delivered === 1) ? 'green money bill alternate outline icon ' : 'orange money bill alternate outline icon' }}"></i>  {{ $order->ordernumber }} @if($order->kkode === 1)<span style="color:red">K</span>@endif &nbsp;</div>

                                                @endif
                                            @endif
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @php

                $gotCash = false;
                $totalCash = 0;
                $amountOfCashOrders = 0;

                foreach($route->stops as $stop){
                foreach($stop->orders as $o){


                        if($o['amount'] !== null){
                       $totalCash = $totalCash + $o->amount;
                            $amountOfCashOrders++;
                            $gotCash = true;
                        }

                }
                }




            @endphp

            @if($gotCash)
                <div class="ui bottom attached four item menu">
                    @php
                        $routeName = 'routes';
                        if($route->active === 1){
                        $routeName = 'setinactive';
                        }
                        else{
                        $routeName = 'setactive';
                        }
                    @endphp
                    <a class="item">
                        @if($route->finished === 1)
                            <div class="ui animated fade button basic green" tabindex="0">
                                <div class="visible content"><i class="ui icon check"></i> Fullført</div>
                                <div class="hidden content">
                                    Oh yeah
                                </div>
                            </div>
                        @elseif($route->active === 1)
                            <div class="ui animated fade button basic orange" tabindex="0">
                                <div class="visible content"><i class="spinner loading icon"></i> Aktiv</div>
                                <div class="hidden content">
                                    Gjør inaktiv
                                </div>
                            </div>
                        @else
                            <div class="ui animated fade button basic" tabindex="0">
                                <div class="visible content"> Inaktiv</div>
                                <div class="hidden content">
                                    Gjør aktiv
                                </div>
                            </div>
                        @endif
                    </a>
                    <div class="item">
                        <div class="ui dropdown">
                            <i class="user icon"></i>
                            <div class="text">{{ (!empty($route->driver)) ? $route->driver->name : 'Velg sjåfør' }}</div>
                            <i class="dropdown icon"></i>
                            <div class="menu">

                            </div>
                        </div>
                    </div>
                    <a class="item"><i class="green money bill alternate outline icon" ></i>
                        {{ $totalCash }}kr ({{ $amountOfCashOrders }} ordre)

                    </a>

                    <a class="item"><i class="clock outline layout icon" ></i> {{ ($route->started === 1) ? $route->started_time  : '?' }} - {{ ($route->finished === 1) ? $route->finished_time  : '?' }} </a>
                </div>
            @else

                <div class="ui bottom attached three item menu">
                    @php
                        $routeName = 'routes';
                        if($route->active === 1){
                        $routeName = 'setinactive';
                        }
                        else{
                        $routeName = 'setactive';
                        }
                    @endphp
                    <a href="{{ route($routeName, ['route_id' => $route->id]) }}" class="item">
                        @if($route->finished === 1)
                            <div class="ui animated fade button basic green" tabindex="0">
                                <div class="visible content"><i class="ui icon check"></i> Fullført</div>
                                <div class="hidden content">
                                    Oh yeah
                                </div>
                            </div>
                        @elseif($route->active === 1)
                            <div class="ui animated fade button basic orange" tabindex="0">
                                <div class="visible content"><i class="spinner loading icon"></i> Aktiv</div>
                                <div class="hidden content">
                                    Gjør inaktiv
                                </div>
                            </div>
                        @else
                            <div class="ui animated fade button basic" tabindex="0">
                                <div class="visible content"> Inaktiv</div>
                                <div class="hidden content">
                                    Gjør aktiv
                                </div>
                            </div>
                        @endif
                    </a>
                    <div class="item">
                        <i class="user icon"></i>
                        <div class="text">{{ (!empty($route->driver)) ? $route->driver->name : 'Velg sjåfør' }}</div>
                    </div>
                    <a class="item"><i class="clock outline layout icon" ></i> {{ ($route->started === 1) ? $route->started_time  : '?' }} - {{ ($route->finished === 1) ? $route->finished_time  : '?' }} </a>
                </div>
            @endif
        </div>


    </div>
@endsection

@section('bottom-scripts')
    <script>



        // Initialize and add the map
        function initMap() {

            // The map, centered at Uluru
            //var map = new google.maps.Map(
            // document.getElementById('map'));

            var map = new google.maps.Map(document.getElementById('map'), {

            });


            bounds  = new google.maps.LatLngBounds();


            @foreach($route->stops as $stop)

            var from{{ $stop->id }} = {lat:{!! $stop->workshop->lat !!}, lng:{!! $stop->workshop->lng !!}};



            @if($stop->optimized === 1)
            var content{{ $stop->id }} = '<div id="iw-container">' +
                                            '<div class="iw-title"><i class="icon wrench"></i>{{ $stop->workshop->name }}</div>' +

                                            '<a target="_blank" href="https://www.google.com/maps?saddr=My+Location&daddr={!! $stop->workshop->adr !!}&destination_place_id={!! $stop->workshop->place_id !!}&travelmode=driving" class="iw-subTitle"><i class="icon map marker alternate"></i> {{ $stop->workshop->adr }}</a>' +
                                        '</div>';

            var infowindow{{ $stop->id }} = new google.maps.InfoWindow({
                content: content{{ $stop->id }}
            });

            @if($stop->delivered === 1)
            // The marker, positioned at Uluru
            var marker{{ $stop->id }} = new google.maps.Marker({position: from{{ $stop->id }}, map: map, icon: {
                    url: 'http://maps.google.com/mapfiles/kml/paddle/ylw-blank.png',

                    scaledSize: new google.maps.Size(48, 48), // scaled size
                    labelOrigin: new google.maps.Point(24, 17)

                }, label: '{{ $stop->route_position }}'  , animation: google.maps.Animation.DROP,});

            @else

            // The marker, positioned at Uluru
            var marker{{ $stop->id }} = new google.maps.Marker({position: from{{ $stop->id }}, map: map, icon: {
                    url: 'http://maps.google.com/mapfiles/kml/paddle/wht-blank.png',

                    scaledSize: new google.maps.Size(48, 48), // scaled size
                    labelOrigin: new google.maps.Point(24, 17)

                }, label: '{{ $stop->route_position }}'  , animation: google.maps.Animation.DROP,});


            @endif

                    @else

            var content{{ $stop->id }} = '<div id="iw-container">' +
                '<div class="iw-title"><i class="icon wrench"></i>{{ $stop->workshop->name }}</div>' +

                '<a target="_blank" href="https://www.google.com/maps?saddr=My+Location&daddr={!! $stop->workshop->adr !!}&destination_place_id={!! $stop->workshop->place_id !!}&travelmode=driving" class="iw-subTitle"><i class="icon map marker alternate"></i> {{ $stop->workshop->adr }}</a>' +
                '</div>';

            var infowindow{{ $stop->id }} = new google.maps.InfoWindow({
                content: content{{ $stop->id }}
            });

            @if($stop->route_position !== null)

                    @if($stop->delivered === 1)
                    var marker{{ $stop->id }} = new google.maps.Marker({position: from{{ $stop->id }}, map: map, label: '{{ $stop->route_position }}', icon: {
                            url: 'http://maps.google.com/mapfiles/kml/paddle/grn-blank.png', // url
                            scaledSize: new google.maps.Size(48, 48), // scaled size
                            labelOrigin: new google.maps.Point(24, 17)

                        }});


                    @else

                    var marker{{ $stop->id }} = new google.maps.Marker({position: from{{ $stop->id }}, map: map, label: '{{ $stop->route_position }}', icon: {
                                url: 'http://maps.google.com/mapfiles/kml/paddle/orange-blank.png', // url
                                scaledSize: new google.maps.Size(48, 48), // scaled size
                                labelOrigin: new google.maps.Point(24, 17)

                            }});


                    @endif

            @else

                    @if($stop->delivered === 1)
                        var marker{{ $stop->id }} = new google.maps.Marker({position: from{{ $stop->id }}, map: map, icon: {
                                url: 'http://maps.google.com/mapfiles/kml/paddle/grn-blank.png', // url
                                scaledSize: new google.maps.Size(48, 48), // scaled size
                                labelOrigin: new google.maps.Point(24, 17)

                            }});


                @else

                var marker{{ $stop->id }} = new google.maps.Marker({position: from{{ $stop->id }}, map: map, icon: {
                            url: 'http://maps.google.com/mapfiles/kml/paddle/orange-blank.png', // url
                            scaledSize: new google.maps.Size(48, 48), // scaled size
                            labelOrigin: new google.maps.Point(24, 17)

                        }});



            @endif


            @endif

                    @endif


                loc{{ $stop->id }} = new google.maps.LatLng(marker{{ $stop->id }}.position.lat(), marker{{ $stop->id }}.position.lng());



            bounds.extend(loc{{ $stop->id }});


            marker{{ $stop->id }}.addListener('click', function() {
                infowindow{{ $stop->id }}.open(map, marker{{ $stop->id }});
            });

            google.maps.event.addListener(map, "click", function(event) {
                infowindow{{ $stop->id }}.close();
            });
                    @endforeach

            var icon = {
                    url: "http://maps.google.com/mapfiles/kml/shapes/ranger_station.png", // url
                    scaledSize: new google.maps.Size(32, 32), // scaled size

                };

            var markerHome = new google.maps.Marker({
                position: new google.maps.LatLng(59.919816, 10.838003),
                icon: icon,
                map: map
            });


            bounds.extend(new google.maps.LatLng(59.919816, 10.838003));

            map.fitBounds(bounds);
            map.panToBounds(bounds);


            var trafficLayer = new google.maps.TrafficLayer();
            trafficLayer.setMap(map);



            //var encoded_data = "ct_mJuwabAxFkIzHuFtHqA`F?rHb@vAPj@F?o@MaB_@gEq@yH{@uJ_CeYMyKf@aFt@iJr@sDzJ{\\\pCsCzBiDn@mA`AUpBxBt@W~C~GlFzD`F|AlFnDZQqAqL?uDDu@mACqAYmB[lGx@|A}R|BqQ^sDOsFaA}IVqW@_W^eGlBqIpB_KzD{GdAuGTsNp@u@P_A}@_B{DgGm@uBz@wK~Hoe@fFc]HgFo@_KC}EpAaPzBsUc@wGmAaB}AyGcBsC_D_BiEwAaB@_FbAuDuAuCaDa@}Ap@gBn@YL@t@t@xS|GlDrA|BbCbBlEz@`GDdQ{CbYXvYQlGuBdQ_I~g@wDpQQbCbBdBtDvGVdAn@|@|DxSjPbj@tLle@xPheAnEp^OtCw@~@QfA`EbGlCxK~A~FRrCi@|BuB`MiAtFu@zAC|@|@nElCnMzCpL`@vBVrJCfD{@p@iDfCuBtD{@RwAg@s@eA_B_FeBmCmKkNuBuBkB_@iC?_@lAtCjGpBjC~Ap@bCIbCcBrCeC|A[rDBxDyA`B[hBjAjCbItCfOpI~YvEnQzPt_AfEtXxDrs@KrTy@zKwBnPkE~RgDdK}GhNoM~SmGjMuBrCMNPt@jBnEALBVJL|AdGj@a@vCcKj@uA`DdAtCxBvDbBzHmAjFs@zDFr@F~AaBt@r@pCcAoAh@aAX]UW]g@|@oA`@iBWmFb@gKbBuBUsCuBqFgDUq@c@fAuBxJeA~@uA_FIm@gCaG_IaGKJ}BwCqFiSuBsJA_@Ue@_BoCiDaGqCmCu@}@K[_@BkCzKqAbJu@vJuCzGk@rC{@c@cENrDOf@Db@\\ZgBf@sArBsEl@gFt@}KfEcLZ}A]YwDcCuEiBaE?mDdAoD~CqAbEeIfx@eFzOgBdHo@pGMdUBtX@jQwB|f@iD|l@{A~Wy@pZMjS^zMtE`TpJ`PnFdIbIvO|I~Y|Ht`@zArHrBnFdB~CpBbFlEnTlDpQ~@jImAlB}@|EGVGL@`@H|DrDaBbASp@r@f@xD^tHq@Ta@mAkAsYmNku@iDiIyBuEkBsHoDwQqAuGQmC}@iE[cBZbB|@hEQXQ_Aa@kBo@yCiAmE}CuK_A_DQcFs@iCkGwK|@}G|@cBtAWdB^dDxDhApBdBRhDp@lBTfDhAhExEvFtGfNjPbHnFrIlJdAdAvEvKpBtNC|ACXDZh@~DjAtSdCpO?|@jBxHnDvRZnAzAhFjCjQzCbOx@pGl@xIjArFzBjFZpBbA\\xE~E`IpNrBrF|DcA|BFZTl@IvBnBnEdIpHlN";
            //var encoded_data = 'aj{lJ}t~_AmBlGa@bFQjJ[jDqApDmCnHoCjGkE`F}AjDgBdA}AhC{AlEi@|E@xCZnDv@hDlFtT@PJX\\]XkAxAyB~@q@jAFnF~B~FnCrEtBbQl@zEFfBRlBt@jBrAxCzCtEdHfAnB^h@j@PrABzAa@~Aq@dAG`DlAtCHxCd@vF|DrElD|DbBn@XBVRHb@gAtBkBhAaApASlBVd@d@p@?|Av@Fa@Z}Cx@uILqGc@qNTkDj@aCxBqGXmI}@sIsDmNWqEDyCZmFNeAbAyAbDkHtBoFtEcG`@ML[Oy@wAgFoDuMq@eEOe@oHcZsIk_@cC}UwAyIoCeJsHgUkMi`@uEyNyFgSmEeSmMkl@mD}NsDiKyHqRo@yFoAwN}@cD{AaDoFuK_AeDe@mEKyEPqG`@cEz@aIp@uHFoL]}FqCwMqCqMoPi_AoCyRq@gLEaJ@oRYkIiAmJwAeHwEmVw@kM`@q[FiQXw@f@I`@Pp@pAFrAwAHo@Ag@OMEUTmB`@{@IaAg@uAkBqCcGmBmBmDe@uDI}FeBsFkBaEgBkBSmAc@_DwDsCa@uENaI@{CFQgDiAwCiAiEhAhEhAvCPfDzCG`IAtEOrC`@~CvDlAb@jBR`EfBrFjB|FdBtDHlDd@lBlBpCbGtAjB`Af@dD\\FTXHPa@x@WpBIF[Ay@_@cBuAaA}@eAWmFEwEE}F@wD^yF~BqMrFwZtAwEdAmBdAkA|GgDxCqAtDcAtIuB|Bw@rWyK|IiEjBeBzDmFNDhHzQjDdG`BfB|BpAbCzAF^Vb@`@IJ_@@M\\K`MdAlKbAzElC|EjDVlAATBNFFf@CBYnDVlNz@fE\\nMt@vD]lMiGx@OzAq@|DUrEa@tAK|Hk@pBKITm@~Ak@lALT|@rBbAzB~@nBj@qBlAiEfA}E@}@YC}DBqHZuSpA]FWo@u@mMk@gBkA_AGiHe@sF?}Bt@mGlF_KfAaCXm@]s@w@qAk@cAkCgEqBmD{ByDqBuCaAq@_BsAqBmCa@{AtAkBfBcG`B{T`@iBl@m@dHaAbDUfD^dACdCiB|@kBdAcGzAwQLa@W}@IBa@cB]iE_AmQp@cQZqILa@]gFc@iXf@Ut@uAvAuNR{@[k@qCCSRRSpCBZj@Sz@wAtNu@tAg@Tg@cIF{BAiAa@CELUE]_@{C{GeAiAqB_A{BKuAe@kGsJ}I_IoCyBmDaAiI_AaBC[oBm@aGSsGA{IV_h@HoAVQfA\\dClDpElIdFpJLV';


            //Slashes is added because they are stripped away when stored to the database for security purposes.
            var encoded_data = "{!! addslashes($stop->route->map_polylines) !!}";



            var decode = google.maps.geometry.encoding.decodePath(encoded_data);

            var line = new google.maps.Polyline({
                path: decode,
                strokeColor: '#00008B',
                strokeOpacity: 0.5,
                strokeWeight: 5,
                zIndex: 3
            });

            line.setMap(map);







        }




    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?libraries=geometry&key=AIzaSyBbs_N37A9PUe80-qtBc4EzC4_GJ_0PJKs&callback=initMap">
    </script>


@endsection