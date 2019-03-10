<!-- Sidenav-->
<div id="sidenav" class="ui left demo inverted visible overlay  vertical  sidebar labeled icon menu ">
    <a href="{{ route('home') }}" class="item {{ \Request::is('home') ? 'active' : null }}" style="margin-top:42.85px">
        <i class="home icon"></i> Hjem
    </a>

    <a href="{{ route('proto.prototest') }}" class="item {{ \Request::is('prototest') ? 'active' : null }}">
        <i class="table layout icon a"></i> Ruter
    </a>
    <a href="{{ route('proto.protoworkshop') }}" class="item {{ \Request::is('protoworkshops') ? 'active' : null }}">
        <i class="wrench icon"></i> Verksteder
    </a>

    <a href="{{ route('routetimes') }}" class="item {{ \Request::is('routetimes') ? 'active' : null }}">
        <i class="clock icon"></i> Rutetider
    </a>

    <a href="{{ route('getmap') }}" class="item {{ \Request::is('map') ? 'active' : null }}">
        <i class="chart line icon"></i> Statistikk
    </a>

    <a href="{{ route('proto.protoroles') }}" class="item {{ \Request::is('protoroles') ? 'active' : null }}">
        <i class="users icon"></i> Brukere
    </a>


    <a href="{{ route('getorders') }}" class="item {{ \Request::is('orders') ? 'active' : null }}">
        <i class="database icon"></i> Data
    </a>



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