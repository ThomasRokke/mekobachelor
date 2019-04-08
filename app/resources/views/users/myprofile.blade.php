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


                $('.special.cards .image').dimmer({
                    on: 'hover'
                });

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


        .roles-dropdown-fix-icon{
            padding-top: 0!important;
            padding-bottom: 0!important;
        }

        @if(\Illuminate\Support\Facades\Auth::user()->designmode === 1)


            .content{
                        font-size: 1.4em!important;
                    }


        @endif

    </style>


@endsection

@section('content')

    <main style="margin-bottom: 40vh;">

        <div class="ui container" style="margin-top:80px;" >

            <div class="main-content">

                <div class="ui special cards">
                    <div class="card">
                        <div class="blurring dimmable image">
                            <div class="ui dimmer">
                                <div class="content">
                                    <!--<div class="center">
                                        <div class="ui inverted button"><i class="icon upload"></i> Endre bilde</div>
                                    </div>-->
                                </div>
                            </div>
                            <img src="https://semantic-ui.com/images/avatar/large/elliot.jpg">
                        </div>
                        <div class="content">
                            <a class="header">{{ $user->name  }}</a>
                            <div class="meta">
                                <span class="date"><i class="icon mail"></i> {{ $user->email }}</span><br>

                                @php
                                    $role = '';

                                    $level = $user->level();

                                   switch ($level) {
                                    case 1:
                                        $role = 'Sjåfør';
                                        break;
                                     case 3:
                                        $role = 'Kjørekontor';
                                        break;
                                    case 5:
                                    $role = 'Administrasjon';
                                    break;

                                    default:
                                        $role = 'unkown';
                                   }

                                @endphp
                                <span class="date"><i class="icon users"></i> {{ $role }}</span>

                                <div class="ui divider"></div>
                                <div class="ui buttons">
                                    <form action="{{ route('setsmallmode', ['user_id' => \Illuminate\Support\Facades\Auth::user()->id ]) }}" method="POST" class="">
                                        @csrf
                                        <button class="ui button {{ (\Illuminate\Support\Facades\Auth::user()->designmode == 0)  ? 'positive' : '' }}">Liten tekst</button>
                                    </form>

                                    <div  class="or" data-text="&"></div>

                                    <form action="{{ route('setlargemode', ['user_id' => \Illuminate\Support\Facades\Auth::user()->id ]) }}" method="POST" class="">
                                        @csrf
                                        <button class="ui {{ (\Illuminate\Support\Facades\Auth::user()->designmode == 1)  ? 'positive' : '' }} button">Stor tekst</button>
                                    </form>

                                </div>

                            </div>

                        </div>
                        <div class="extra content">
                            <div class="ui list">
                                <a href="{{ route('changepassword') }}" class="item">Endre passord</a>
                                <a href="{{ route('changeemail') }}" class="item">Endre tilknyttet epost</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

@endsection
