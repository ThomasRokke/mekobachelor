@extends('layouts.proto')

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
            <h3 class="text-center">Rute <strong>15</strong> klokken <strong>10:00</strong></h3>

            <div class="btn btn-danger btn-block btn-lg" onclick="alert('kjøring har blitt stopped')">STOPP KJØRING</div>
            <hr>

            <div id="accordion">

                <div id="wrapper-1" class="card text-white bg-secondary">
                    <div class="card-header ">

                        <i id="icon-1-undo" style="display: none" class="fa fa-undo fa-2x align-middle text-white" onclick="if(confirm('Sikker på at du ønsker å angre?')){undoFinished(1)}"></i>

                        <i id="icon-1-check" class="fa fa-check-square fa-2x align-middle text-white" onclick="if(confirm('Har du levert alle ordre?')){setFinished(1)}"></i>
                        <a class="collapsed card-link  btn text-white " data-toggle="collapse" href="#collapseOne">
                            Kvickstop strømmen
                        </a>

                        <div class="float-right align-middle"><i class="fa fa-file fa-lg align-middle text-white" onclick="confirm('Har du levert alle ordre?')"></i>
                            3</div>

                    </div>
                    <div id="collapseOne" class="collapse" data-parent="#accordion">
                        <div class="card-body">

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8243242
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8238482
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" checked id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8234823
                                </label>
                            </div>



                        </div>
                    </div>
                </div>


                <div id="wrapper-2" class="card text-white bg-secondary">
                    <div class="card-header ">


                        <i id="icon-2-undo" style="display: none" class="fa fa-undo fa-2x align-middle text-white" onclick="if(confirm('Har du levert alle ordre?')){undoFinished(2)}"></i>
                        <i id="icon-2-check" class="fa fa-check-square fa-2x align-middle text-white" onclick="if(confirm('Har du levert alle ordre?')){setFinished(2)}"></i>
                        <a class="collapsed card-link  btn text-white " data-toggle="collapse" href="#collapseTwo">
                            Stovnerbrua servicesenter
                        </a>

                        <div class="float-right align-middle"><i class="fa fa-file fa-lg align-middle text-white" onclick="confirm('Har du levert alle ordre?')"></i>
                            1</div>

                    </div>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">


                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" checked id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8234823
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="wrapper-3" class="card text-white bg-secondary">
                    <div class="card-header ">

                        <i id="icon-3-undo" style="display: none" class="fa fa-undo fa-2x align-middle text-white" onclick="if(confirm('Sikker på at du ønsker å angre?')){undoFinished(3)}"></i>

                        <i id="icon-3-check" class="fa fa-check-square fa-2x align-middle text-white" onclick="if(confirm('Har du levert alle ordre?')){setFinished(3)}"></i>
                        <a class="collapsed card-link  btn text-white " data-toggle="collapse" href="#collapseThree">
                            Mekonomen Lillestrøm
                        </a>

                        <div class="float-right align-middle"><i class="fa fa-file fa-lg align-middle text-white" onclick="confirm('Har du levert alle ordre?')"></i>
                            4</div>

                    </div>
                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body">


                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" checked id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8234823
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" checked id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8234823
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" checked id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8234823
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" checked id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8234823
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="wrapper-4" class="card text-white bg-secondary">
                    <div class="card-header ">

                        <i id="icon-4-undo" style="display: none" class="fa fa-undo fa-2x align-middle text-white" onclick="if(confirm('Sikker på at du ønsker å angre?')){undoFinished(4gi)}"></i>

                        <i id="icon-4-check" class="fa fa-check-square fa-2x align-middle text-white" onclick="if(confirm('Har du levert alle ordre?')){setFinished(4)}"></i>
                        <a class="collapsed card-link  btn text-white " data-toggle="collapse" href="#collapseFour">
                            Bergersen Bil
                        </a>

                        <div class="float-right align-middle"><i class="fa fa-file fa-lg align-middle text-white" onclick="confirm('Har du levert alle ordre?')"></i>
                            2</div>

                    </div>
                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                        <div class="card-body">


                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" checked id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8234823
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" checked id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    8212313
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
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

        function setFinished(e){


            var wrapper = document.getElementById('wrapper-'+e);

            wrapper.classList.remove("bg-secondary");

            wrapper.classList.add("bg-success");

            document.getElementById('icon-'+e+'-check').style.display = "none";
            document.getElementById('icon-'+e+'-undo').style.display = "inline-block";



        }
        function undoFinished(e){


            var wrapper = document.getElementById('wrapper-'+e);

            wrapper.classList.remove("bg-success");

            wrapper.classList.add("bg-secondary");

            document.getElementById('icon-'+e+'-check').style.display = "inline-block";
            document.getElementById('icon-'+e+'-undo').style.display = "none";



        }
    </script>

@endsection
