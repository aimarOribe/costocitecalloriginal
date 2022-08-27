@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Lista de Roles</h1>
@stop

@section('content')
    @if (auth()->user()->can('admin.roles'))
        <div class="margen-principal">
            
            @if (session('errorRol'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{session('errorRol')}}!</strong>
                    <button type="button" class="close btn btn-warning btn-sm" data-dismiss="alert" aria-label="Close">
                        x
                    </button>
                </div>
            @endif

            @if (session('info'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('info')}}!</strong>
                    <button type="button" class="close btn btn-success btn-sm" data-dismiss="alert" aria-label="Close">
                        x
                    </button>
                </div>
            @endif

            <a class="btn btn-success mb-2" href="{{route('admin.roles.create')}}">Agregar Rol</a>

            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Role</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td width="10px">
                                        <a href="{{route('admin.roles.edit',$role)}}" class="btn btn-sm btn-primary">Editar</a>
                                    </td>
                                    <td width="10px">
                                        <form action="{{route('admin.roles.destroy',$role)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
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