@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
    <h1>Perfil</h1>
@stop

@section('content')
    <div class="margen-principal">
        @if (session('mensajePerfil'))
            <div class="alert alert-success">
                <strong>{{session('mensajePerfil')}}</strong>
            </div>
        @endif

        @if (session('errorPerfil'))
            <div class="alert alert-warning" role="alert">
                {{session('errorPerfil')}}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                {!! Form::model($perfil, ['route' => ['admin.perfil.update',$perfil], 'method' => 'put']) !!}
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="name" id="nombre" placeholder="Ingresar Nombre" value="{{$perfil->name}}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="correo">Correo</label>
                        <input type="email" class="form-control" name="email" id="correo" placeholder="Ingresar Correo" value="{{$perfil->email}}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="cotrasenia">Contraseña Actual</label>
                        <input readonly type="password" class="form-control" name="password" id="cotrasenia" placeholder="Ingresar Contraseña" value="{{$perfil->password}}">
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