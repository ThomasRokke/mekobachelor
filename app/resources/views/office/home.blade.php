@extends('layouts.office')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header meko-default">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Du er logget inn på Kontor delen av systemet
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
