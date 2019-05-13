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

        #example_filter{
            padding:5px !important;
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
                },
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
                ],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                'pageLength': 10,

            } );
        } );
    </script>
@endsection

@section('content')

    <main style="margin-bottom: 30vh; margin-top:20px">



            <div class="main-content">


                <h4 class="ui horizontal divider header clearing">
                    <i class="database icon"></i>
                    Datauthenting
                </h4>

                <table id="example" class="ui celled table" style="width:100%">
                    <thead>
                    <tr>



                        <th>Rute ID</th>
                        <th>Ordernummer</th>
                        <th>Kundenummer</th>
                        <th>Kundenavn</th>
                        <th>Rute</th>
                        <th>Dato</th>
                        <th>Tid</th>


                        <th>Kontant?</th>
                        <th>Sum</th>
                        <th>Levert</th>
                        <th>Leveringstid</th>
                        <th>Rute Km</th>


                        <th>Rute Startet tid</th>
                        <th>Rute Avsluttet tid</th>

                        <th>Driver ID</th>
                        <th>Driver</th>
                        <th>Lat</th>
                        <th>Lng</th>

                    </tr>
                    </thead>
                    <tbody>


                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->stop->route->id }}</td>
                            <td>{{ $order->ordernumber }}</td>
                            <td>{{ $order->workshop_id }}</td>
                            <td>{{ $order->stop->workshop->name }}</td>

                            <td>{{ $order->stop->route->route }}</td>
                            <td>{{ $order->stop->route->date }}</td>
                            <td>{{ $order->stop->route->time }}</td>

                            <td>{{ ($order->amount !== null) ? 1 : 0 }}</td>
                            <td>{{ $order->amount }}</td>
                            <td>{{ $order->delivered }}</td>
                            <td>{{ $order->stop->deliver_time }}</td>
                            <td>{{ $order->stop->route->kmend - $order->stop->route->kmstart }}</td>

                            <td>{{ $order->stop->route->started_time }}</td>
                            <td>{{ $order->stop->route->finished_time }}</td>

                            <td>{{ $order->stop->route->driver_id }}</td>
                            <td>{{ $order->stop->route->driver['name'] }}</td>


                            <td>{{ $order->stop->workshop->lat }}</td>
                            <td>{{ $order->stop->workshop->lng }}</td>




                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>

                        <th>Ordernummer</th>
                        <th>Kundenummer</th>
                        <th>Kundenavn</th>
                        <th>Rute</th>
                        <th>Dato</th>
                        <th>Tid</th>


                        <th>Kontant?</th>
                        <th>Sum</th>
                        <th>Levert</th>
                        <th>Leveringstid</th>
                        <th>Rute Km</th>


                        <th>Rute Startet tid</th>
                        <th>Rute Avsluttet tid</th>

                        <th>Driver ID</th>
                        <th>Driver</th>
                        <th>Lat</th>
                        <th>Lng</th>
                        <th>Rute ID</th>
                    </tr>
                    </tfoot>
                </table>


            </div>




    </main>

@endsection
