@extends('layouts.semantic')

@section('header')

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous">
    </script>

    <style>
        #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
        #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
        #sortable li span { position: absolute; margin-left: -1.3em; }

        #sortable{
            font-size: 1.4em;

        }
    </style>


    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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

    <main style="margin-bottom: 30vh;">

        <div class="ui container" style="margin-top:50px">

            <div class="ui five item menu">
                <a href="{{ route('prioritize', ['route' => 10]) }}" class="item {{ ($route === "10") ? 'active' :''  }}">Rute 10</a>
                <a href="{{ route('prioritize', ['route' => 11]) }}" class="item {{ ($route === "11") ? 'active' :''  }}">Rute 11</a>
                <a href="{{ route('prioritize', ['route' => 12]) }}" class="item {{ ($route === "12") ? 'active' :''  }}">Rute 12</a>
                <a href="{{ route('prioritize', ['route' => 13]) }}" class="item {{ ($route === "13") ? 'active' :''  }}">Rute 13</a>
                <a href="{{ route('prioritize', ['route' => 14]) }}" class="item {{ ($route === "14") ? 'active' :''  }}">Rute 14</a>
            </div>


            <div class="ui grid">
                <div class="six wide column">
                    <h2>Ikke prioritert</h2>
                    <div class="ui divider"></div>
                    <div class="ui celled list">
                        @foreach($workshops as $w)
                        <div class="item">
                            <img data-name="{{ $w->name }}" data-wid="{{ $w->workshop_id }}" class="ui avatar image add-to-list right floated" src="https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/add-circle-green-512.png">

                            <div class="content">
                                <div class="header">{{ $w->name }}</div>
                                {{ $w->workshop_id }}
                            </div>

                        </div>

                        @endforeach

                    </div>
                </div>
                <div class="ten wide column">
                    <h2>Prioritert</h2>
                    <div class="ui divider"></div>

                    <form method="POST" action="{{ route('priopost') }}">
                        @csrf
                        <div class="ui divided list" id="sortable" style="width: 100%!important;"></div>

                        <div class="ui divider"></div>
                        <input type="hidden" name="route" value="{{ $route }}">
                        <button class="ui button right floated positive" type="submit">Lagre endringer</button>
                    </form>

                </div>
            </div>




        </div>



    </main>

@endsection


@section('bottom-scripts')
    <script>

        $( function() {


            var names = [
                @foreach($prio as $p)
                ['{{ $p->name }}', '{{ $p->workshop_id }}'],
                @endforeach
            ];

            function init(){
                var sortableWrapper = $("#sortable");


                sortableWrapper.empty();

                for(var i = 0; i < names.length; i++){
                    sortableWrapper.append('<div class="ui-state-default item" data-wid="'+names[i][1]+'" data-name="'+names[i][0]+'">'+(i + 1)+" - "+names[i][0]+'<input name="'+names[i][1]+'" value="'+(i +1)+'" type="hidden">  <div class="right floated content">\n' +
                        '      <div class="ui button negative tiny remove" data-name2="'+names[i][0]+'" data-wid2="'+names[i][1]+'"><i  class="icon delete"></i></div>\n' +
                        '    </div></div>');
                }
                sortableWrapper.sortable({
                    update: function( event, ui ) {
                        $("#sortable div").each(function() {
                            $(this).html(''); //empty previous
                            var index = $(this).index();
                            var wid = $(this).data('wid');
                            var name = $(this).data('name');
                            $(this).html('<div class="ui-state-default item" data-wid="'+wid+'" data-name="'+name+'">'+(index +1)+" - "+name+'<input name="'+wid+'" value="'+(index +1)+'" type="hidden">  <div class="right floated content">\n' +
                                '      <div class="ui button negative tiny remove" data-name2="'+name+'" data-wid2="'+wid+'"><i  class="icon delete"></i></div>\n' +
                                '    </div></div>');

                        });
                        $(".remove").bind('click', function(e) {
                            var name = $(this).data('name2');
                            var wid = $(this).data('wid2');

                            console.log('clicked on remove');

                            for(var i = 0; i < names.length; i++) {
                                console.log(names[i][1]);
                                console.log(wid);
                                if(names[i][1] == wid) {

                                    names.splice(i, 1);
                                    break;
                                }
                            }
                            console.log(names);
                            init();
                        });
                    }
                });
                sortableWrapper.disableSelection();

                $(".remove").bind('click', function(e) {
                    var name = $(this).data('name2');
                    var wid = $(this).data('wid2');

                    console.log('clicked on remove');

                    for(var i = 0; i < names.length; i++) {
                        console.log(names[i][1]);
                        console.log(wid);
                        if(names[i][1] == wid) {

                            names.splice(i, 1);
                            break;
                        }
                    }
                    console.log(names);
                    init();
                });
            }



            init(); //Init the code.



            $(".add-to-list").click(function(){

                var name = $(this).data('name');
                var wid = $(this).data('wid');

                var found = false;
                for(var i = 0; i < names.length; i++) {
                    console.log(names[i][1]);
                    console.log(wid);
                    if(names[i][1] == wid) {
                        found = true;
                        break;
                    }
                }

                if(!found){
                    names.push([name, wid]) ; //Add new content to array with index the same as previous length.


                }else{
                    alert('Du har allerede lagt til '+name+ ' i den prioriterte listen');
                }


                init();
            });






        });


    </script>
@endsection
