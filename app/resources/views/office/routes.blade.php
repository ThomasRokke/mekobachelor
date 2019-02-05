@extends('layouts.office')


@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Kjørekontoret</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('office.postroute') }}">
                    @csrf
                    <div class="form-row">

                        <div class="col-md-3 mb-3">
                            <label for="workshop_id" class="label-old">Kundenummer</label>
                            <div class="input-group input-group-lg">

                                <input autofocus type="text"  class="form-control" id="workshop_id" name="workshop_id" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fa fa-check-square text-success"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="ordernumber" class="label-old">Ordrenummer</label>
                            <div class="input-group input-group-lg">

                                <input type="text" class="form-control" name="ordernumber" id="ordernumber" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fa fa-check-square text-success"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="ordernumber" class="label-old">Rute</label>
                            <div class="input-group input-group-lg">

                                <input type="number" class="form-control" name="route" id="route" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fa fa-check-square text-success"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label style="color:white;" for="ordernumber" class="label-old">Registrer</label>
                            <div class="input-group input-group-lg">

                                <input type="submit" value="Registrer ordre" class="form-control" id="ordernumber" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">

                            </div>
                        </div>





                    </div>
                </form>






            </div><!-- End col -->

            <div class="col-md-12">
                <h1 class="text-center">Dagens ruter</h1>



                    <table class="table">
                        <thead class="meko-default">
                        <tr>
                            <th scope="col">Dato</th>
                            <th scope="col">Rute</th>
                            <th scope="col">Tid</th>

                            <th scope="col">Sjåfør</th>
                            <th scope="col">Aktiv status</th>
                            <th scope="col">Optimer </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($routes as $w)

                            <tr>
                                <th scope="row">{{ $w->date }}</th>
                                <td>{{ $w->route }}</td>
                                <td>{{ $w->time }}</td>


                                <td><div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ (!empty($w->driver)) ? $w->driver->name : 'Ikke valgt' }}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            @foreach($users as $user)
                                                <a href="{{ route('setdriver', ['route_id' => $w->id, 'driver_id' => $user->id]) }}" class="dropdown-item">{{ $user->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    @if($w->active === 1)
                                        <a href="{{ route('setinactive', ['route_id' => $w->id]) }}" class="btn btn-success">JA</a>

                                    @else
                                        <a href="{{ route('setactive', ['route_id' => $w->id]) }}" class="btn btn-warning">NEI</a>
                                    @endif
                                </td>
                                <td> <a href="{{ route('optimize', ['route_id' => $w->id]) }}" class="btn btn-warning">Optimer</a></td>


                            </tr>


                            @foreach($w->stops as $s)
                                <tr data-toggle="collapse" href="#collapseExample{{ $s->id }}" role="button" aria-expanded="false" aria-controls="collapseExample{{ $s->id }}">
                                    <th scope="row">{{ $s->workshop->name }}</th>
                                    <td>{{ $s->workshop_id }}</td>
                                    <td>{{ $s->route_position }}</td>


                                </tr>




                                  <tr>
                                      <th scope="row" style="    border-top: none!important;">
                                          <div class="collapse" id="collapseExample{{ $s->id }}">
                                              <ul class="list-group">
                                                  @foreach($s->orders as $o)
                                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                                      {{ $o->ordernumber }}
                                                      @if($o->delivered === 1)<span class="badge badge-success badge-pill"> <i class="fa fa-check-square text-white"></i>  </span>@else
                                                          <span class="badge badge-primary badge-pill"><i class="fa fa-ban text-warning"></i></span>
                                                      @endif

                                                  </li>
                                                  @endforeach

                                              </ul>
                                          </div>
                                      </th>

                                 </tr>

                            @endforeach



                        @endforeach


                        </tbody>
                    </table>






            </div>
        </div><!-- end row -->
    </div><!-- end container-->



@endsection

