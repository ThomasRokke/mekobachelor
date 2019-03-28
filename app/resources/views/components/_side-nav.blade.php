<!-- Sidenav-->
<div id="sidenav" class="ui left demo inverted visible overlay  vertical  sidebar labeled icon menu ">
    <a href="{{ route('home') }}" class="item {{ \Request::is('home') ? 'active' : null }}" style="margin-top:42.85px">
        <i class="home icon"></i> Hjem
    </a>

    @if(Auth::check() && Auth::user()->level() >= 2)


    <a href="{{ route('routes') }}" class="item {{ \Request::is('routes') ? 'active' : null }}">
        <i class="table layout icon a"></i> Ruter
    </a>
    <a href="{{ route('proto.protoworkshop') }}" class="item {{ \Request::is('workshops') ? 'active' : null }}">
        <i class="wrench icon"></i> Verksteder
    </a>

    <a href="{{ route('routetimes') }}" class="item {{ \Request::is('routetimes') ? 'active' : null }}">
        <i class="clock icon"></i> Rutetider
    </a>

    <a href="{{ route('prioritize') }}" class="item {{ \Request::is('prioritize') ? 'active' : null }}">
        <i class="sort numeric down icon"></i> Prioriter
    </a>

    <a href="{{ route('dashboard') }}" class="item {{ \Request::is('dashboard') ? 'active' : null }}">
        <i class="chart line icon"></i> Statistikk
    </a>

    <a href="{{ route('proto.protoroles') }}" class="item {{ \Request::is('users') ? 'active' : null }}">
        <i class="users icon"></i> Brukere
    </a>


    <a href="{{ route('dataexport') }}" class="item {{ \Request::is('dataexport') ? 'active' : null }}">
        <i class="database icon"></i> Data
    </a>

    @endif


    <a href="{{ route('myprofile') }} " class="item {{ \Request::is('myprofile') ? 'active' : null }}">
        <i class="user icon"></i> Min profil
    </a>

    <a class="item" href="{{ route('logout') }}"
       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>



</div>
<!--End sidenav-->