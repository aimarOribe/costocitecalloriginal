<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('familias.inicio')}}">
                <img src="https://scontent.ftru3-1.fna.fbcdn.net/v/t39.30808-6/293164450_353506510296821_5028679871833543578_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=09cbfe&_nc_eui2=AeFD4cttxTLclbsoQcOHkIGEoLi0DWyc8iGguLQNbJzyIS2XnMQut1IxosSiVv7juKAyDVYS4iIHSAu62Y8Xsz9b&_nc_ohc=Nz7O8YoQwPwAX8kui5G&_nc_ht=scontent.ftru3-1.fna&oh=00_AT_fl-ufF_4b9zycm1LWJjItgFl4v8_M0daf6R3hzoLURg&oe=62E40E2F" alt="" width="30" height="24" class="d-inline-block align-text-top">
                CITEcall Trujillo
            </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @can('familias.inicio')
                        <li>
                            <a class="nav-link {{request()->routeIs('familias.*') ? 'active servicio-ctivo':''}}" href="{{route('familias.inicio')}}">Familia</a>
                        </li>
                    @endcan
                    @can('flujodecajas.inicio')
                        <li>
                            <a class="nav-link {{request()->routeIs('flujodecajas.*') ? 'active servicio-ctivo':''}}" href="{{route('flujodecajas.inicio')}}">Flujo de Caja</a>
                        </li>
                    @endcan
                    @can('listas.inicio')
                        <li>
                            <a class="nav-link {{request()->routeIs('listas.*') ? 'active servicio-ctivo':''}}" href="{{route('listas.inicio')}}">Listas</a>
                        </li>
                    @endcan     
                    @can('modeloseinsumos.inicio')
                        <li>
                            <a class="nav-link {{request()->routeIs('modeloseinsumos.*') ? 'active servicio-ctivo':''}}" href="{{route('modeloseinsumos.inicio')}}">Modelos e Insumos</a>
                        </li>
                    @endcan
                    @can('manoobra.inicio')
                        <li>
                            <a class="nav-link {{request()->routeIs('manoobra.*') ? 'active servicio-ctivo':''}}" href="{{route('manoobra.inicio')}}">Mano de Obra</a>
                        </li>
                    @endcan                
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Más
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">asdasdas</a></li>
                            <li><a class="dropdown-item" href="#">qweqweqweqw</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: black" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{auth()->user()->name}}
                        </a>
                        <ul class="dropdown-menu">
                            @can('admin.personal')
                                <a class="dropdown-item" href="{{route('admin.users.index')}}">Employees</a>
                            @endcan
                            @can('admin.roles')
                                <a class="dropdown-item" href="{{route('admin.roles.index')}}">Roles</a>
                            @endcan
                            <li><a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();this.closest('form').submit();">Cerrar Sesion</a></li>
                        </ul>
                    </div>
                    
                </form>
            </div>
        </div>
      </nav>
</header>