<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="https://www.mekonomen.se/favicon.ico?v=2">

    <link rel="icon" href="https://www.mekonomen.se/favicon.ico?v=2">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css">


    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js"></script>

    <script>
        $(document)
            .ready(function() {
                $('.menu .item')
                    .tab()
                ;

                $('.ui.accordion')
                    .accordion({
                        animateChildren: false
                    })
                ;


                $('.left.demo.sidebar').first()
                    .sidebar('attach events', '.open.button', 'show')
                    .sidebar('setting', 'transition', 'overlay')
                ;
                $('.open.button')
                    .removeClass('disabled')
                ;



                $('.ui.dropdown')
                    .dropdown()
                ;

                //Validate forms
                $('.ui.form.order')
                    .form({
                        fields: {
                            integer: {
                                identifier  : 'kundenummer',
                                rules: [
                                    {
                                        type   : 'integer[100000..1000000]',
                                        prompt : 'Kundenummeret må være mellom x og y'
                                    }
                                ]
                            },
                            decimal: {
                                identifier  : 'decimal',
                                rules: [
                                    {
                                        type   : 'decimal',
                                        prompt : 'Please enter a valid decimal'
                                    }
                                ]
                            },
                            number: {
                                identifier  : 'number',
                                rules: [
                                    {
                                        type   : 'number',
                                        prompt : 'Please enter a valid number'
                                    }
                                ]
                            },
                            email: {
                                identifier  : 'email',
                                rules: [
                                    {
                                        type   : 'email',
                                        prompt : 'Please enter a valid e-mail'
                                    }
                                ]
                            },
                            url: {
                                identifier  : 'url',
                                rules: [
                                    {
                                        type   : 'url',
                                        prompt : 'Please enter a url'
                                    }
                                ]
                            },
                            regex: {
                                identifier  : 'kundenummer',
                                rules: [
                                    {
                                        type   : 'regExp[/^[a-z0-9_-]{6,8}$/]',
                                        prompt : 'Kundenummeret må bestå av mellom 6 til 8 siffer'
                                    }
                                ]
                            }
                        }

                    })
                ;
                if( $('.ui.form.order').form('is valid', 'ordrenummer')) {
                    // email is valid
                }
                if( $('.ui.form.order').form('is valid')) {
                    alert('both are valid');
                }


            })
        ;

        function editOrder(id){
            $("#modal-header").text(id);
            $('.ui.modal.order')
                .modal({
                    blurring: true
                })
                .modal('show')
            ;
        }


    </script>

    <style>

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

    </style>




    <title>Semantic test </title>
</head>
<body>


<!-- Nav -->
<div class="ui fixed  menu">
    <a href="#" class="item open button">
        <i class="sidebar icon"></i>
        Meny
    </a>
    <div class="ui container">

        <div class="header item" style="border-left:none!important">
            Mekodrive
        </div>

        <div class="left menu">
            <div class="ui left aligned category search item">
                <div class="ui transparent icon input">
                    <input class="prompt" type="text" placeholder="Søk etter ordrenummer...">
                    <i class="search link icon"></i>
                </div>
                <div class="results"></div>
            </div>
        </div>

    </div>
</div>

<!-- End nav -->
<!-- Sidenav-->
<div class="ui left demo inverted  vertical  sidebar labeled icon menu ">
    <a class="item">
        <i class="home icon"></i> Hjem
    </a>
    <a class="item active">
        <i class="table layout icon a"></i> Ruter
    </a>
    <a class="item">
        <i class="wrench icon"></i> Verksteder
    </a>
    <a class="item">
        <i class="users icon"></i> Roller
    </a>

</div>
<!--End sidenav-->


