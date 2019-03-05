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


                @php

                    $gotCash = false;
                    $totalCash = 0;
                    $amountOfCashOrders = 0;
                    foreach($route->stops as $s){
                        foreach($s->orders as $o){
                            if($o->amount !== null){
                                $totalCash = $totalCash + $o->amount;
                                $amountOfCashOrders++;
                                $gotCash = true;
                            }
                        }
                    }

                @endphp

                @if($gotCash)
                $('.ui.dimmer.modals')
                    .modal('setting', 'closable', false)
                    .modal('show')

                ;
                @endif


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
        <div class="ui container" style="margin-top:80px;">
            <div class="ui segment">



                <h4 class="text-center">Fyll inn antall kilometer ved start</h4>

                <form method="post" action="{{ route('transport.route-setstartkm') }}">
                    @csrf

                    <div class="ui right icon input">
                        <input  placeholder="Kilometerstand" name="kmstart" autofocus="" id="validationDefaultUsername" type="tel"
                                autocomplete="off" required="" oninvalid="this.setCustomValidity('Fyll inn riktig kilometstand.')"
                                oninput="this.setCustomValidity('')">
                        <i class="car icon"></i>
                    </div>
                    <input type="hidden" name="routeid" value="{{ $route->id }}">
                    <button class="ui right labeled icon button positive">

                        Start
                        <i class="play icon"></i>
                    </button>

                </form>






            </div>
        </div>
    </main>

    <div class="ui dimmer modals page transition" style="display: flex !important;"><div class="ui fullscreen modal transition hidden">
            <i class="close icon"></i>
            <div class="header">
                Update Your Settings
            </div>
            <div class="content">
                <div class="ui form">
                    <h4 class="ui dividing header">Give us your feedback</h4>
                    <div class="field">
                        <label>Feedback</label>
                        <textarea data-gramm="true" data-txt_gramm_id="30999a71-9e71-879b-1436-e798d2805f51" data-gramm_id="30999a71-9e71-879b-1436-e798d2805f51" spellcheck="false" data-gramm_editor="true" style="z-index: auto; position: relative; line-height: 17.9998px; font-size: 14px; transition: none 0s ease 0s; background: none 0% 0% / auto repeat scroll padding-box border-box rgb(255, 255, 255);"></textarea><grammarly-btn><div class="_1BN1N Kzi1t MoE_1 _2DJZN" style="z-index: 2; transform: translate(1719.05px, 184px);"><div class="_1HjH7"><div title="Protected by Grammarly" class="_3qe6h">&nbsp;</div></div></div></grammarly-btn>
                    </div>
                    <div class="field">
                        <div class="ui checkbox">
                            <input type="checkbox" checked="checked" name="contact-me" tabindex="0" class="hidden">
                            <label>It's okay to contact me.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="actions">
                <div class="ui button">Cancel</div>
                <div class="ui green button">Send</div>
            </div>
        </div><div class="ui small basic test modal transition visible active" style="display: block !important;">
            <div class="ui icon header">
                <i class="green money bill alternate outline icon"></i>
                Kontantordre på ruten
            </div>
            <div class="content">
                <p>Husk å ta med bankterminal. Har du tatt med terminal?</p>
            </div>
            <div class="actions">
                <div class="ui red basic cancel inverted button">
                    <i class="remove icon"></i>
                    Nei
                </div>
                <div class="ui green ok inverted button">
                    <i class="checkmark icon"></i>
                    Ja
                </div>
            </div>
        </div></div>
@endsection