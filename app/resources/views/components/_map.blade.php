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