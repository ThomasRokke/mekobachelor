@extends('layouts.office')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table">
                    <thead class="meko-default">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Navn</th>
                        <th scope="col">Epost</th>

                        <th scope="col">Rolle</th>
                        <th scope="col"></th>

                    </tr>
                    </thead>
                    <tbody>

                        @foreach($users as $user)

                            @php
                                $role = '';

                                $level = $user->level();

                               switch ($level) {
                                case 1:
                                    $role = 'User';
                                    break;
                                 case 3:
                                    $role = 'Office';
                                    break;
                                case 5:
                                $role = 'Admin';
                                break;

                                default:
                                    $role = 'unkown';
                               }



                            @endphp
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $role }}</td>
                            <td><div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <a href="" class="dropdown-item"><i class="fa fa-eye"></i>Vis bruker</a>
                                        <a href="{{ route('office.edituser', ['id' => $user->id]) }}"  class="dropdown-item {{ (Auth::user()->level() < 4) ? 'disabled' : ''  }}"><i class="fa fa-edit"></i>Rediger bruker</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach






                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
