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
                <h4 class="ui horizontal divider header">
                    <i class="list icon"></i>
                    Rute rapport
                </h4>
                <div class="ui list">

                    @foreach($route->stops as $stop)

                        <div class="item">
                            <i class="wrench icon"></i>
                            <div class="content">
                                <div class="header">{{ $stop->workshop->name }}</div>
                                <div class="description">{{ $stop->deliver_time }} <i class="icon clock outline"></i></div>
                                <div class="list">
                                    @foreach($stop->orders as $order)

                                        @if($order->delivered === 1)
                                        <div class="item">
                                            <i class="check  icon green"></i>
                                            <div class="content">
                                                <div class="header"> {{ $order->ordernumber }}</div>
                                            </div>
                                        </div>

                                        @else
                                            <div class="item">
                                                <i class="ban icon red"></i>
                                                <div class="content">
                                                    <div class="header"> {{ $order->ordernumber }}</div>

                                                </div>
                                            </div>

                                        @endif



                                    @endforeach



                                </div>
                            </div>
                        </div>

                    @endforeach




                </div>

                <h4 class="ui horizontal divider header">
                    <i class="car icon"></i>
                    Du har kjørt {{ $route->kmend - $route->kmstart }}km
                </h4>

                @php
                    use Illuminate\Support\Carbon;
                    $start  = new Carbon($route->started_time);
                    $end    = new Carbon($route->finished_time);

                @endphp
                <h4 class="ui horizontal divider header">
                    <i class="clock icon"></i>
                    {{ $start->diff($end)->format('%ht %imin %ssec') }}
                </h4>

                <a href="{{ route('home') }}" class="fluid big ui button ui blue button"><i class="icon home"></i> Til hjemsiden</a>

            </div>

        </div>
    </main>
    <!--<div class="container">

        <div class="col-xs-12">
            <div class="text-center">
                <h5 class="card-title">Rute sammendrag</h5>
                <ul class="list-group">

                    @foreach($route->stops as $stop)

                        <li class="list-group-item d-flex justify-content-between align-items-center">

                            <span class="route-report-link" style="width: 80%; "><strong>{{ $stop->workshop->name }}</strong></span>
                            <span class="badge badge-success badge-pill"><i class="fa fa-clock"></i> {{ $stop->deliver_time }}</span>

                        </li>

                        <ul class="list-group">
                            @foreach($stop->orders as $order)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $order->ordernumber }}
                                    <span class="badge  badge-pill {{ ($order->delivered === 1) ? 'badge-success ' : 'badge-danger' }}"><i class="fa {{ ($order->delivered === 1) ? 'fa-check ' : 'fa-ban' }}"></i></span>
                                </li>
                            @endforeach

                        </ul>

                    @endforeach

                </ul>
                <hr>
                <h6><i class="fa fa-car-side"></i> Du har kjørt {{ $route->kmend - $route->kmstart }} kilometer.</h6>
                <hr>
                <h6><i class="fa fa-clock"></i>{{ $route->started_time }} -  <i class="fa fa-clock"></i>{{ $route->finished_time }}
                </h6>
            </div>



        </div>

        <a class="big ui button ui blue button" href="{{ route('home') }}">Til hjemsiden</a>
</div>-->
@endsection

@section('scripts')








@endsection
