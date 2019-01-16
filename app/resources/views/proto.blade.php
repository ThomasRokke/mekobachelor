@extends('layouts.proto')

@section('header-resources')

@endsection



@section('content')
    <div class="container">

        <div class="jumbotron">
            <h1 class="display-6">God dag, Thomas</h1>
           <hr class="my-4">
           <p class="lead">Du skal kjøre rute <strong>15</strong> klokken <strong>10:00</strong></p>
            <a class="btn btn-primary btn-lg" href="{{ route('drive') }}" role="button">Se kjøreliste</a>
        </div>

    </div>

@endsection

@section('scripts')

    <script>
        //check if jquery is loaded
        window.onload = function() {
            if (window.jQuery) {
                // jQuery is loaded
                //alert("Yeah!");
            } else {
                // jQuery is not loaded
                alert("Jquery is not loaded");
            }
        }
    </script>

@endsection
