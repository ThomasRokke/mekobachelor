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

            <a href="{{ route('drivestart') }}" class="btn btn-success btn-block btn-lg">START KJØRING</a>
            <hr>

            <div id="accordion">

                <div class="card  ">
                    <div class="card-header ">


                        
                        <a class="collapsed card-link  btn  " data-toggle="collapse" href="#collapseOne">
                            Kvickstop strømmen
                        </a>

                        <div class="float-right align-middle"><i class="fa fa-file fa-lg align-middle " onclick="confirm('Har du levert alle ordre?')"></i>
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


                <div class="card  ">
                    <div class="card-header ">


                        
                        <a class="collapsed card-link  btn  " data-toggle="collapse" href="#collapseTwo">
                            Stovnerbrua servicesenter
                        </a>

                        <div class="float-right align-middle"><i class="fa fa-file fa-lg align-middle " onclick="confirm('Har du levert alle ordre?')"></i>
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

                <div class="card  ">
                    <div class="card-header ">


                  
                        <a class="collapsed card-link  btn  " data-toggle="collapse" href="#collapseThree">
                            Mekonomen Lillestrøm
                        </a>

                        <div class="float-right align-middle"><i class="fa fa-file fa-lg align-middle " onclick="confirm('Har du levert alle ordre?')"></i>
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

                <div class="card  ">
                    <div class="card-header ">


                  
                        <a class="collapsed card-link  btn  " data-toggle="collapse" href="#collapseFour">
                            Bergersen Bil
                        </a>

                        <div class="float-right align-middle"><i class="fa fa-file fa-lg align-middle " onclick="confirm('Har du levert alle ordre?')"></i>
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
    </script>

@endsection
