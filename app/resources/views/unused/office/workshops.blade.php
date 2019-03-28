@extends('layouts.office')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Verksteder  <a href="{{ route('office.workshops.create') }}" class="btn btn-outline-meko btn-sm">Opprett nytt verksted <i class="fa fa-plus"></i></a></h1>


                <br>






                <table class="table">
                    <thead class="meko-default">
                    <tr>
                        <th scope="col">Kundenummer</th>
                        <th scope="col">Rute</th>
                        <th scope="col">Navn</th>
                        <th scope="col">Addresse</th>
                        <th scope="col">lat</th>
                        <th scope="col">lng</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($workshops as $w)

                        <tr>
                            <th scope="row">{{ $w->workshop_id }}</th>
                            <td>{{ (!empty($w->route)) ? $w->route : 12 }}</td>
                            <td>{{ $w->name }}</td>
                            <td>{{ (!empty($w->adr)) ? $w->adr : 'unknown' }}</td>
                            <td>{{ (!empty($w->lat)) ? $w->lat : 'unknown' }}</td>
                            <td>{{ (!empty($w->lng)) ? $w->lng : 'unknown' }}</td>
                            <td><div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <button class="dropdown-item" type="button"><i class="fa fa-edit text-warning"></i> Rediger</button>
                                        <button class="dropdown-item" type="button"><i class="fa fa-trash text-danger"></i> Slett</button>
                                        <button class="dropdown-item" type="button"><i class="fa fa-eye text-primary"></i> Vis mer</button>
                                    </div>
                                </div></td>


                        </tr>



                    @endforeach


                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
