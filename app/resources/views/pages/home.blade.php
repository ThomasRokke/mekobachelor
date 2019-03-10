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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.9/css/weather-icons.min.css" type="text/css">

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

@endsection


@section('content')

    <main style="margin-bottom: 60vh;">
        <div class="ui container" style="margin-top:80px;">
            <div class="ui segment">



               <div class="ui basic image label huge fluid">
                    <img src="https://semantic-ui.com/images/avatar/small/elliot.jpg">
                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                </div>
                <div class="ui divider"></div>
                    @if(!empty($route))
                        @foreach($route as $r)
                            @if($r->started === 1)
                            <p class="lead text-center animated fadeIn text-size">Aktiv rute <strong>{{ $r->route }}</strong> klokken <strong>{{ date('H:i', strtotime($r->time)) }}</strong></p>

                            <a class="abc big ui button ui black button" href="{{ route('transport.route-drive') }}">Gå til ruten</a>
                            @else
                            <p class="lead text-center animated fadeIn text-size">Påmeldt rute <strong>{{ $r->route }}</strong> klokken <strong>{{ date('H:i', strtotime($r->time)) }}</strong></p>

                            <a class="abc big ui button ui black button" href="{{ route('transport.route-preview') }}">Se kjøreliste</a>
                            @endif
                        @endforeach
                    @else
                        <p class="lead text-center animated fadeIn">Du har <strong>ingen</strong> aktive ruter.</p>
                    @endif


            </div>

            <div class="ui segment" style="overflow-x: scroll">
                <script src="https://www.yr.no/sted/Norge/Oslo/Oslo/Oslo/ekstern_boks_time_for_time.js"></script>
                <script src="https://www.yr.no/sted/Norge/Oslo/Oslo/Oslo/ekstern_boks_tre_dager.js"></script><noscript><a href="https://www.yr.no/sted/Norge/Oslo/Oslo/Oslo/">yr.no: Værvarsel for Oslo</a></noscript>
            </div>

        </div>
    </main>
@endsection

@section('bottom-scripts')



@endsection