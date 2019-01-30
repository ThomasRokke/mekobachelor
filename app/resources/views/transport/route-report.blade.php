@extends('layouts.main')

@section('header-resources')


    <style>
        .card{
            margin: 0px 10px 10px 0px;
        }

        .card-header{
            padding: 5px 10px 5px 10px !important;
        }
    </style>
@endsection




@section('content')
    <div class="container">

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

        <a href="{{ route('home') }}" class="btn btn-primary btn-block">Til hjemsiden</a>
    </div>
@endsection

@section('scripts')








@endsection
