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
        <div class="ui container" style="margin-top:80px;">
            <div class="ui segment">
                <h1 class="text-center">Velkommen, Navn.</h1>
            </div>
        </div>
    </main>
@endsection