<div class="ui text container" style="margin-top:80px;">





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

                        <input class="ui" id="kundenummer" type="text" name="workshop_id" placeholder="Kundenummer">
                        <div class="ui corner label">
                            <i class="asterisk icon red"></i>
                        </div>

                    </div>
                    <div style="display: none" id="kundenummer-label" class="ui pointing label">

                    </div>
                </div>
                <div class="field">



                    <div class="ui corner labeled input">
                        <input type="text" name="ordernumber" placeholder="Ordrenummer">
                        <div class="ui corner label">
                            <i class="asterisk icon red"></i>
                        </div>
                    </div>


                </div>
                <div class="field">

                    <!-- Add positive class on valid validation -->
                    <input class="ui  basic button" type="submit" value="Registrer ordre" placeholder="Last Name">
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


                    <div class="three fields">
                        <div class="field">
                            <div class="ui test toggle checkbox" style="margin-left:80px; !important; margin-top:5px !important;">


                                <input  type="checkbox">




                            </div> <div class="ui below pointing label">
                                Skal det betales med kort eller kontant?
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

        </form><!-- Form end -->



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

            <div class="ui accordion">
                <div class="active title">
                    <i class="dropdown icon"></i>
                    Fler valg
                </div>
                <div class="content ">

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

        </div>
    </div>

    <div class="ui section divider"></div>




    <div class="route-wrapper ui accordion">

        <h2 class="title"><i class="ui clock outline icon "></i>08:00</h2>


        <div class="content active">
            <div class="ui top  tabular menu">
                <a class="active item" data-tab="id-10">Rute 10</a>
                <a class="item" data-tab="id-11">Rute 11</a>
                <a class="item" data-tab="id-12">Rute 12</a>
            </div>
            <div class="ui bottom attached active tab " data-tab="id-10">
                <div class="ui attached cards" style="margin:0 !important">

                    @foreach($route->stops as $stop)
                    <div class="card active" style="width:100%">
                        <div class="content">
                            <div class="header">{{ $stop->workshop->name }} <span style="color:grey; font-size:0.8em">{{ $stop->workshop->workshop_id }}</span>
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
                            </span></div>

                            <!-- Set to active to display -->
                            <div class="ui list horizontal attached">
                                @foreach($stop->orders as $order)
                                <a class="item">
                                    <div class="content">
                                        <div onclick="editOrder({{ $order->ordernumber }})" class="header"> <i class="check circle green icon"></i> {{ $order->ordernumber }}</div>
                                    </div>
                                </a>
                                @endforeach


                            </div>

                        </div>

                    </div>
                    @endforeach


                </div>
                <div class="ui four item menu">

                    <a class="item">
                        <div class="ui animated fade button basic green" tabindex="0">
                            <div class="visible content"><i class="ui icon check"></i> Fullført</div>
                            <div class="hidden content">
                                Gjør aktiv
                            </div>
                        </div>
                    </a>
                    <a class="item">

                        <div class="ui dropdown">
                            <i class="user icon"></i>
                            <div class="text">{{ $route->driver->name }}</div>
                            <i class="dropdown icon"></i>
                            <div class="menu">

                                @foreach($drivers as $d)
                                <div class="item">
                                    {{ $d->name }}
                                </div>
                                @endforeach


                            </div>
                        </div>

                    </a>
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
                    <a class="item"><i class="clock outline layout icon" ></i> 08:02 - 09:13 </a>
                </div>

            </div>
            <div class="ui bottom attached tab " data-tab="id-11">
                <div class="ui attached cards" style="margin:0 !important">

                    <div class="card active" style="width:100%">
                        <div class="content">
                            <div class="header">Kvickstop strømmen <span style="color:grey; font-size:0.8em">500190</span>
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
                            </span></div>

                            <!-- Set to active to display -->
                            <div class="ui list horizontal attached">
                                <a class="item">
                                    <div class="content">
                                        <div onclick="editOrder()" class="header"> <i class="check circle green icon"></i> 234234</div>
                                    </div>
                                </a>
                                <a class="item">
                                    <div class="content">
                                        <div onclick="editOrder()" class="header"> <i class="check circle green icon"></i> 234234</div>
                                    </div>
                                </a>
                                <a class="item">
                                    <div class="content">
                                        <div onclick="editOrder()" class="header"> <i class="check circle green icon"></i> 234234</div>
                                    </div>
                                </a>

                            </div>

                        </div>

                    </div>

                </div>
                <div class="ui bottom attached four item menu">

                    <a class="item">
                        <div class="ui animated fade button basic green" tabindex="0">
                            <div class="visible content"><i class="ui icon check"></i> Fullført</div>
                            <div class="hidden content">
                                Gjør aktiv
                            </div>
                        </div>
                    </a>
                    <a class="item">

                        <div class="ui dropdown">
                            <i class="user icon"></i>
                            <div class="text">Roy</div>
                            <i class="dropdown icon"></i>
                            <div class="menu">

                                <div class="item">
                                    Thomas Røkke
                                </div>
                                <div class="item">
                                    Hassan
                                </div>

                            </div>
                        </div>

                    </a>
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
                    <a class="item"><i class="clock outline layout icon" ></i> 08:02 - 09:13 </a>
                </div>
            </div>
            <div class="ui bottom attached tab" data-tab="id-12">
                <div class="ui attached cards" style="margin:0 !important">

                    <div class="card active" style="width:100%">
                        <div class="content">
                            <div class="header">Mekonomen Lillestrøm <span style="color:grey; font-size:0.8em">500190</span>
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
                            </span></div>

                            <!-- Set to active to display -->
                            <div class="ui list horizontal attached">
                                <a class="item">
                                    <div class="content">
                                        <div onclick="editOrder()" class="header"> <i class="check circle green icon"></i> 234234</div>
                                    </div>
                                </a>
                                <a class="item">
                                    <div class="content">
                                        <div onclick="editOrder()" class="header"> <i class="check circle green icon"></i> 234234</div>
                                    </div>
                                </a>
                                <a class="item">
                                    <div class="content">
                                        <div onclick="editOrder()" class="header"> <i class="check circle green icon"></i> 234234</div>
                                    </div>
                                </a>

                            </div>

                        </div>

                    </div>

                </div>
                <div class="ui bottom attached four item menu">

                    <a class="item">
                        <div class="ui animated fade button basic green" tabindex="0">
                            <div class="visible content"><i class="ui icon check"></i> Fullført</div>
                            <div class="hidden content">
                                Gjør aktiv
                            </div>
                        </div>
                    </a>
                    <a class="item">

                        <div class="ui dropdown">
                            <i class="user icon"></i>
                            <div class="text">Roy</div>
                            <i class="dropdown icon"></i>
                            <div class="menu">

                                <div class="item">
                                    Thomas Røkke
                                </div>
                                <div class="item">
                                    Hassan
                                </div>

                            </div>
                        </div>

                    </a>
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
                    <a class="item"><i class="clock outline layout icon" ></i> 08:02 - 09:13 </a>
                </div>
            </div>




        </div>


    </div>

    <div class="ui section divider"></div>

    <div class="route-wrapper ui accordion">

        <h2 class="title"><i class="ui clock outline icon "></i>10:00</h2>


        <div class="content active">
            <div class="ui top attached five pointing menu ">
                <a class="item active">
                    10
                </a>
                <a class="item">
                    11
                </a>
                <a class="item">
                    12
                </a>
                <a class="item">
                    13
                </a>

                <div class="right menu">
                    <div class="item">
                        <div class="ui transparent icon input">
                            <input type="text" placeholder="Søk på ordrenummer...">
                            <i class="search link icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ui attached cards" style="margin:0 !important">

                <div class="card active" style="width:100%">
                    <div class="content">
                        <div class="header">Stovnerbrua Servicesenter <span style="color:grey; font-size:0.8em">500190</span>
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
        </span></div>

                        <!-- Set to active to display -->
                        <div class="ui list horizontal attached">
                            <a class="item">
                                <div class="content">
                                    <div onclick="editOrder()" class="header"> <i class="check circle green icon"></i> 234234</div>
                                </div>
                            </a>
                            <a class="item">
                                <div class="content">
                                    <div onclick="editOrder()" class="header"> <i class="check circle green icon"></i> 234234</div>
                                </div>
                            </a>
                            <a class="item">
                                <div class="content">
                                    <div onclick="editOrder()" class="header"> <i class="check circle green icon"></i> 234234</div>
                                </div>
                            </a>

                        </div>

                    </div>

                </div>

                <div class="card active" style="width:100%">
                    <div class="content">
                        <div class="header">Kvickstop Strømmen <span style="color:grey; font-size:0.8em">500191</span>
                            <span class="right floated">
          <div class="ui dropdown">
            <div class="text">2</div>
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
        </span></div>

                        <!-- Set to active to display -->
                        <div class="ui list horizontal attached">
                            <a class="item">
                                <div class="content">
                                    <div onclick="editOrder()" class="header"> <i class="edit outline icon"></i> 234234</div>
                                </div>
                            </a>
                            <a class="item">
                                <div class="content">
                                    <div onclick="editOrder()" class="header"> <i class="edit outline iconn"></i> 234234</div>
                                </div>
                            </a>
                            <a class="item">
                                <div class="content">
                                    <div onclick="editOrder()" class="header"> <i class="edit outline icon"></i> 234234</div>
                                </div>
                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <div class="ui bottom attached four item menu">

                <a class="item">
                    <div class="ui animated fade button basic orange" tabindex="0">
                        <div class="visible content"><i class="spinner loading icon"></i> Aktiv</div>
                        <div class="hidden content">
                            Gjør aktiv
                        </div>
                    </div>
                </a>
                <a class="item">

                    <div class="ui dropdown">
                        <i class="user icon"></i>
                        <div class="text">Velg sjåfør</div>
                        <i class="dropdown icon"></i>
                        <div class="menu">

                            <div class="item">
                                Thomas Røkke
                            </div>
                            <div class="item">
                                Hassan
                            </div>

                        </div>
                    </div>

                </a>
                <a class="item">

                    <div class="ui dropdown">
                        <i class="car icon"></i>
                        <div class="text">Velg bil</div>
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
                <a class="item"><i class="clock outline layout icon" ></i> 10:02 - </a>
            </div>
        </div>


    </div>

    <div class="ui section divider"></div>

    <div class="route-wrapper ui accordion">

        <h2 class="title"><i class="ui clock outline icon "></i>12:00</h2>


        <div class="content active">
            <div class="ui top attached five pointing menu ">
                <a class="item active">
                    10
                </a>
                <a class="item">
                    11
                </a>
                <a class="item">
                    12
                </a>
                <a class="item">
                    13
                </a>

                <div class="right menu">
                    <div class="item">
                        <div class="ui transparent icon input">
                            <input type="text" placeholder="Søk på ordrenummer...">
                            <i class="search link icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ui attached cards" style="margin:0 !important">

                <div class="card active" style="width:100%">
                    <div class="content">
                        <div class="header">Stovnerbrua Servicesenter <span style="color:grey; font-size:0.8em">500190</span>
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
        </span></div>

                        <!-- Set to active to display -->
                        <div class="ui list horizontal attached">
                            <a class="item">
                                <div class="content">
                                    <div onclick="editOrder()" class="header"> <i class="edit outline icon"></i> 234234</div>
                                </div>
                            </a>
                            <a class="item">
                                <div class="content">
                                    <div onclick="editOrder()" class="header"> <i class="edit outline icon"></i> 234234</div>
                                </div>
                            </a>
                            <a class="item">
                                <div class="content">
                                    <div onclick="editOrder()" class="header"> <i class="edit outline icon"></i> 234234</div>
                                </div>
                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <div class="ui bottom attached four item menu">

                <a class="item">
                    <div class="ui animated fade button basic" tabindex="0">
                        <div class="visible content"><i class="question icon"></i> Inaktiv</div>
                        <div class="hidden content">
                            Gjør aktiv
                        </div>
                    </div>
                </a>
                <a class="item">

                    <div class="ui dropdown">
                        <i class="user icon"></i>
                        <div class="text">Velg sjåfør</div>
                        <i class="dropdown icon"></i>
                        <div class="menu">

                            <div class="item">
                                Thomas Røkke
                            </div>
                            <div class="item">
                                Hassan
                            </div>

                        </div>
                    </div>

                </a>
                <a class="item">

                    <div class="ui dropdown">
                        <i class="car icon"></i>
                        <div class="text">Velg bil</div>
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
                <a class="item"><i class="clock outline layout icon" ></i>  </a>
            </div>
        </div>


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
        <div><i class="icon file outline"></i> <bold><span id="modal-header"></span></bold></div>
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
            Lagre endring
            <i class="checkmark icon"></i>
        </div>
    </div>
