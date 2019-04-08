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


//Init the dropdowns used.
                $('.ui.dropdown')
                    .dropdown({
                        clearable: true
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/no.js"></script>
@endsection


@section('content')

    <main style="margin-bottom: 60vh;">
        <div class="ui container" style="margin-top:80px;">


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
            <div class="ui top attached tabular menu">
                <a class="active item" data-tab="first"><i class="icon edit"></i> Rediger ordre</a>
                <!--<a class="item" data-tab="third">Hente</a>-->
            </div>
            <div class="ui bottom attached active tab segment" data-tab="first">

                <form method="POST" action="{{ route('postedit') }}" class="ui form order error" >
                    @csrf
                    <div class="three fields">
                        <div class="field">
                            <div class="ui corner labeled input">
                                <input class="ui" id="kundenummer"  type="number" max="999999" min="100000"  value="{{ $order->workshop_id }}" name="workshop_id" placeholder="Kundenummer" autocomplete="off">
                                <div class="ui corner label">
                                    <i class="asterisk icon red"></i>
                                </div>
                            </div>
                            <div style="display: none" id="kundenummer-label" class="ui pointing label">
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui corner labeled input">
                                <input type="text" name="ordernumber" value="{{ $order->ordernumber }}"  placeholder="Ordrenummer">
                                <input type="hidden" name="old_ordernumber" value="{{ $order->ordernumber }}">
                                <input type="hidden" name="old_stop" value="{{ $order->stop->id }}">
                                <input type="hidden" name="old_route" value="{{ $order->stop->route->id }}">
                                <div class="ui corner label">
                                    <i class="asterisk icon red"></i>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <select name="route" class="ui search dropdown" id="route">
                                <option value="">Velg rute</option>

                                @foreach($route_routes as $t)
                                    <option {{ ($order->stop->route->route == $t->route) ? 'selected' : '' }} value="{{ $t->route }}">{{ $t->route }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="ui  order">

                        <div class="content">
                            <div class="three fields">

                                <div class="field">
                                    <select name="time" class="ui search dropdown" id="time">
                                        <option value="">Velg tid</option>
                                        @foreach($route_times as $t)
                                            <option {{ ($order->stop->route->time == $t->time) ? 'selected' : '' }} value="{{ $t->time }}">{{ $t->time }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="field">
                                    <input name="date" type="text" id="flatpickr" value="{{ $order->stop->route->date }}">
                                </div>

                                <div class="field">
                                    <!-- Add positive class on valid validation -->
                                    <input class="ui  basic button positive fluid" type="submit" value="Lagre endringer" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="field">
                                <div class="field">
                                    <div class="ui icon input">
                                        <input name="comment" class="fluid" type="text" value="{{ $order->pickupcomment }}" placeholder="Skriv en beskjed til sjåføren..">

                                        <i class="comment alternate outline icon"></i>
                                    </div>

                                </div>
                            </div>
                            <div class="three fields">
                                <div class="field">
                                    <div class="ui kontant test toggle checkbox" style="margin-left:100px; !important; margin-top:5px !important;">
                                        <input  type="checkbox" {{ ($order->amount != null) ? 'checked' : '' }}>
                                    </div>
                                    <div class="ui below pointing label">
                                        Skal det betales med kort eller kontant?
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui corner labeled input">
                                        <input type="text" name="amount" placeholder="sum" id="sum" value="{{ $order->amount }}"  {{ ($order->amount != null) ? '' : 'disabled' }}>
                                        <div style="display: none"  id="input-required-disabled" class="ui corner label input-label-enabled">
                                            <i class="asterisk icon red"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui test toggle checkbox kkode" style="margin-left:70px; !important; margin-top:5px !important;">
                                        <input name="kkode"  type="checkbox" {{ (!empty($order->kkode)) ? 'checked' : '' }}>
                                    </div>
                                    <br>
                                    <div class="ui below pointing label">
                                        Er den en K-Kode? (Bestilling)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </form>
                <!-- Form end -->

                <div class="ui divider">

                </div>
            @if($order->delivered === 1)
                <!--<form method="POST" action="{{ route('undoorderdelivered') }}" class="ui form">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <button type="submit" class="ui basic outline negative button">
                            <i class="undo icon"></i>
                            Angre levering
                        </button>

                    </form> -->

            @else
                <!--   <form method="POST" action="{{ route('markorderdelivered') }}" class="ui form">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <button type="submit" class="ui basic outline positive button">
                            <i class="check green icon"></i>
                            Merk som levert.
                        </button>

                    </form> -->
                @endif






                <form method="POST" action="{{ route('deleteorder') }}" class="ui form">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <button type="submit" class="ui basic outline negative button">
                        <i class="trash alternate icon"></i>
                        Slett
                    </button>

                </form>



            </div>
        </div>
    </main>
@endsection


@section('bottom-scripts')
    <script>
        var flat = flatpickr("#flatPickr", {



        });

        flatpickr('#flatpickr', {
            "locale": "no"
        });


    </script>
@endsection
