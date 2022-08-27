@extends('adminlte::page')

@section('title', 'Familia')

@section('content_header')
    <h1>Empleados</h1>
@stop

@section('content')
    @if (auth()->user()->can('admin.personal'))
        <div class="margen-principal">

            @if (session('errorConfigUser'))
                <div class="alert alert-warning" role="alert">
                    {{session('errorConfigUser')}}
                </div>
            @endif

            @if (session('mensajeConfigUser'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('mensajeConfigUser')}}!</strong>
                    <button type="button" class="close btn btn-success btn-sm" data-dismiss="alert" aria-label="Close">
                        x
                    </button>
                </div>
            @endif

            <div>
                <button class="btn btn-success mb-3" style="font-weight: 500; font-size: 15px; color: white;" data-bs-toggle="modal" data-bs-target="#staticBackdropusuario">Agregar Empleado</button> 
            </div>
            
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="users-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a class="btn btn-primary" style="font-weight: 500; font-size: 15px; color: white;" href="{{route('admin.users.edit',$user)}}">Editar Rol</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-secondary" style="font-weight: 500; font-size: 15px; color: white;" href="{{route('configuser.verconfigUsuario',$user)}}">Configurar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="centrar-texto">
            <img src="https://cdn-icons-png.flaticon.com/512/2622/2622112.png" height="400px" width="400px" alt="Persona Triste">
            <div>
                <p>Ya no tiene esta hoja Asignada</p>
            </div>
            
        </div>
    @endif

    {{-- MODAL --}}
    <div class="modal fade" id="staticBackdropusuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EjemploModalLabel">Agregar Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => 'configusuariomodal', 'method' => 'post']) !!}
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input required type="text" class="form-control" name="name" id="nombre" placeholder="Ingresar Nombre">
                        </div>
                        <div class="form-group mt-3">
                            <label for="correo">Correo</label>
                            <input required type="email" class="form-control" name="email" id="correo" placeholder="Ingresar Correo">
                        </div>
                        <div class="form-group mt-3">
                            <label for="cotrasenia">Contraseña</label>
                            <input required type="password" minlength="8" class="form-control" name="password" id="cotrasenia" placeholder="Ingresar Contraseña">
                        </div>
                        <div class="form-group mt-3">
                            <label for="cotrasenia">Confirmar Contraseña</label>
                            <input required type="password" minlength="8" class="form-control" name="confirpassword" id="cotrasenia" placeholder="Ingresar Contraseña">
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">Agregar</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL --}}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/user.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $('#users-table').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            responsive: true,
            autoWidth: false
        });
    </script>
@stop