</div>


<footer style="margin-top:100px">
    <div class="ui inverted vertical footer segment">
        <div class="ui center aligned container">
            <div class="ui stackable inverted divided grid">
                <div class="three wide column">
                    <h4 class="ui inverted header">Group One</h4>
                    <div class="ui inverted link list">
                        <a href="#" class="item">Link One</a>
                        <a href="#" class="item">Link Two</a>
                    </div>
                </div>
                <div class="three wide column">
                    <h4 class="ui inverted header">Group Two</h4>
                    <div class="ui inverted link list">
                        <a href="#" class="item">Link One</a>
                        <a href="#" class="item">Link Two</a>
                    </div>
                </div>
                <div class="three wide column">
                    <h4 class="ui inverted header">Group Three</h4>
                    <div class="ui inverted link list">
                        <a href="#" class="item">Link One</a>
                        <a href="#" class="item">Link Two</a>
                    </div>
                </div>
                <div class="seven wide column">
                    <h4 class="ui inverted header">Mekodrive</h4>
                    <p>Som før, bare bedre.</p>
                </div>
            </div>
            <div class="ui inverted section divider"></div>
            <img src="https://www.mekonomen.no/Content/images/mekonomen-logo.svg" class="ui centered image">
            <div class="ui horizontal inverted small divided link list">
                <a class="item" href="#">Site Map</a>
                <a class="item" href="#">Contact Us</a>
                <a class="item" href="#">Terms and Conditions</a>
                <a class="item" href="#">Privacy Policy</a>
            </div>
            <div class="ui inverted section">
                <div class="ui horizontal inverted small divided link list">
                    <p class="love">Made with <i class="heart icon"></i>by <a class="item" href="http://klave.no">Sindre Klavestad</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>


