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
@endsection

@section('content')

    <main style="margin-bottom: 60vh;">
        <div class="ui text container" style="margin-top:80px;">
            <div class="ui segment  ">
                <!-- Left rail start -->
                <div class="ui left dividing rail">
                    <div class="ui segment">
                        <div class="item">
                            <h3 class="ui center aligned header">
                                Nylig registrert
                            </h3>
                        </div>
                        <div class="ui middle aligned divided list">




                        </div>



                    </div>


                </div>
                <!-- Left rail end -->
                <!-- Start main content -->

                <div class="main-content">
                    <h1>Kjørekontor Hjem. Skal det kanskje være samme som rute siden?</h1>
                </div>
                <!-- End main content -->
                <!-- Right rail start -->
                <div class="ui right dividing rail">
                    <div class="ui segment">
                        <div class="ui list">
                            <div class="item">
                                <h3 class="ui center aligned header">
                                    Oppdateringer
                                </h3>
                            </div>

                            <div class="item">
                                <img class="ui avatar image" src="https://semantic-ui.com/images/avatar/small/tom.jpg">
                                <div class="content">
                                    <a class="header">Freddy</a>
                                    <div class="description">Startet <a><b>rute 13</b></a> akkurat nå.</div>
                                </div>
                            </div>

                            <div class="item">
                                <img class="ui avatar image" src="https://semantic-ui.com/images/avatar/small/elliot.jpg">
                                <div class="content">
                                    <a class="header">Hassan</a>
                                    <div class="description">Startet <a><b>rute 12</b></a> - 2 min siden.</div>
                                </div>
                            </div>

                            <div class="item">
                                <img class="ui avatar image" src="https://semantic-ui.com/images/avatar/small/matt.jpg">
                                <div class="content">
                                    <a class="header">Roy</a>
                                    <div class="description">Startet <a><b>rute 14</b></a> - 4 min siden.</div>
                                </div>
                            </div>

                            <div class="item">
                                <img class="ui avatar image" src="https://semantic-ui.com/images/avatar/small/christian.jpg">
                                <div class="content">
                                    <a class="header">Lars</a>
                                    <div class="description">Startet <a><b>rute 11</b></a> - 6 min siden.</div>
                                </div>
                            </div>

                            <div class="item">
                                <img class="ui avatar image" src="https://semantic-ui.com/images/avatar/small/tom.jpg">
                                <div class="content">
                                    <a class="header">Svein</a>
                                    <div class="description">Startet <a><b>rute 10</b></a> - 6 min siden.</div>
                                </div>
                            </div>
                            <div class="item">
                                <img class="ui avatar image" src="https://semantic-ui.com/images/avatar/small/tom.jpg">
                                <div class="content">
                                    <a class="header">Freddy</a>
                                    <div class="description">Avsluttet <a><b>rute 13</b></a> - 12 min siden</div>
                                </div>
                            </div>

                            <div class="item">
                                <img class="ui avatar image" src="https://semantic-ui.com/images/avatar/small/elliot.jpg">
                                <div class="content">
                                    <a class="header">Hassan</a>
                                    <div class="description">Avsluttet <a><b>rute 12</b></a> - 16 min siden.</div>
                                </div>
                            </div>

                            <div class="item">
                                <img class="ui avatar image" src="https://semantic-ui.com/images/avatar/small/matt.jpg">
                                <div class="content">
                                    <a class="header">Roy</a>
                                    <div class="description">Avsluttet <a><b>rute 14</b></a> - 24 min siden.</div>
                                </div>
                            </div>

                            <div class="item">
                                <img class="ui avatar image" src="https://semantic-ui.com/images/avatar/small/christian.jpg">
                                <div class="content">
                                    <a class="header">Lars</a>
                                    <div class="description">Avsluttet <a><b>rute 11</b></a> - 32 min siden.</div>
                                </div>
                            </div>

                            <div class="item">
                                <img class="ui avatar image" src="https://semantic-ui.com/images/avatar/small/tom.jpg">
                                <div class="content">
                                    <a class="header">Svein</a>
                                    <div class="description">Avsluttet <a><b>rute 10</b></a> - 36 min siden.</div>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>
                <!-- right rail end -->
            </div>
        </div>



    </main>

@endsection
