@extends('layouts.office')



@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Opprett verksted</h1>
                <br>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif



                <form  method="post" action="">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationServer01">Kundenummer</label>
                            <input autofocus type="text" class="form-control " id="validationServer01" placeholder="Kundenummer" value="{{ old('workshop_id') }}" name="workshop_id" required>
                            <div class="valid-feedback">
                                Ser bra ut!
                            </div>
                            <div class="invalid-feedback">
                                Kundenummeret er tatt fra før.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationServer02">Firmanavn</label>
                            <input type="text" class="form-control " id="validationServer02" placeholder="Firmanavn" name="name" value="{{ old('name') }}" required>
                            <div class="valid-feedback">
                                Ser bra ut!
                            </div>
                            <div class="invalid-feedback">
                                Feilmelding.
                            </div>
                        </div>

                    </div>
                    <div class="form-group  ">
                        <label class="control-label required " for="from"> Pickup location</label>
                        <div class="input-group">
                            <input id="from" name="from" value="" type="text" placeholder="Thief Tjuvholmen, Oslo"  class="form-control" required autocomplete="off" >

                        </div>
                        <div id="fromAdr"> </div>
                        <div id="fromDelete"  style="margin-top:10px; display: none" onclick="deleteFrom()" class="btn btn-sm btn-default"><i class="fa fa-lg fa-trash"></i> Remove selection</div>

                        <input type="hidden" name="fromID" id="fromID" value="">
                        <input type="hidden" name="adr" id="adr" value="">
                        <input type="hidden" name="lat" id="lat" value="">
                        <input type="hidden" name="lng" id="lng" value="">

                    </div>


                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">

                        <div class="list-group" id="fromAppend">

                        </div>
                    </div>

                <!--<div class="form-row">


                        <div class="col-md-6 mb-3">
                            <label for="validationServer04">Lat</label>
                            <input type="text" class="form-control " id="validationServer04" placeholder="lat" name="lat" value="{{ old('lat') }}" required>
                            <div class="valid-feedback">
                                Ser bra ut!
                            </div>
                            <div class="invalid-feedback">
                                Feilmelding.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationServer05">Long</label>
                            <input type="text" class="form-control " id="validationServer05" placeholder="lng" name="lng" value="{{ old('lng') }}" required>
                            <div class="valid-feedback">
                                Ser bra ut!
                            </div>
                            <div class="invalid-feedback">
                                Feilmelding.
                            </div>
                        </div>
                    </div>-->
                    <hr>
                    <button class="btn btn-outline-meko btn-block" type="submit">Registrer verksted</button>
                </form>
                <hr>
            </div>
        </div>
    </div>



@endsection

@section('scripts')

    <script type="text/javascript" src="{{ asset('js/googleplacesapi.js') }}"></script>

    <script type="text/javascript">
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