<script type="text/javascript">


    $(document)
        .ready(function() {

            $(document).keydown(function(e){
                if (e.which == 40) {
                    //TODO: Create code to expand
                    console.log('down');
                    $(".ui.accordion.order").accordion('open', 0);
                    return false;
                }else if(e.which == 38){
                    $(".ui.accordion.order").accordion('close', 0);
                }
            });
            //Focus on page load
            $("#kundenummer").focus();


            $("#kundenummer").change(function(e){
                var val = e.target.value;
                $.ajax({url: "http://localhost:8000/getworkshopinfo?q="+val, success: function(response){

                        if(response.id > 0){
                            console.log(e.target);
                           $("#kundenummer").css("border-color", "green");
                            $("#kundenummer-label").text(response.name).show();


                        }else{
                            $("#kundenummer").css("border-color", "red");
                            $("#kundenummer-label").text("Det eksisterer ikke et verksted med det kundenummeret.").show();
                        }
                    }});
            });

            $('.ui.checkbox')
                .checkbox()
                .first().checkbox({
                onChecked: function() {
                    console.log('checked');
                   document.getElementById('sum').disabled = false;
                  $("#input-required-disabled").show().focus();
                },
                onUnchecked: function() {
                    console.log('unchecked');
                    document.getElementById('sum').disabled = true;
                    document.getElementById('sum').value = null;
                    $("#input-required-disabled").hide();
                },
                onEnable: function() {
                    console.log('onenable');
                },
                onDisable: function() {
                    console.log('ondisable');
                },
                onDeterminate: function() {
                    console.log('ondeterminate');
                },
                onIndeterminate: function() {
                    console.log('onindeterminate');
                },
                onChange: function() {
                    console.log('on change');
                }
            })
            ;
// bind events to buttons
            $('.callback.example .button')
                .on('click', function() {
                    $('.callback .checkbox').checkbox( $(this).data('method') );
                })
            ;


            $('.ui.search')
                .search({
                    type          : 'category',
                    minCharacters : 3,
                    apiSettings   : {
                        onResponse: function(githubResponse) {
                            var count = Object.keys(githubResponse).length;
                            console.log(count);
                            var
                                response = {
                                    results : {}
                                }
                            ;

                            for(var i = 0; i < count; i++){

                                var objectPart = githubResponse[i];

                                console.log(objectPart);
                                var
                                    language   = 'Verksted',
                                    maxResults = 8
                                ;
                                if(i >= maxResults) {
                                    alert('false');
                                    return false;
                                }
                                // create new language category
                                if(response.results[language] === undefined) {
                                    response.results[language] = {
                                        name    : language,
                                        results : []
                                    };
                                }
                                // add result to category
                                response.results[language].results.push({
                                    title       : objectPart.name,
                                    description : objectPart.description,
                                    url         : objectPart.html_url
                                });
                            }


                            return response;
                        },
                        url: '//localhost:8000/searchworkshops?q={query}'
                    }
                })
            ;


        })
    ;

</script>


</body>
</html>
