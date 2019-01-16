@extends('layouts.proto')

@section('header-resources')

@endsection



@section('content')
    <div class="container animated  ">
        <a class="weatherwidget-io" href="https://forecast7.com/no/59d9110d75/oslo/" data-label_1="OSLO" >OSLO</a>


        <div class="jumbotron" style="background-color:white">
            <p class="lead text-center typed-size"> <span id="typed"></span></p>
            <input type="hidden" id="name" value="Thomas">
           <hr class="my-4">
           <p class="lead text-center">Du skal kjøre rute <strong>15</strong> klokken <strong>10:00</strong></p>
            <a class="btn btn-primary btn-lg btn-block" href="{{ route('drive') }}" role="button">Se kjøreliste</a>
        </div>



        <a class="twitter-timeline" data-lang="no" data-dnt="true" data-theme="light" href="https://twitter.com/NRKTrafikkOslo?ref_src=twsrc%5Etfw">Tweets by NRKTrafikkOslo</a>

    </div>

@endsection

@section('scripts')


    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.9"></script>


    <script>
        $( document ).ready(function() {

            $(".timeline-Tweet").removeData("click-to-open-target");
        });
    </script>

    <script type="text/javascript">


        var name = document.getElementById('name').value;


        var options = {
            strings: ["God dag, "+name+"."],
            typeSpeed: 25,
            backSpeed: 15,
            backDelay: 1000,
            startDelay: 2000,
            showCursor: true,
            loop: false
        }

        var typed = new Typed("#typed", options);
    </script>

    <script>
        ! function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (!d.getElementById(id)) {
                js = d.createElement(s);
                js.id = id;
                js.src = 'https://weatherwidget.io/js/widget.min.js';
                fjs.parentNode.insertBefore(js, fjs);
            }
        }(document, 'script', 'weatherwidget-io-js');
    </script>
    <script>
        //check if jquery is loaded
        window.onload = function() {

        $(".weatherwidget-io").delay(8000).show("slow");

            if (window.jQuery) {
                // jQuery is loaded
                //alert("Yeah!");
            } else {
                // jQuery is not loaded
                alert("Jquery is not loaded");
            }
        }
    </script>

    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>



@endsection
