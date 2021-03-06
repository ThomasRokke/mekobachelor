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

        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Hei, {{ \Illuminate\Support\Facades\Auth::user()->name }}</h1>



                @if(!empty($route))
                    @foreach($route as $r)
                    <p class="lead text-center animated fadeIn">Du skal kjøre rute <strong>{{ $r->route }}</strong> klokken <strong>{{ $r->time }}</strong></p>
                    <a id="pulse-btn" class="btn btn-outline-meko btn-lg btn-block animated flipInX btn-old"  href="{{ route('transport.route-preview') }}" role="button">Se kjøreliste</a>
                    @endforeach
                @else
                    <p class="lead text-center animated fadeIn">Du har <strong>ingen</strong> aktive ruter.</p>
                @endif


            </div>
        </div>

    </div>

@endsection

@section('scripts')








@endsection
