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
                <p class="lead text-center">Du skal kjøre rute <strong>12</strong> klokken <strong>10:00</strong></p>

                <hr>

                <a href="{{ route('transport.route-startkm') }}" class="btn btn-block btn-outline-meko">Se kjøreliste</a>
            </div>
        </div>

    </div>

@endsection

@section('scripts')








@endsection
