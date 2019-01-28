
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

        </div>

        <form method="POST" action="https://testing123.frb.io/setstartkm">
            <input type="hidden" name="_token" value="3ahIBRM2hZtOu1l1clWRiFXpCRCFR5j5RL9F0R1R">            <div class="form-row">

                <div class="col-md-4 mb-3">
                    <label for="validationDefaultUsername" class="label-old">Kilometerstand</label>
                    <div class="input-group">

                        <input name="kmstart" type="tel" autofocus="" class="form-control input-old" id="validationDefaultUsername" placeholder="12312312" autocomplete="off" required="" oninvalid="this.setCustomValidity('Fyll inn riktig kilometstand.')" oninput="this.setCustomValidity('')">
                        <input type="hidden" name="routeid" value="3">
                    </div>
                </div>

            </div>
            <button class="btn btn-primary btn-block btn-old" type="submit">Gå videre til kjørelisten <i class="fa fa-arrow-right"></i></button>
        </form>
    </div>

@endsection

@section('scripts')








@endsection
