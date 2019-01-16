@extends('layouts.proto')

@section('header-resources')

@endsection



@section('content')
    <div class="container">
        <a class="weatherwidget-io" href="https://forecast7.com/no/59d9110d75/oslo/" data-label_1="OSLO" data-label_2="VÆRMELDING" data-theme="original" >OSLO VÆRMELDING</a>
        <script>
            !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
        </script>

        <div class="jumbotron" style="background-color:white">
            <h1 class="display-6">God dag, Thomas</h1>
           <hr class="my-4">
           <p class="lead">Du skal kjøre rute <strong>15</strong> klokken <strong>10:00</strong></p>
            <a class="btn btn-primary btn-lg" href="{{ route('drive') }}" role="button">Se kjøreliste</a>
        </div>



        <a class="twitter-timeline" href="https://twitter.com/NRKTrafikkOslo?ref_src=twsrc%5Etfw">Tweets by NRKTrafikkOslo</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

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
