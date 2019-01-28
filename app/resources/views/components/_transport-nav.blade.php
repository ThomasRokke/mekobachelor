<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">


        <a class="navbar-brand" href="{{ route('transport.home') }}">Mekodrive</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::segment(1) === 'proto' ? 'active' : null }}">
                    <a class="nav-link" href="{{ route('transport.home') }}">Hjem <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item {{ (Request::segment(1) === 'drive'||(Request::segment(1) === 'drivestart')) ? 'active' : null }}">
                    <a class="nav-link" href="{{ route('transport.route-preview') }}">Se rute <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item {{ (Request::segment(1) === 'drive'||(Request::segment(1) === 'drivestart')) ? 'active' : null }}">
                    <a class="nav-link" href="{{ route('transport.route-startkm') }}">Start km <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item {{ (Request::segment(1) === 'drive'||(Request::segment(1) === 'drivestart')) ? 'active' : null }}">
                    <a class="nav-link" href="{{ route('transport.route-drive') }}">Rute <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item {{ (Request::segment(1) === 'drive'||(Request::segment(1) === 'drivestart')) ? 'active' : null }}">
                    <a class="nav-link" href="{{ route('transport.route-endkm') }}">Slutt km  <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item {{ (Request::segment(1) === 'drive'||(Request::segment(1) === 'drivestart')) ? 'active' : null }}">
                    <a class="nav-link" href="{{ route('transport.route-report') }}">Rapport  <span class="sr-only">(current)</span></a>
                </li>


            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Ordrenummer" aria-label="Search">
                <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Søk</button>
            </form>
        </div>
    </div>
</nav>