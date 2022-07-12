<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <img src="{{ asset('assets/img/logo.png') }}" alt="logo" width="75">
            <b>User<b>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admindashboard') }}">SSM</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="active"><a class="nav-link" href="{{ route('userdashboard') }}"><i
                        class="fas fa-fire"></i> <span>Dashboard</span></a></li>
            <li class="menu-header">Jalur Kabel</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-map"></i>
                    <span>Area</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link beep beep-sidebar"
                            href="{{ route('user.jalur.mojogedang') }}">Mojogedang</a>
                    </li>
                    <li><a class="nav-link beep beep-sidebar" href="">Mojolaban</a>
                    </li>
                    <li><a class="nav-link beep beep-sidebar" href="layout-top-navigation.html">Palur</a></li>
                    <li><a class="nav-link beep beep-sidebar" href="{{ route('user.jalur.asmil') }}">Asmil 413</a>
                    </li>
                    <li><a class="nav-link beep beep-sidebar" href="">Kopasus Kartasuro</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Maps</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-map-pin"></i>
                    <span>Maps</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link beep beep-sidebar" href="{{ route('user.olt.index') }}">OLT</a>
                    </li>
                    <li><a class="nav-link beep beep-sidebar" href="{{ route('user.odc.index') }}">ODC</a>
                    </li>
                    <li><a class="nav-link beep beep-sidebar" href="{{ route('user.odp.index') }}">ODP</a></li>
                </ul>
            </li>

            <li class="menu-header">Graph</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-chart-bar"></i>
                    <span>Graph</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link beep beep-sidebar" href="{{ route('user.graph.odc') }}">ODC</a></li>
                    <li><a class="nav-link beep beep-sidebar" href="{{ route('user.graph.odp') }}">ODP</a></li>

                </ul>
            </li>
            <li class="menu-header">Logout</li>
            <li class="active"><a class="nav-link" href="{{ route('logout') }}"><i
                        class="fas fa-door-open"></i>
                    <span>Logout</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>




    </aside>
</div>
