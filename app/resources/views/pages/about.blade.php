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


            <h1 class="ui header">Om Mekodrive.no</h1>
            <h5>Mekodrive.no er en bacheloroppgave utført av studenter ved E-Business linjen ved Høyskolen Kristiania våren 2019.</h5>

            <p>Målet for prosjektet var å skape et informasjonssystem som effektiviserer og digitaliserer forretningsprosessene tilknyttet kjørekontoret og utkjøring av varer. Med en digital løsning skapes det et datagrunnlag som gjennom en god visuell dataformidling gjør at administrasjon og ledelse kan ta bedre beslutninger på operasjonelt, taktisk og strategisk nivå i organisasjonen.</p>


            <h4 class="ui horizontal divider header">
                <i class="code icon"></i>
                Teknologi benyttet i løsningen
            </h4>
            <div class="ui tag grey labels">
                <a class="ui label">
                    PHP
                </a>
                <a class="ui label">
                    Laravel
                </a>
                <a class="ui label">
                    Semantic UI
                </a>
                <a class="ui label">
                    jQuery
                </a>
                <a class="ui label">
                    Google Advanced Directions API
                </a>
                <a class="ui label">
                    jQuery UI
                </a>
                <a class="ui label">
                    Fortrabbit Droplet
                </a>

                <a class="ui label">
                    Chart.js
                </a>

                <a class="ui label">
                    Highchart.js
                </a>

                <a class="ui label">
                    DataTable
                </a>

                <a class="ui label">
                    MySQL
                </a>

                <a class="ui label">
                    Google Maps JavaScript API
                </a>
                <a class="ui label">
                    GuzzleHTTP
                </a>
                <a class="ui label">
                    AJAX
                </a>
                <a class="ui label">
                    Google Autocomplete API
                </a>

                <a class="ui label">
                    Google Places API
                </a>

                <a class="ui label">
                    jeremykenedy/laravel-roles
                </a>

                <a class="ui label">
                    JavaScript
                </a>
                <a class="ui label">
                    HTML
                </a>
                <a class="ui label">
                    CSS
                </a>
            </div>

            <h4 class="ui horizontal divider header">
                <i class="users icon"></i>
                Om utviklingsteamet
            </h4>

            <div class="ui four column grid stackable">
                <div class="column">
                    <div class="ui card fluid raised">
                        <div class="image">
                            <img src="https://i.ibb.co/CWDS5G5/bilde-av-meg.jpg">
                        </div>
                        <div class="content">
                            <div class="header">Thomas Røkke</div>
                            <div class="meta">
                                <a>E-Business</a>

                            </div>
                        </div>
                        <div class="extra content">
                            <a>
                                <i class="icon code"></i>
                                Utvikler
                            </a>
                        </div>

                    </div>
                </div>

                <div class="column">
                    <div class="ui card fluid raised">
                        <div class="image">
                            <img src="https://semantic-ui.com/images/avatar2/large/elyse.png">
                        </div>
                        <div class="content">
                            <div class="header">Hein Tvengsberg</div>
                            <div class="meta">
                                <a>E-Business</a>

                            </div>
                        </div>
                        <div class="extra content">
                            <a>
                                <i class="icon list alternate outline"></i>
                                Testansvarlig
                            </a>
                        </div>

                    </div>
                </div>

                <div class="column">
                    <div class="ui card fluid raised">
                        <div class="image">
                            <img src="https://semantic-ui.com/images/avatar/large/matt.jpg">
                        </div>
                        <div class="content">
                            <div class="header">Simen Johansen</div>
                            <div class="meta">
                                <a>E-Business</a>

                            </div>
                        </div>
                        <div class="extra content">
                            <a>
                                <i class="icon pencil alternate"></i>
                                Rapportansvarlig
                            </a>
                        </div>

                    </div>
                </div>

                <div class="column">
                    <div class="ui card fluid raised">
                        <div class="image">
                            <img src="https://semantic-ui.com/images/avatar2/large/matthew.png">
                        </div>
                        <div class="content">
                            <div class="header">Kristoffer Fylling</div>
                            <div class="meta">
                                <a>E-Business</a>

                            </div>
                        </div>
                        <div class="extra content">
                            <a>
                                <i class="icon pencil alternate"></i>
                                SCRUM master
                            </a>
                        </div>

                    </div>
                </div>


            </div>


            <div class="ui divider"></div>

            <div class="ui placeholder segment">
                <div class="ui icon header">
                    <i class="pdf file outline icon"></i>
                    Bachelorrapport i PDF format (61 sider). <br>Redigert versjon der konfedensielt innhold er fjernet.
                </div>
                <div class="ui positive button">Last ned  &nbsp; <i class="icon download white"></i></div>
            </div>


            <!--<div class="ui divider"></div>
            <div class="ui eight column grid">
                <div class="column">
                    <div class="ui icon header">
                        <i class="file alternate outline orange icon"></i>
                        <div class="content">
                            Vanlig ordre
                            <div class="sub header">Ikke levert</div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui icon header">
                        <i class="green check icon"></i>
                        <div class="content">
                            Vanlig ordre
                            <div class="sub header">Levert</div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui icon header">
                        <i class="dolly orange icon"></i>
                        <div class="content">
                            Henteordre
                            <div class="sub header">Ikke levert</div>
                        </div>
                    </div>
                </div>
                <div class="column">

                    <div class="ui icon header">
                        <i class="green dolly icon"></i>
                        <div class="content">
                            Henteordre
                            <div class="sub header">Levert</div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui icon header">
                        <i class="orange money bill alternate outline icon"></i>
                        <div class="content">
                            Kontantordre
                            <div class="sub header">Ikke levert</div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui icon header">
                        <i class="green money bill alternate outline icon"></i>
                        <div class="content">
                            Kontantordre
                            <div class="sub header">Levert</div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui icon header">
                        <i class="comment alternate outline icon"></i>
                        <div class="content">
                            Beskjed
                            <div class="sub header">Tillegg til annen status. Ordren har en beskjed.</div>
                        </div>
                    </div>
                </div>
                <div class="column" style="margin-top:20px !important; margin-left: -15px !important;">
                    <div class="ui icon header">
                        <span style="color:red; font-size: 3em;">K</span>
                        <div class="content" style="margin-top:5px !important;">
                            K-kode
                            <div class="sub header">Tillegg til annen status. Vare bestilt fra hovedlager.</div>
                        </div>
                    </div>
                </div>

            </div> -->




















        </div>
    </main>
@endsection

@section('bottom-scripts')
@endsection