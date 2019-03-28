@extends('layouts.auth')

@section('header')
    <style type="text/css">
        body {
            background-image: url("https://www.mjosbil.no/ep_bilder/5/413-68f19b5a1338d9debdbe4bf19c66a095.jpeg");
            background-color: #cccccc;

            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            height: 100%;
            width: 100%;
        }
        body > .grid {
            height: 100%;
        }

        .column-spesific {
            max-width: 450px;
        }
    </style>
    <script>
        $(document)
            .ready(function() {
                $('.ui.form')
                    .form({
                        fields: {
                            email: {
                                identifier  : 'email',
                                rules: [
                                    {
                                        type   : 'empty',
                                        prompt : 'Please enter your e-mail'
                                    },
                                    {
                                        type   : 'email',
                                        prompt : 'Please enter a valid e-mail'
                                    }
                                ]
                            },
                            password: {
                                identifier  : 'password',
                                rules: [
                                    {
                                        type   : 'empty',
                                        prompt : 'Please enter your password'
                                    },
                                    {
                                        type   : 'length[6]',
                                        prompt : 'Your password must be at least 6 characters'
                                    }
                                ]
                            }
                        }
                    })
                ;
            })
        ;
    </script>
@endsection

@section('content')

    <div class="ui middle aligned center aligned grid" style="margin-top:50px">
        <div class="column column-spesific" style="margin:15px !important;">
            <h2 class="ui image header">
                <div class="content" style="color:white">
                    Logg inn på din bruker
                </div>
            </h2>
            @if ($errors->any())

                <div class="ui error message">
                    <i class="close icon"></i>
                    <div class="header">
                        Feilmelding:
                    </div>
                    <ul class="list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}" class="ui large form">
                @csrf

                <div class="ui stacked segment">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input type="text" name="email" placeholder="E-post adresse">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="password" placeholder="Passord">
                        </div>
                    </div>
                    <input type="submit" value="Logg inn" class="ui fluid large  submit button">
                </div>

                <div class="ui error message"></div>

            </form>

            <div class="ui message">
                Ny bruker? <a href="{{ route('register') }}">Registrer bruker</a>
            </div>
            <div class="ui message">
                Glemt passord? <a href="{{ route('password.request') }}">Tilbakestill passord</a>
            </div>

        </div>
    </div>

@endsection

