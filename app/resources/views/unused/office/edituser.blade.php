@extends('layouts.office')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header meko-default">{{ __('Rediger bruker') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('office.storeedituser') }}">
                            @csrf

                            <input type="hidden" name="userid" value="{{ (!empty(old('userid'))) ? old('userid') : $user->id  }}">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ (!empty(old('name'))) ? old('name') : $user->name  }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ (!empty(old('email'))) ? old('email') : $user->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                                <div class="col-md-6">
                                    <select class="custom-select" id="inputGroupSelect01" name="role">
                                        <option @if($user->level() === 1) selected @endif  value="3">User</option>
                                        <option @if($user->level() === 3) selected @endif value="2">Office</option>
                                        <option @if($user->level() === 5) selected @endif value="1">Admin</option>
                                    </select>

                                    @if ($errors->has('role'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-outline-meko">
                                        {{ __('Lagre endringer') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
