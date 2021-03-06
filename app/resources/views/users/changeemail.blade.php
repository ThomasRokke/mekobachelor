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
                                    prompt : 'Vennligst oppgi et nytt passord'
                                },
                                {
                                    type   : 'minLength[6]',
                                    prompt : 'Det nye passordet må være minst {ruleValue} karakterer'
                                }
                            ]
                        },
                        password_confirmaiton: {
                            identifier: 'password_confirmation',
                            rules: [
                                {
                                    type   : 'empty',
                                    prompt : 'Vennligst gjenta nytt passord'
                                },
                                {
                                    type   : 'minLength[6]',
                                    prompt : 'Gjenta nytt passord må være minst {ruleValue} karakterer'
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

                <div class="ui horizontal divider">Endre e-post <i class="icon mail"></i></div>

                @if(session('regconfirm'))
                    <div class="ui success message transition">
                        <i class="close icon"></i>
                        <div class="header">
                            {{ Session::get('regconfirm') }}
                        </div>
                    </div>
                @endif

                @if(session('negative'))
                    <div class="ui error message transition">
                        <i class="close icon"></i>
                        <div class="header">
                            {{ Session::get('negative') }}
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('postchangeemail') }}" class="ui form segment">
                    @csrf
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="mail icon"></i>
                            <input type="email" readonly name="old_email" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}">
                        </div>
                    </div>

                    <div class="field">
                        <div class="ui left icon input">
                            <i class="mail icon"></i>
                            <input type="email"  placeholder="E-post du ønsker å bytte til. Den kan ikke være i bruk i systemet." name="new_email" value="{{ old('new_email') }}">
                        </div>
                    </div>


                    <div class="two fields">
                        <div class="field">
                            <div class="ui basic positive submit button">Lagre e-post <i class="icon send"></i></div>
                        </div>


                    </div>


                    <div class="ui error message"></div>
                </form>
                @if ($errors->any())

                    <div class="ui error message">
                        <i class="close icon"></i>
                        <div class="header">
                            Feilmelding:
                        </div>
                        <ul class="list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>



    </main>




@endsection


@section('bottom-scripts')

    <script type="text/javascript" src="{{ asset('js/googleplacesapi.js') }}"></script>

@endsection
