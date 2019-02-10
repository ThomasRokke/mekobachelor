@extends('layouts.semantic')

@section('header')
    <script type="text/javascript">
        $(document)
            .ready(function() {
                //Init tab js
                $('.menu .item')
                    .tab();

                //Init accordion.
                $('.ui.accordion')
                    .accordion({
                        animateChildren: false //Set to false because
                    });

                //Make the message box that appear on successfull insert be closable
                $('.message .close')
                    .on('click', function() {
                        $(this)
                            .closest('.message')
                            .transition('fade')
                        ;
                    })
                ;

                $('.prog').progress();

                //Sidebar with overlay transition. Button is attached even to show the navbar.
                $('.left.demo.sidebar').first()
                    .sidebar('attach events', '.open.button', 'show')
                    .sidebar('setting', 'transition', 'overlay');
                $('.open.button')
                    .removeClass('disabled');


                //Init hover
                $('.activating.element')
                    .popup()
                ;

                //Init the dropdowns used.
                $('.ui.dropdown')
                    .dropdown();

                //Validate forms
                $('.ui.form.order')
                    .form({
                        fields: {
                            integer: {
                                identifier: 'kundenummer',
                                rules: [{
                                    type: 'integer[100000..1000000]',
                                    prompt: 'Kundenummeret må være mellom x og y'
                                }]
                            },
                            //Rest of the types grabbed from the documentation.
                            decimal: {
                                identifier: 'decimal',
                                rules: [{
                                    type: 'decimal',
                                    prompt: 'Please enter a valid decimal'
                                }]
                            },
                            number: {
                                identifier: 'number',
                                rules: [{
                                    type: 'number',
                                    prompt: 'Please enter a valid number'
                                }]
                            },
                            email: {
                                identifier: 'email',
                                rules: [{
                                    type: 'email',
                                    prompt: 'Please enter a valid e-mail'
                                }]
                            },
                            url: {
                                identifier: 'url',
                                rules: [{
                                    type: 'url',
                                    prompt: 'Please enter a url'
                                }]
                            },
                            regex: {
                                identifier: 'ordrenummer',
                                rules: [{
                                    type: 'regExp[/^[a-z0-9_-]{6,8}$/]',
                                    prompt: 'Ordrenummeret må bestå av mellom 6 til 8 siffer'
                                }]
                            }
                        }

                    });

                if ($('.ui.form.order').form('is valid', 'ordrenummer')) {
                    // email is valid
                }
                if ($('.ui.form.order').form('is valid')) {

                }


            });

        //Is called to open the modal when an order is pressed.
        //Is called to open the modal when an order is pressed.
        function editOrder(id, ord, knr) {

            $("#modal-header").text(id); //Set the header to id. You can make ur own data passed from onclick by adding more data paramters to the function.
            $("#modal-ord").val(ord); // OrdreNr
            $("#modal-knr").val(knr); // KundeNr
            $('.ui.modal.order')
                .modal({
                    blurring: true //What kind of background around the modal
                })
                .modal('show'); //Show the modal
        }


    </script>

    <style>

        .progress .bar{
            height: 1em !important;
            min-width: 0em !important;
        }

        .progress .label{
            font-size: 0.8em !important;
        }

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
                        @foreach($orders as $order)
                            <div class="item">
                                @if($order->delivered === 1)
                                    <i   class="check green icon"></i>
                                @else
                                    <i   class="orange cogs icon"></i>
                                @endif

                                <div class="content">
                                    <a onclick="editOrder({{ $order->ordernumber }})" class="header overflow-dots">{{ $order->ordernumber }}</a><a style="color:black" href="{{ route('proto.prototest', ['workshop_id' => $order->stop->workshop->workshop_id]) }}" >{{ $order->stop->workshop->name }}</a> <span style="color:gray"><i class="icon clock outline"></i> {{ date('H:i d. M ',strtotime($order->created_at)) }}</span>
                                </div>


                            </div>
                        @endforeach



                    </div>



                </div>


            </div>
            <!-- Left rail end -->
            <!-- Start main content -->

            <div class="main-content">


                @if(session('regconfirm'))
                    <div class="ui success message transition">
                        <i class="close icon"></i>
                        <div class="header">
                            {{ Session::get('regconfirm') }}
                        </div>
                    </div>
                @endif
                <div class="ui top attached tabular menu">
                    <a class="active item" data-tab="first">Ordre</a>
                    <a class="item" data-tab="third">Hente</a>
                </div>
                <div class="ui bottom attached active tab segment" data-tab="first">
                    <form method="POST" action="{{ route('office.postroute') }}" class="ui form order error" >
                        @csrf
                        <div class="three fields">
                            <div class="field">
                                <div class="ui corner labeled input">
                                    <input class="ui" id="kundenummer"  type="text" @if((empty($workshop_id)) ? $workshop_id : '') @endif  value="{{ (!empty($workshop_id)) ? $workshop_id : ''}}" name="workshop_id" placeholder="Kundenummer" autocomplete="off">
                                    <div class="ui corner label">
                                        <i class="asterisk icon red"></i>
                                    </div>
                                </div>
                                <div style="display: none" id="kundenummer-label" class="ui pointing label">
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui corner labeled input">
                                    <input type="text" name="ordernumber" @if((!empty($workshop_id)) ? $workshop_id : '') @endif placeholder="Ordrenummer">
                                    <div class="ui corner label">
                                        <i class="asterisk icon red"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <!-- Add positive class on valid validation -->
                                <input class="ui  basic button positive" type="submit" value="Registrer ordre" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="ui accordion order">
                            <div class="active title">
                                <i class="dropdown icon"></i>
                                Fler valg
                            </div>
                            <div class="content">
                                <div class="three fields">
                                    <div class="field">
                                        <select name="route" class="ui search dropdown">
                                            <option value="">Velg rute</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                        </select>
                                    </div>
                                    <div class="field">
                                        <select name="time" class="ui search dropdown">
                                            <option value="">Velg tid</option>
                                            <option value="07:30">07:30</option>
                                            <option value="08:00">08:00</option>
                                            <option value="09:00">09:00</option>
                                            <option value="10:00">10:00</option>
                                            <option value="12:00">12:00</option>
                                            <option value="13:00">13:00</option>
                                            <option value="14:00">14:00</option>
                                            <option value="17:30">17:30</option>
                                        </select>
                                    </div>
                                    <div class="field">
                                        <input name="date" type="date" placeholder="Dato">
                                    </div>
                                </div>
                                <div class="three fields">
                                    <div class="field">
                                        <div class="ui test toggle checkbox" style="margin-left:80px; !important; margin-top:5px !important;">
                                            <input  type="checkbox">
                                        </div>
                                        <div class="ui below pointing label">
                                            Skal det betales med kort eller kontant?
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="ui corner labeled input">
                                            <input type="text" name="amount" placeholder="sum" id="sum"  disabled>
                                            <div style="display: none"  id="input-required-disabled" class="ui corner label input-label-enabled">
                                                <i class="asterisk icon red"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Form end -->
                </div>
                <div class="ui bottom attached tab segment" data-tab="third">
                    <div class="ui form" >
                        <div class="three fields">
                            <div class="field">
                                <div class="ui search">
                                    <div class="ui left icon input corner labeled">
                                        <input class="prompt" type="text" placeholder="Søk etter verksted">
                                        <i class="wrench icon"></i>
                                        <div class="ui corner label">
                                            <i class="asterisk icon red"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <input type="text" placeholder="Kommentar">
                            </div>
                            <div class="field">
                                <!-- Add positive class on valid validation -->
                                <input class="ui  basic button" type="submit" value="Registrer hentemelding" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="three fields">
                            <div class="field">
                                <select class="ui search dropdown">
                                    <option value="">Velg rute</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                </select>
                            </div>
                            <div class="field">
                                <select class="ui search dropdown">
                                    <option value="">Velg tid</option>
                                    <option value="07:30">07:30</option>
                                    <option value="07:30">08:00</option>
                                    <option value="07:30">09:00</option>
                                    <option value="07:30">12:00</option>
                                    <option value="07:30">14:00</option>
                                    <option value="07:30">17:30</option>
                                </select>
                            </div>
                            <div class="field">
                                <input type="date" placeholder="Dato">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="date-group centered">
                    <a href="{{ route('proto.prototest', ['date' => date('Y/m/d', strtotime('-1 day', strtotime($date)))]) }}" class="ui left icon button outline secondary basic">
                        <i class="left arrow icon"></i>
                        Forrige
                    </a>
                    <button class="ui left icon button basic">
                        <i class="calendar icon"></i>
                        {{ date('d M y', strtotime($date)) }}
                    </button>
                    <a href="{{ route('proto.prototest', ['date' => date('Y/m/d', strtotime('+1 day', strtotime($date)))]) }}" class="ui right icon button outline secondary basic">
                        Neste
                        <i class="right arrow icon"></i>
                    </a>
                </div>
                <div class="ui section divider"></div>
                @if(!$halvsju->isEmpty())
                    <div class="route-wrapper ui accordion">
                        <h2 class="title"><i class="ui icon caret down"></i> 07:30 <i class="ui clock outline icon "></i></h2>
                        <div class="content active">
                            <div class="ui top  tabular menu">

                                @foreach($halvsju as $route)
                                    <a class="item" data-tab="id-{{ $route->route }}-halvsju">Rute {{ $route->route }}</a> 
                                @endforeach

                            </div>
                            @foreach($halvsju as $route)
                                <div class="ui bottom attached tab " data-tab="id-{{ $route->route }}-halvsju">
                                    <div class="ui attached cards" style="margin:0 !important">
                                        @foreach($route->stops as $stop)
                                            <div class="card active" style="width:100%">
                                                <div class="content">
                                                    <div class="header">
                                                        {{ $stop->workshop->name }} <span style="color:grey; font-size:0.8em">{{ $stop->workshop->workshop_id }}</span>
                                                        <span class="right floated">
                  <div class="ui dropdown">
                    <div class="text">1</div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                      <div class="item">
                        1
                      </div>
                      <div class="item">
                        2
                      </div>
                    </div>
                  </div>
                </span>
                                                    </div>
                                                    <!-- Set to active to display -->
                                                    <div class="ui list horizontal attached">
                                                        @foreach($stop->orders as $order)
                                                            <a class="item">
                                                                <div class="content">
                                                                    @if($order->amount === null)
                                                                        <div onclick="editOrder({{ $order->ordernumber }})" class="header"> <i class="icon  {{ ($order->delivered === 1) ? 'green check square outline' : 'orange cogs circle' }}"></i> {{ $order->ordernumber }} &nbsp;</div>
                                                                    <!--<div onclick="editOrder({{ $order->ordernumber }})" class="header"> <i class="icon  {{ ($order->delivered === 1) ? 'green check circle ' : 'orange cogs circle' }}"></i>  {{ $order->ordernumber }} &nbsp;</div>
                                                               -->
                                                                    @else
                                                                        <div onclick="editOrder({{ $order->ordernumber }})" class="header activating element" data-title="OBS! KONTANT" data-content="{{ $order->amount }} kr"> <i class="icon  {{ ($order->delivered === 1) ? 'green money bill alternate outline icon ' : 'orange money bill alternate outline icon' }}"></i>  {{ $order->ordernumber }} &nbsp;</div>

                                                                    @endif
                                                                </div>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="ui bottom attached four item menu">
                                        @php
                                            $routeName = 'proto.prototest';
                                            if($route->active === 1){
                                            $routeName = 'setinactive';
                                            }
                                            else{
                                            $routeName = 'setactive';
                                            }
                                        @endphp
                                        <a href="{{ route($routeName, ['route_id' => $route->id]) }}" class="item">
                                            @if($route->finished === 1)
                                                <div class="ui animated fade button basic green" tabindex="0">
                                                    <div class="visible content"><i class="ui icon check"></i> Fullført</div>
                                                    <div class="hidden content">
                                                        Oh yeah
                                                    </div>
                                                </div>
                                            @elseif($route->active === 1)
                                                <div class="ui animated fade button basic orange" tabindex="0">
                                                    <div class="visible content"><i class="spinner loading icon"></i> Aktiv</div>
                                                    <div class="hidden content">
                                                        Brroom..
                                                    </div>
                                                </div>
                                            @else
                                                <div class="ui animated fade button basic" tabindex="0">
                                                    <div class="visible content"> Inaktiv</div>
                                                    <div class="hidden content">
                                                        Gjør aktiv
                                                    </div>
                                                </div>
                                            @endif
                                        </a>
                                        <div class="item">
                                            <div class="ui dropdown">
                                                <i class="user icon"></i>
                                                <div class="text">{{ (!empty($route->driver)) ? $route->driver->name : 'Velg sjåfør' }}</div>
                                                <i class="dropdown icon"></i>
                                                <div class="menu">
                                                    @foreach($drivers as $driver)
                                                        <a class="item" href="{{ route('setdriver', ['route_id' => $route->id, 'driver_id' => $driver->id]) }}">
                                                            {{ $driver->name }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <a class="item">
                                            <div class="ui dropdown">
                                                <i class="car icon"></i>
                                                <div class="text">CF54301</div>
                                                <i class="dropdown icon"></i>
                                                <div class="menu">
                                                    <div class="item">
                                                        DJ32112
                                                    </div>
                                                    <div class="item">
                                                        LS23111
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="item"><i class="clock outline layout icon" ></i> {{ ($route->started === 1) ? $route->started_time  : '?' }} - {{ ($route->finished === 1) ? $route->finished_time  : '?' }} </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="ui section divider"></div>
                @endif
                @if(!$atte->isEmpty())
                        <div class="route-wrapper ui accordion">
                            <h2 class="title"><i class="ui icon caret down"></i> 08:00 <i class="ui clock outline icon "></i></h2>
                            <div class="content active">
                                <div class="ui top  tabular menu">

                                    @foreach($atte as $route)
                                        <a class="item" data-tab="id-{{ $route->route }}-atte">Rute {{ $route->route }}</a>
                                    @endforeach

                                </div>
                                @foreach($atte as $route)
                                    <div class="ui bottom attached tab " data-tab="id-{{ $route->route }}-atte">
                                        <div class="ui attached cards" style="margin:0 !important">
                                            @foreach($route->stops as $stop)
                                                <div class="card active" style="width:100%">
                                                    <div class="content">
                                                        <div class="header">
                                                            {{ $stop->workshop->name }} <span style="color:grey; font-size:0.8em">{{ $stop->workshop->workshop_id }}</span>
                                                            <span class="right floated">
                  <div class="ui dropdown">
                    <div class="text">1</div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                      <div class="item">
                        1
                      </div>
                      <div class="item">
                        2
                      </div>
                    </div>
                  </div>
                </span>
                                                        </div>
                                                        <!-- Set to active to display -->
                                                        <div class="ui list horizontal attached">
                                                            @foreach($stop->orders as $order)
                                                                <a class="item">
                                                                    <div class="content">
                                                                        @if($order->amount === null)
                                                                            <div onclick="editOrder({{ $order->ordernumber }})" class="header"> <i class="icon  {{ ($order->delivered === 1) ? 'green check square outline' : 'orange cogs circle' }}"></i> {{ $order->ordernumber }} &nbsp;</div>
                                                                        <!--<div onclick="editOrder({{ $order->ordernumber }})" class="header"> <i class="icon  {{ ($order->delivered === 1) ? 'green check circle ' : 'orange cogs circle' }}"></i>  {{ $order->ordernumber }} &nbsp;</div>
                                                               -->
                                                                        @else
                                                                            <div onclick="editOrder({{ $order->ordernumber }})" class="header activating element" data-title="OBS! KONTANT" data-content="{{ $order->amount }} kr"> <i class="icon  {{ ($order->delivered === 1) ? 'green money bill alternate outline icon ' : 'orange money bill alternate outline icon' }}"></i>  {{ $order->ordernumber }} &nbsp;</div>

                                                                        @endif
                                                                    </div>
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="ui bottom attached four item menu">
                                            @php
                                                $routeName = 'proto.prototest';
                                                if($route->active === 1){
                                                $routeName = 'setinactive';
                                                }
                                                else{
                                                $routeName = 'setactive';
                                                }
                                            @endphp
                                            <a href="{{ route($routeName, ['route_id' => $route->id]) }}" class="item">
                                                @if($route->finished === 1)
                                                    <div class="ui animated fade button basic green" tabindex="0">
                                                        <div class="visible content"><i class="ui icon check"></i> Fullført</div>
                                                        <div class="hidden content">
                                                            Oh yeah
                                                        </div>
                                                    </div>
                                                @elseif($route->active === 1)
                                                    <div class="ui animated fade button basic orange" tabindex="0">
                                                        <div class="visible content"><i class="spinner loading icon"></i> Aktiv</div>
                                                        <div class="hidden content">
                                                            Brroom..
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="ui animated fade button basic" tabindex="0">
                                                        <div class="visible content"> Inaktiv</div>
                                                        <div class="hidden content">
                                                            Gjør aktiv
                                                        </div>
                                                    </div>
                                                @endif
                                            </a>
                                            <div class="item">
                                                <div class="ui dropdown">
                                                    <i class="user icon"></i>
                                                    <div class="text">{{ (!empty($route->driver)) ? $route->driver->name : 'Velg sjåfør' }}</div>
                                                    <i class="dropdown icon"></i>
                                                    <div class="menu">
                                                        @foreach($drivers as $driver)
                                                            <a class="item" href="{{ route('setdriver', ['route_id' => $route->id, 'driver_id' => $driver->id]) }}">
                                                                {{ $driver->name }}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="item">
                                                <div class="ui dropdown">
                                                    <i class="car icon"></i>
                                                    <div class="text">CF54301</div>
                                                    <i class="dropdown icon"></i>
                                                    <div class="menu">
                                                        <div class="item">
                                                            DJ32112
                                                        </div>
                                                        <div class="item">
                                                            LS23111
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="item"><i class="clock outline layout icon" ></i> {{ ($route->started === 1) ? $route->started_time  : '?' }} - {{ ($route->finished === 1) ? $route->finished_time  : '?' }} </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="ui section divider"></div>
                    @endif
                @if(!$ti->isEmpty())
                        <div class="route-wrapper ui accordion">
                            <h2 class="title"><i class="ui icon caret down"></i> 10:00 <i class="ui clock outline icon "></i></h2>
                            <div class="content active">
                                <div class="ui top  tabular menu">

                                    @foreach($ti as $route)
                                        <a class="item" data-tab="id-{{ $route->route }}-ti">Rute {{ $route->route }}</a>
                                    @endforeach

                                </div>
                                @foreach($ti as $route)
                                    <div class="ui bottom attached tab " data-tab="id-{{ $route->route }}-ti">
                                        <div class="ui attached cards" style="margin:0 !important">
                                            @foreach($route->stops as $stop)
                                                <div class="card active" style="width:100%">
                                                    <div class="content">
                                                        <div class="header">
                                                            {{ $stop->workshop->name }} <span style="color:grey; font-size:0.8em">{{ $stop->workshop->workshop_id }}</span>
                                                            <span class="right floated">
                  <div class="ui dropdown">
                    <div class="text">1</div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                      <div class="item">
                        1
                      </div>
                      <div class="item">
                        2
                      </div>
                    </div>
                  </div>
                </span>
                                                        </div>
                                                        <!-- Set to active to display -->
                                                        <div class="ui list horizontal attached">
                                                            @foreach($stop->orders as $order)
                                                                <a class="item">
                                                                    <div class="content">
                                                                        @if($order->amount === null)
                                                                            <div onclick="editOrder({{ $order->ordernumber }})" class="header"> <i class="icon  {{ ($order->delivered === 1) ? 'green check square outline' : 'orange cogs circle' }}"></i> {{ $order->ordernumber }} &nbsp;</div>
                                                                        <!--<div onclick="editOrder({{ $order->ordernumber }})" class="header"> <i class="icon  {{ ($order->delivered === 1) ? 'green check circle ' : 'orange cogs circle' }}"></i>  {{ $order->ordernumber }} &nbsp;</div>
                                                               -->
                                                                        @else
                                                                            <div onclick="editOrder({{ $order->ordernumber }})" class="header activating element" data-title="OBS! KONTANT" data-content="{{ $order->amount }} kr"> <i class="icon  {{ ($order->delivered === 1) ? 'green money bill alternate outline icon ' : 'orange money bill alternate outline icon' }}"></i>  {{ $order->ordernumber }} &nbsp;</div>

                                                                        @endif
                                                                    </div>
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="ui bottom attached four item menu">
                                            @php
                                                $routeName = 'proto.prototest';
                                                if($route->active === 1){
                                                $routeName = 'setinactive';
                                                }
                                                else{
                                                $routeName = 'setactive';
                                                }
                                            @endphp
                                            <a href="{{ route($routeName, ['route_id' => $route->id]) }}" class="item">
                                                @if($route->finished === 1)
                                                    <div class="ui animated fade button basic green" tabindex="0">
                                                        <div class="visible content"><i class="ui icon check"></i> Fullført</div>
                                                        <div class="hidden content">
                                                            Oh yeah
                                                        </div>
                                                    </div>
                                                @elseif($route->active === 1)
                                                    <div class="ui animated fade button basic orange" tabindex="0">
                                                        <div class="visible content"><i class="spinner loading icon"></i> Aktiv</div>
                                                        <div class="hidden content">
                                                            Brroom..
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="ui animated fade button basic" tabindex="0">
                                                        <div class="visible content"> Inaktiv</div>
                                                        <div class="hidden content">
                                                            Gjør aktiv
                                                        </div>
                                                    </div>
                                                @endif
                                            </a>
                                            <div class="item">
                                                <div class="ui dropdown">
                                                    <i class="user icon"></i>
                                                    <div class="text">{{ (!empty($route->driver)) ? $route->driver->name : 'Velg sjåfør' }}</div>
                                                    <i class="dropdown icon"></i>
                                                    <div class="menu">
                                                        @foreach($drivers as $driver)
                                                            <a class="item" href="{{ route('setdriver', ['route_id' => $route->id, 'driver_id' => $driver->id]) }}">
                                                                {{ $driver->name }}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="item">
                                                <div class="ui dropdown">
                                                    <i class="car icon"></i>
                                                    <div class="text">CF54301</div>
                                                    <i class="dropdown icon"></i>
                                                    <div class="menu">
                                                        <div class="item">
                                                            DJ32112
                                                        </div>
                                                        <div class="item">
                                                            LS23111
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="item"><i class="clock outline layout icon" ></i> {{ ($route->started === 1) ? $route->started_time  : '?' }} - {{ ($route->finished === 1) ? $route->finished_time  : '?' }} </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="ui section divider"></div>
                    @endif
                @if(!$tolv->isEmpty())
                        <div class="route-wrapper ui accordion">
                            <h2 class="title"><i class="ui icon caret down"></i> 12:00 <i class="ui clock outline icon "></i></h2>
                            <div class="content active">
                                <div class="ui top  tabular menu">

                                    @foreach($tolv as $route)
                                        <a class="item" data-tab="id-{{ $route->route }}-tolv">Rute {{ $route->route }}</a>
                                    @endforeach

                                </div>
                                @foreach($tolv as $route)
                                    <div class="ui bottom attached tab " data-tab="id-{{ $route->route }}-tolv">
                                        <div class="ui attached cards" style="margin:0 !important">
                                            @foreach($route->stops as $stop)
                                                <div class="card active" style="width:100%">
                                                    <div class="content">
                                                        <div class="header">
                                                            {{ $stop->workshop->name }} <span style="color:grey; font-size:0.8em">{{ $stop->workshop->workshop_id }}</span>
                                                            <span class="right floated">
                  <div class="ui dropdown">
                    <div class="text">1</div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                      <div class="item">
                        1
                      </div>
                      <div class="item">
                        2
                      </div>
                    </div>
                  </div>
                </span>
                                                        </div>
                                                        <!-- Set to active to display -->
                                                        <div class="ui list horizontal attached">
                                                            @foreach($stop->orders as $order)
                                                                <a class="item">
                                                                    <div class="content">
                                                                        @if($order->amount === null)
                                                                            <div onclick="editOrder({{ $order->ordernumber }})" class="header"> <i class="icon  {{ ($order->delivered === 1) ? 'green check square outline' : 'orange cogs circle' }}"></i> {{ $order->ordernumber }} &nbsp;</div>
                                                                        <!--<div onclick="editOrder({{ $order->ordernumber }})" class="header"> <i class="icon  {{ ($order->delivered === 1) ? 'green check circle ' : 'orange cogs circle' }}"></i>  {{ $order->ordernumber }} &nbsp;</div>
                                                               -->
                                                                        @else
                                                                            <div onclick="editOrder({{ $order->ordernumber }})" class="header activating element" data-title="OBS! KONTANT" data-content="{{ $order->amount }} kr"> <i class="icon  {{ ($order->delivered === 1) ? 'green money bill alternate outline icon ' : 'orange money bill alternate outline icon' }}"></i>  {{ $order->ordernumber }} &nbsp;</div>

                                                                        @endif
                                                                    </div>
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="ui bottom attached four item menu">
                                            @php
                                                $routeName = 'proto.prototest';
                                                if($route->active === 1){
                                                $routeName = 'setinactive';
                                                }
                                                else{
                                                $routeName = 'setactive';
                                                }
                                            @endphp
                                            <a href="{{ route($routeName, ['route_id' => $route->id]) }}" class="item">
                                                @if($route->finished === 1)
                                                    <div class="ui animated fade button basic green" tabindex="0">
                                                        <div class="visible content"><i class="ui icon check"></i> Fullført</div>
                                                        <div class="hidden content">
                                                            Oh yeah
                                                        </div>
                                                    </div>
                                                @elseif($route->active === 1)
                                                    <div class="ui animated fade button basic orange" tabindex="0">
                                                        <div class="visible content"><i class="spinner loading icon"></i> Aktiv</div>
                                                        <div class="hidden content">
                                                            Brroom..
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="ui animated fade button basic" tabindex="0">
                                                        <div class="visible content"> Inaktiv</div>
                                                        <div class="hidden content">
                                                            Gjør aktiv
                                                        </div>
                                                    </div>
                                                @endif
                                            </a>
                                            <div class="item">
                                                <div class="ui dropdown">
                                                    <i class="user icon"></i>
                                                    <div class="text">{{ (!empty($route->driver)) ? $route->driver->name : 'Velg sjåfør' }}</div>
                                                    <i class="dropdown icon"></i>
                                                    <div class="menu">
                                                        @foreach($drivers as $driver)
                                                            <a class="item" href="{{ route('setdriver', ['route_id' => $route->id, 'driver_id' => $driver->id]) }}">
                                                                {{ $driver->name }}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="item">
                                                <div class="ui dropdown">
                                                    <i class="car icon"></i>
                                                    <div class="text">CF54301</div>
                                                    <i class="dropdown icon"></i>
                                                    <div class="menu">
                                                        <div class="item">
                                                            DJ32112
                                                        </div>
                                                        <div class="item">
                                                            LS23111
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="item"><i class="clock outline layout icon" ></i> {{ ($route->started === 1) ? $route->started_time  : '?' }} - {{ ($route->finished === 1) ? $route->finished_time  : '?' }} </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="ui section divider"></div>
                    @endif
                @if(!$to->isEmpty())
                        <div class="route-wrapper ui accordion">
                            <h2 class="title"><i class="ui icon caret down"></i> 14:00 <i class="ui clock outline icon "></i></h2>
                            <div class="content active">
                                <div class="ui top  tabular menu">

                                    @foreach($to as $route)
                                        <a class="item" data-tab="id-{{ $route->route }}-to">Rute {{ $route->route }}</a>
                                    @endforeach

                                </div>
                                @foreach($to as $route)
                                    <div class="ui bottom attached tab " data-tab="id-{{ $route->route }}-to">
                                        <div class="ui attached cards" style="margin:0 !important">
                                            @foreach($route->stops as $stop)
                                                <div class="card active" style="width:100%">
                                                    <div class="content">
                                                        <div class="header">
                                                            {{ $stop->workshop->name }} <span style="color:grey; font-size:0.8em">{{ $stop->workshop->workshop_id }}</span>
                                                            <span class="right floated">
                  <div class="ui dropdown">
                    <div class="text">1</div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                      <div class="item">
                        1
                      </div>
                      <div class="item">
                        2
                      </div>
                    </div>
                  </div>
                </span>
                                                        </div>
                                                        <!-- Set to active to display -->
                                                        <div class="ui list horizontal attached">
                                                            @foreach($stop->orders as $order)
                                                                <a class="item">
                                                                    <div class="content">
                                                                        @if($order->amount === null)
                                                                            <div onclick="editOrder({{ $order->ordernumber }})" class="header"> <i class="icon  {{ ($order->delivered === 1) ? 'green check square outline' : 'orange cogs circle' }}"></i> {{ $order->ordernumber }} &nbsp;</div>
                                                                        <!--<div onclick="editOrder({{ $order->ordernumber }})" class="header"> <i class="icon  {{ ($order->delivered === 1) ? 'green check circle ' : 'orange cogs circle' }}"></i>  {{ $order->ordernumber }} &nbsp;</div>
                                                               -->
                                                                        @else
                                                                            <div onclick="editOrder({{ $order->ordernumber }})" class="header activating element" data-title="OBS! KONTANT" data-content="{{ $order->amount }} kr"> <i class="icon  {{ ($order->delivered === 1) ? 'green money bill alternate outline icon ' : 'orange money bill alternate outline icon' }}"></i>  {{ $order->ordernumber }} &nbsp;</div>

                                                                        @endif
                                                                    </div>
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="ui bottom attached four item menu">
                                            @php
                                                $routeName = 'proto.prototest';
                                                if($route->active === 1){
                                                $routeName = 'setinactive';
                                                }
                                                else{
                                                $routeName = 'setactive';
                                                }
                                            @endphp
                                            <a href="{{ route($routeName, ['route_id' => $route->id]) }}" class="item">
                                                @if($route->finished === 1)
                                                    <div class="ui animated fade button basic green" tabindex="0">
                                                        <div class="visible content"><i class="ui icon check"></i> Fullført</div>
                                                        <div class="hidden content">
                                                            Oh yeah
                                                        </div>
                                                    </div>
                                                @elseif($route->active === 1)
                                                    <div class="ui animated fade button basic orange" tabindex="0">
                                                        <div class="visible content"><i class="spinner loading icon"></i> Aktiv</div>
                                                        <div class="hidden content">
                                                            Brroom..
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="ui animated fade button basic" tabindex="0">
                                                        <div class="visible content"> Inaktiv</div>
                                                        <div class="hidden content">
                                                            Gjør aktiv
                                                        </div>
                                                    </div>
                                                @endif
                                            </a>
                                            <div class="item">
                                                <div class="ui dropdown">
                                                    <i class="user icon"></i>
                                                    <div class="text">{{ (!empty($route->driver)) ? $route->driver->name : 'Velg sjåfør' }}</div>
                                                    <i class="dropdown icon"></i>
                                                    <div class="menu">
                                                        @foreach($drivers as $driver)
                                                            <a class="item" href="{{ route('setdriver', ['route_id' => $route->id, 'driver_id' => $driver->id]) }}">
                                                                {{ $driver->name }}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="item">
                                                <div class="ui dropdown">
                                                    <i class="car icon"></i>
                                                    <div class="text">CF54301</div>
                                                    <i class="dropdown icon"></i>
                                                    <div class="menu">
                                                        <div class="item">
                                                            DJ32112
                                                        </div>
                                                        <div class="item">
                                                            LS23111
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="item"><i class="clock outline layout icon" ></i> {{ ($route->started === 1) ? $route->started_time  : '?' }} - {{ ($route->finished === 1) ? $route->finished_time  : '?' }} </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="ui section divider"></div>
                    @endif
            </div><!-- End main content -->
            <!-- Right rail start -->
            <div class="ui right dividing rail">

                <div class="ui segment">
                    <div class="ui list">
                        <div class="item">
                            <h3 class="ui center aligned header">
                                Sjåfører
                            </h3>
                        </div>

                        @foreach($drivers as $driver)
                            <div class="item">
                                <img class="ui avatar image" src="https://semantic-ui.com/images/avatar/small/tom.jpg">
                                <div class="content">
                                    <a class="header">{{ $driver->name }}</a>

                                    <!-- TODO!! Må opprette logikk for å håndtere flere sjåfører. Nå leter den kun i den FØRSTE aktive ruten. -->
                                    @if(!empty($driver->route))


                                        @if($driver->route->active === 1)

                                            @if($driver->route->started === 1)
                                                <div class="description">Kjører <a><b>rute {{ $driver->route->route }}</b></a></div>
                                                <div class="description">Startet {{ date('H:i',strtotime($driver->route->created_at)) }} <a></a></div>

                                                @php
                                                    $driverRoute = $driver->route;
                                                    $total = 0;
                                                    $finished = 0;

                                                    foreach($driverRoute->stops as $stop){

                                                        $total = $total + 1;
                                                        if($stop->delivered === 1){
                                                            $finished = $finished + 1;
                                                        }
                                                    }


                                                    $percentPer =  100 / $total;

                                                    $totalPercent = $percentPer * $finished;


                                                @endphp
                                                <div class="ui green progress prog" data-percent="{{ $totalPercent }}" >
                                                    <div class="bar"></div>
                                                    <div class="label">{{ $finished }}/{{ $total }} </div>
                                                </div>

                                            @else
                                                <div class="description">Påmeldt aktiv <a><b>rute {{ $driver->route->route }}</b></a></div>


                                            @endif

                                        @else

                                            <div class="description">Ikke påmeldt noen ruter</div>

                                        @endif

                                    @else

                                        <div class="description">Ikke påmeldt noen ruter</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach





                    </div>
                </div>

                <!-- Can add extra segments for more separeted content -->
            </div>
            <!-- right rail end -->
        </div>
    </div>
    <!-- Modal Kontant-->
    <div class="ui modal">
        <i class="close icon"></i>
        <div class="header">
            # 83213
        </div>
        <div class="image content">
            <div class="ui medium image">
                <img src="https://d2gg9evh47fn9z.cloudfront.net/800px_COLOURBOX22409286.jpg">
            </div>
            <div class="description">
                <div class="ui header">Her skal jeg lage et oppsett for å flytte ordre osv</div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus magnam quo dolor illum molestias. Odio.</p>
            </div>
        </div>
        <div class="actions">
            <div class="ui black deny button">
                Avbryt
            </div>
            <div class="ui positive right labeled icon button">
                Jeg forstår
                <i class="checkmark icon"></i>
            </div>
        </div>
    </div>
    <!-- End modal -->
    <div class="ui modal order">
        <i class="close icon"></i>
        <div class="header">
            <div>
                <i class="icon file outline"></i>
                <bold><span id="modal-header"></span></bold>
            </div>
        </div>
        <div class="image content ">
            <div class="ui medium image">
                <img src="https://d2gg9evh47fn9z.cloudfront.net/800px_COLOURBOX22409286.jpg">
            </div>
            <div class="description">
                <div class="ui header">Rediger ordre</div>

                <!-- FORM THING -->

                <form method="POST" action="{{ route('office.postroute') }}" class="ui form order error" >
                    @csrf
                    <div class="three fields">
                        <div class="field">
                            <div class="ui corner labeled input">
                                <input class="ui" id="modal-knr" type="text" name="workshop_id" placeholder="Kundenummer" autocomplete="off">
                                <div class="ui corner label">
                                    <i class="asterisk icon red"></i>
                                </div>
                            </div>
                            <div style="display: none" id="kundenummer-label" class="ui pointing label">
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui corner labeled input">
                                <input type="text" id="modal-ord" name="ordernumber" placeholder="Ordrenummer">
                                <div class="ui corner label">
                                    <i class="asterisk icon red"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="ui  order">

                        <div class="content">
                            <div class="three fields">
                                <div class="field">
                                    <select name="route" class="ui search dropdown">
                                        <option value="">Velg rute</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <select name="time" class="ui search dropdown">
                                        <option value="">Velg tid</option>
                                        <option value="07:30">07:30</option>
                                        <option value="08:00">08:00</option>
                                        <option value="09:00">09:00</option>
                                        <option value="10:00">10:00</option>
                                        <option value="12:00">12:00</option>
                                        <option value="13:00">13:00</option>
                                        <option value="14:00">14:00</option>
                                        <option value="17:30">17:30</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <input name="date" type="date" placeholder="Dato">
                                </div>
                            </div>

                            <!-- TODO Gjør sånn at checkboks for kontant står på riktig valgt verdi -->
                            <div class="three fields">
                                <div class="field">
                                    <div class="ui test toggle checkbox" style="margin-left:80px; !important; margin-top:5px !important;">
                                        <input  type="checkbox">
                                    </div>
                                    <div class="ui below pointing label">
                                        Kort/kontant
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui corner labeled input">
                                        <input type="text" placeholder="sum" id="sum"  disabled>
                                        <div style="display: none"  id="input-required-disabled" class="ui corner label input-label-enabled">
                                            <i class="asterisk icon red"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- END FORM THING -->
            </div>
        </div>

        <div class="actions">
            <div class="ui black deny button">
                Avbryt
            </div>
            <div class="ui positive right labeled icon button">
                Lagre endring
                <i class="checkmark icon"></i>
            </div>
        </div>
    </div>
@endsection
