<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('familias.inicio')}}">
                <img src="https://scontent.ftru3-1.fna.fbcdn.net/v/t39.30808-6/293164450_353506510296821_5028679871833543578_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=09cbfe&_nc_eui2=AeFD4cttxTLclbsoQcOHkIGEoLi0DWyc8iGguLQNbJzyIS2XnMQut1IxosSiVv7juKAyDVYS4iIHSAu62Y8Xsz9b&_nc_ohc=0OiEjSGF8DsAX9uis-E&_nc_ht=scontent.ftru3-1.fna&oh=00_AT_dvaZOuETA8akGTGoFnGuGedNCKwTq37yNt1ivLeBd0A&oe=62EBF72F" alt="" width="30" height="24" class="d-inline-block align-text-top">
                CITEcall Trujillo
            </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    {{-- @can('flujodecajas.inicio')
                        <li>
                            <a class="nav-link {{request()->routeIs('flujodecajas.*') ? 'active servicio-ctivo':''}}" href="{{route('flujodecajas.inicio')}}">Flujo de Caja</a>
                        </li>
                    @endcan --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tablas Maestras
                        </a>
                        <ul class="dropdown-menu">
                            @can('familias.inicio')
                                <li>
                                    <a class="nav-link {{request()->routeIs('familias.*') ? 'active servicio-ctivo':''}}" href="{{route('familias.inicio')}}">Familia</a>
                                </li>
                            @endcan
                            @can('listas.inicio')
                                <li>
                                    <a class="nav-link {{request()->routeIs('listas.*') ? 'active servicio-ctivo':''}}" href="{{route('listas.inicio')}}">Listas</a>
                                </li>
                            @endcan  
                            @can('modeloseinsumos.inicio')
                                <li>
                                    <a class="nav-link {{request()->routeIs('modeloseinsumos.*') ? 'active servicio-ctivo':''}}" href="{{route('modeloseinsumos.inicio')}}">Modelos y Familia de Materiales</a>
                                </li>
                            @endcan 
                            @can('familiamaterialesmateriales.inicio')   
                                <li>
                                    <a class="nav-link {{request()->routeIs('familiamaterialesmateriales.*') ? 'active servicio-ctivo':''}}" href="{{route('familiamaterialesmateriales.inicio')}}">Materiales</a>
                                </li>    
                            @endcan 
                            @can('unidadesmedidaconversion.inicio')   
                                <li>
                                    <a class="nav-link {{request()->routeIs('unidadesmedidaconversion.*') ? 'active servicio-ctivo':''}}" href="{{route('unidadesmedidaconversion.inicio')}}">Unidades de Conversion</a>
                                </li>    
                            @endcan 
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Procesos
                        </a>
                        <ul class="dropdown-menu">
                            @can('manoobra.inicio')
                                <li>
                                    <a class="nav-link {{request()->routeIs('manoobra.*') ? 'active servicio-ctivo':''}}" href="{{route('manoobra.inicio')}}">Mano de Obra</a>
                                </li>
                            @endcan  
                            <li>
                                <a href="{{route('insumos.inicio')}}">Insumos</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gastos
                        </a>
                        <ul class="dropdown-menu">
                            @can('dep.inicio')
                                <li>
                                    <a class="nav-link {{request()->routeIs('dep.*') ? 'active servicio-ctivo':''}}" href="{{route('dep.inicio')}}">DEP</a>
                                </li>
                            @endcan  
                            @can('gif.inicio')
                                <li>
                                    <a class="nav-link {{request()->routeIs('gif.*') ? 'active servicio-ctivo':''}}" href="{{route('gif.inicio')}}">GIF</a>
                                </li>
                            @endcan  
                            @can('gg.inicio')
                                <li>
                                    <a class="nav-link {{request()->routeIs('gg.*') ? 'active servicio-ctivo':''}}" href="{{route('gg.inicio')}}">GG</a>
                                </li>
                            @endcan  
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Reportes
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Reporte Uno</a></li>
                            <li><a class="dropdown-item" href="#">Reporte Dos</a></li>
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
                            <?php
                                $perfil = Auth::user();
                            ?>
                            <a class="dropdown-item" href="{{route('admin.perfil.edit',$perfil)}}">Perfil</a>
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