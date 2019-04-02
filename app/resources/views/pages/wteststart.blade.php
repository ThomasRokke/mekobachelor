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

                $('select.dropdown')
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

    <main>
        <div class="ui container text" style="margin-top:75px">

            <div class="ui segment">

                <div class="ui three steps">
                    <div class="step active ">
                        <i class="car icon"></i>
                        <div class="content">
                            <div class="title">Velg kjøretøy</div>
                        </div>
                    </div>
                    <div class="step">
                        <i class="info icon"></i>
                        <div class="content">
                            <div class="title">Beskriv arbeidet</div>
                        </div>
                    </div>
                    <div class="step">
                        <i class="map marker alternate icon"></i>
                        <div class="content">
                            <div class="title">Finn verksted</div>
                        </div>
                    </div>
                </div>

                <h4 class="ui horizontal divider header">
                    Skriv inn skiltnummer


                </h4>



                <form class="ui fluid form">

                    <div class="ui grid">
                        <div class="ten wide column">
                            <div class="ui corner labeled input fluid">
                                <input type="text" placeholder="DJ43231" value="">
                                <div class="ui corner label">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>

                        </div>
                        <div class="six wide column">
                            <div class="ui positive basic  button fluid" id="toggle-btn">
                                <i class="icon search"></i>
                                Søk
                            </div>
                        </div>
                    </div>


                </form>

                <div class="ui icon message positive more-toggle" style="display: none;">
                    <i class="close icon"></i>
                    <i class="car icon"></i>
                    <div class="content">
                        <div class="header">
                            Toyota Avensis
                        </div>
                        <p>2,5 TDI, Diesel, 2004</p>
                    </div>
                </div>

                <div class="ui divider more-toggle" style="display: none;"></div>

                <a href="{{ route('wtestsecond') }}" class="fluid ui basic button more-toggle" style="display: none;">Neste <i class="icon arrow right"></i></a>






            </div>

        </div>







    </main>

@endsection

@section('bottom-scripts')

    <script>
        $( "#toggle-btn" ).click(function() {
            $( ".more-toggle" ).toggle();
        });
    </script>

@endsection