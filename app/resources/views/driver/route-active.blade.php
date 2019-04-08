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

        .ui.list .list > .item a.header, .ui.list > .item a.header {
            cursor: pointer;
            color: black !important;
        }

        .dots{

            white-space: nowrap !important;
        }


        @if(\Illuminate\Support\Facades\Auth::user()->designmode === 1)

        .item.title .content{
            margin: 5px 0 5px 0;
            font-size:1.4em!important;
        }

        .checkbox{
            font-size: 1.4em!important;
        }

        .btn-size{
            font-size: 1.28571429rem !important;
        }

        @else

        .item.title .content{
            margin: 5px 0 5px 0;
        }

        .ui.fitted.divider{
            margin: 5px 0 5px 0;
        }

        @endif

        .dots-max-width{
            width: 100%!important;
            text-overflow: ellipsis !important;
            overflow: hidden;
            white-space: nowrap;
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

                <a href="{{ route('transport.route-endkm', ['id' => $route->id])  }}" class="fluid ui button negative btn-size">Stopp kjøring</a>

                <div class="ui divider"></div>

                <div class="ui green progress" data-percent="{{ $totalWidth }}" id="example2">
                    <div class="bar"></div>
                    <div class="label">{{ $deliveredCount }}/{{ $count }} levert</div>
                </div>

                <div class="ui divider"></div>

                <div class="ui middle aligned divided list accordion ">

                    @foreach($stops as $stop)

                        <div class="item title dots">



                            <div class="content ">
                                @if($stop->delivered != 1)
                                    <a style="color:black !important; font-size: 1.05em" class="ui header dots-max-width ">  <i style="color:gray!important;" class="icon dot circle"></i>{{ ($stop->route_position !== null)  ?  $stop->route_position : '?' }} - {{ $stop->workshop->name }} </a>
                                @else
                                    <a style="color:black !important; font-size: 1.05em" class="ui header  dots-max-width ">  <i style="color:green!important;" class="icon check"></i>{{ ($stop->route_position !== null)  ?  $stop->route_position : '?' }} - {{ $stop->workshop->name }} </a>
                                @endif

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
                                    <label>{{ $order->ordernumber }}
                                        @if($order->amount > 0)
                                            <i class="green money bill alternate outline icon"></i>
                                            {{ $order->amount }}kr
                                        @endif
                                        @if($order->ordernumber <= 6000 && $order->ordernumber >= 2000)
                                            <i class="exclamation triangle icon"></i><strong>Henteordre</strong>
                                        @endif

                                        @if(!empty($order->pickupcomment))
                                            <i class="comment alternate outline icon"></i> {{ $order->pickupcomment }} <i class="comment alternate outline icon"></i>
                                        @endif
                                    </label>
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
                                        <label>{{ $order->ordernumber }}
                                            @if($order->amount > 0)
                                                <i class="green money bill alternate outline icon"></i>
                                                {{ $order->amount }}kr
                                            @endif
                                            @if($order->ordernumber <= 6000 && $order->ordernumber >= 2000)
                                                <i class="exclamation triangle icon"></i><strong>Henteordre</strong>
                                            @endif

                                            @if(!empty($order->pickupcomment))
                                                <i class="comment alternate outline icon"></i> {{ $order->pickupcomment }} <i class="comment alternate outline icon"></i>
                                            @endif
                                        </label>
                                    </div>

                                    <div class="ui fitted divider"></div>
                                @endforeach


                                <button class="fluid ui button negative">Angre levering  &nbsp;<i class="icon dot circle"></i></button>



                            </form>

                            @endif
                        </div>





                    @endforeach





                </div>







            </div>



            <div class="ui segment">
                <div class="animated bounceInUp" id="map" style="width: 100%; height: 600px;">
                </div>

            </div>

            @if($route->lunch_break === 0)
                <form method="POST" action="{{ route('setlunch', ['route_id' => $route->id]) }}">

                    @csrf

                    <button type="submit" class="fluid ui basic positive button big"><i class="icon food"></i>Merk av for utelunsj</button>

                </form>


            @else
                <div class="ui icon message positive">
                    <i class="food icon"></i>
                    <div class="content">
                        <div class="header">
                            Du har merket av for utelunsj.
                        </div>
                        <p> 30 minutter er trekket fra tidsberegningen.</p>
                    </div>
                </div>

                <div class="ui divider">
                </div>

                <form method="POST" action="{{ route('undolunch', ['route_id' => $route->id]) }}">

                    @csrf

                    <button type="submit" class="fluid ui basic button negative big"><i class="icon food"></i>Angre utelunsj.</button>

                </form>

            @endif


        </div>




    </main>

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
            var content{{ $stop->id }} = '<div id="content">'+
                '<div id="siteNotice">'+
                '</div>'+
                '<h5 id="firstHeading" class="firstHeading">Prioritert - {!! $stop->workshop->name !!}</h5>'+
                '<div id="bodyContent">'+
                '<h6><a target="_blank" href="https://www.google.com/maps?saddr=My+Location&daddr={!! $stop->workshop->adr !!}&destination_place_id={!! $stop->workshop->place_id !!}&travelmode=driving">' +
                '                Veibeskrivelse <i class="fa fa-car"></i></a></h6>'+
                '</div>'+
                '</div>';

            var infowindow{{ $stop->id }} = new google.maps.InfoWindow({
                content: content{{ $stop->id }}
            });

                @if($stop->delivered === 1)
                // The marker, positioned at Uluru
                var marker{{ $stop->id }} = new google.maps.Marker({position: from{{ $stop->id }}, map: map, icon: {

                        url: 'http://maps.google.com/mapfiles/kml/paddle/grn-blank.png',
                        scaledSize: new google.maps.Size(48, 48), // scaled size

                    }, label: '{{ $stop->route_position }}'  , animation: google.maps.Animation.DROP,});

                @else
                    // The marker, positioned at Uluru
                    var marker{{ $stop->id }} = new google.maps.Marker({position: from{{ $stop->id }}, map: map, icon: {

                            url: 'http://maps.google.com/mapfiles/kml/paddle/ylw-blank.png',
                            scaledSize: new google.maps.Size(48, 48), // scaled size

                        }, label: '{{ $stop->route_position }}'  , animation: google.maps.Animation.DROP,});


                @endif


            @else

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

            @if($stop->route_position !== null)
            var marker{{ $stop->id }} = new google.maps.Marker({position: from{{ $stop->id }}, map: map, label: '{{ $stop->route_position }}'  , });
            @else
            var marker{{ $stop->id }} = new google.maps.Marker({position: from{{ $stop->id }}, map: map, icon: {
                        url: 'http://maps.google.com/mapfiles/kml/paddle/red-circle.png', // url
                        scaledSize: new google.maps.Size(32, 32), // scaled size

                    }});

            @endif

            @endif


            loc{{ $stop->id }} = new google.maps.LatLng(marker{{ $stop->id }}.position.lat(), marker{{ $stop->id }}.position.lng());



            bounds.extend(loc{{ $stop->id }});


            marker{{ $stop->id }}.addListener('click', function() {
                infowindow{{ $stop->id }}.open(map, marker{{ $stop->id }});
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
