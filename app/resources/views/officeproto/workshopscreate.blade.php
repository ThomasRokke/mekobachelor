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


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/se/jszip-2.5.0/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.css"/>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/se/jszip-2.5.0/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable( {
                "language": {
                    "sEmptyTable": "Ingen data tilgjengelig i tabellen",
                    "sInfo": "Viser _START_ til _END_ av _TOTAL_ linjer",
                    "sInfoEmpty": "Viser 0 til 0 av 0 linjer",
                    "sInfoFiltered": "(filtrert fra _MAX_ totalt antall linjer)",
                    "sInfoPostFix": "",
                    "sInfoThousands": " ",
                    "sLoadingRecords": "Laster...",
                    "sLengthMenu": "Vis _MENU_ linjer",
                    "sLoadingRecords": "Laster...",
                    "sProcessing": "Laster...",
                    "sSearch": "S&oslash;k:",
                    "sUrl": "",
                    "sZeroRecords": "Ingen linjer matcher s&oslash;ket",
                    "oPaginate": {
                        "sFirst": "F&oslash;rste",
                        "sPrevious": "Forrige",
                        "sNext": "Neste",
                        "sLast": "Siste"
                    },
                    "oAria": {
                        "sSortAscending": ": aktiver for å sortere kolonnen stigende",
                        "sSortDescending": ": aktiver for å sortere kolonnen synkende"
                    }
                }

            } );

            $('.ui.form')
                .form({
                    fields: {
                        name: {
                            identifier: 'name',
                            rules: [
                                {
                                    type   : 'empty',
                                    prompt : 'Please enter your name'
                                }
                            ]
                        },
                        skills: {
                            identifier: 'skills',
                            rules: [
                                {
                                    type   : 'minCount[2]',
                                    prompt : 'Please select at least two skills'
                                }
                            ]
                        },
                        gender: {
                            identifier: 'gender',
                            rules: [
                                {
                                    type   : 'empty',
                                    prompt : 'Please select a gender'
                                }
                            ]
                        },
                        username: {
                            identifier: 'username',
                            rules: [
                                {
                                    type   : 'empty',
                                    prompt : 'Please enter a username'
                                }
                            ]
                        },
                        password: {
                            identifier: 'password',
                            rules: [
                                {
                                    type   : 'empty',
                                    prompt : 'Please enter a password'
                                },
                                {
                                    type   : 'minLength[6]',
                                    prompt : 'Your password must be at least {ruleValue} characters'
                                }
                            ]
                        },
                        terms: {
                            identifier: 'terms',
                            rules: [
                                {
                                    type   : 'checked',
                                    prompt : 'You must agree to the terms and conditions'
                                }
                            ]
                        }
                    }
                })
            ;

        } );
    </script>
@endsection

@section('content')

    <main style="margin-bottom: 30vh;">

        <div class="ui text  container" style="margin-top:80px;" >

            <div class="main-content">

                <div class="ui horizontal divider">Registrer nytt verksted <i class="icon wrench"></i></div>
                <form method="POST" action="{{ route('office.storecreate') }}" class="ui form segment">
                    @csrf
                    <div class="two fields">
                        <div class="field">
                            <label>Kundenummer</label>
                            <input placeholder="4001..." name="workshop_id" type="text">
                        </div>
                        <div class="field">
                            <label>Rute</label>

                            <input type="number" name="route" placeholder="10">
                        </div>
                    </div>
                    <div class="field">
                        <label>Verkstednavn</label>

                        <input type="text" name="name" placeholder="Stovnerbrua Servicesenter">
                    </div>
                    <div class="field">
                        <label>Lokasjon</label>
                        <div id="searchIcon"  class="ui icon input ">
                            <input type="text" id="from" placeholder="Søk i Google sin database...">
                            <i class="search icon"></i>
                        </div>


                        <div id="fromDelete"  style="margin-top:10px; display: none" onclick="deleteFrom()" class="ui button basic"><i class="icon trash"></i> Fjern valg</div>

                        <input type="hidden" name="fromID" id="fromID" value="">
                        <input type="hidden" name="adr" id="adr" value="">
                        <input type="hidden" name="lat" id="lat" value="">
                        <input type="hidden" name="lng" id="lng" value="">


                        <div id="fromAppend" class="ui relaxed divided list">


                        </div>

                        <div id="fromAdr" style="display: none">
                            <div class="ui positive message">
                                <i class="check icon"></i>
                                Du har nå låst inn valget knyttet til lokasjon. Det er fortsatt mulig å angre ved å trykke
                                <a onclick="deleteFrom()">her</a>
                            </div>
                            <div class="ui dividing header">
                                <i class="map marker alternate icon"></i>
                                <div class="content">
                                    <span id="fromName"></span>
                                    <div id="fromAdrFull" class="sub header">Trondheimsveien 27, 0560</div>


                                </div>
                                <i class="info icon"></i>
                                <div class="content">
                                    <div class="sub header">Lengdegrader: <span id="latspan"></span></div>
                                    <div class="sub header">Breddegrader: <span id="lngspan"></span></div>


                                </div>

                            </div>
                        </div>

                    </div>




                    <div class="ui basic positive submit button">Legg til verksted <i class="icon send"></i></div>
                    <div class="ui error message"></div>
                </form>


            </div>
        </div>



    </main>




@endsection


@section('bottom-scripts')

    <script type="text/javascript" src="{{ asset('js/googleplacesapi.js') }}"></script>

@endsection
