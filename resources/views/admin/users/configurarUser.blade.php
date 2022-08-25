@extends('adminlte::page')

@section('title', 'Confiracion de Usuario')

@section('content_header')
    <h1>Configuracion de Usuario</h1>
@stop

@section('content')
    <div class="margen-principal">

        <div style="display: flex; justify-content: space-between">
            <div>
                <h1>Configuracion del 
                    <?php
                    if($user->hasRole('Admin')){
                        ?>
                        Administrador
                        <?php
                    }else{
                        ?>
                        Empleado
                        <?php
                    }
                    ?>
                </h1>
            </div>
            <div>
                <a class="btn btn-danger" style="font-weight: 500; font-size: 15px; color: white;" href="{{route('configuser.eliminarconfigUsuario',$user)}}">Eliminar Empleado</a>
            </div>
        </div>
        
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

        <div class="card">
            <div class="card-body">
                {!! Form::model($user, ['route' => ['configuser.actualizarconfigUsuario',$user], 'method' => 'put']) !!}
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="name" id="nombre" placeholder="Ingresar Nombre" value="{{$user->name}}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="correo">Correo</label>
                        <input type="email" class="form-control" name="email" id="correo" placeholder="Ingresar Correo" value="{{$user->email}}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="cotrasenia">Contraseña Actual</label>
                        <input readonly type="password" class="form-control" name="password" id="cotrasenia" placeholder="Ingresar Contraseña" value="{{$user->password}}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="cotrasenia">Contraseña Nueva</label>
                        <input type="password" minlength="8" class="form-control" name="newpassword" id="cotrasenia" placeholder="Ingresar Contraseña">
                    </div>
                    <div class="form-group mt-3">
                        <label for="cotrasenia">Confirmar Contraseña Nueva</label>
                        <input type="password" minlength="8" class="form-control" name="confirnewpassword" id="cotrasenia" placeholder="Ingresar Contraseña">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-success">Guardar Nuevos Datos</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/user.js')}}"></script>
@stop