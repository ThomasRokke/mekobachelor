
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

        <p class="lead">Kmstand start: 5615631</p>
        <form method="get" action="{{ route('transport.route-report') }}">
            <div class="form-row">

                <div class="col-md-4 mb-3">
                    <label for="validationDefaultUsername" class="label-old">Kilometerstand.</label>
                    <div class="input-group">
                        <!-- TODO: Add functionality to set minimum and maximum length. -->
                        <input type="tel" name="kmend" min="5615631" max="5615831" value="5615" class="form-control input-old" id="validationDefaultUsername" autocomplete="off" placeholder="12312312" required="" oninvalid="this.setCustomValidity('Fyll inn riktig kilometstand.')" oninput="this.setCustomValidity('')">
                    </div>
                </div>

            </div>
            <button class="btn btn-danger btn-block btn-old" onclick="confirm('Ønsker du å avslutte ruten? Du kan IKKE angre!')" type="submit">Avslutt rute <i class="fa fa-check-square"></i></button>
        </form>



        <a href="https://testing123.frb.io/drivestart" class="btn btn-primary btn-block btn-old margin-top-15"><i class="fa fa-arrow-left"></i> Tilbake til rute </a>

    </div>

@endsection

@section('scripts')








@endsection
