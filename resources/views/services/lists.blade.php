@extends('adminlte::page')

@section('title', 'Listas')

@section('content_header')
    <h1>Listas</h1>
@stop

@section('content')
    @if (auth()->user()->can('listas.inicio'))
        <div class="container margen-listas">
            <div class="margen-principal">

                @if (session('errorServidorlistas'))
                    <div class="alert alert-danger" role="alert">
                        {{session('errorServidorlistas')}}
                    </div>
                @endif
                
                @if (session('mensajelistas'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('mensajelistas')}}!</strong>
                        <button type="button" class="close btn btn-success btn-sm" data-dismiss="alert" aria-label="Close">
                            x
                        </button>
                    </div>
                @endif

                <div class="card" style="padding: 20px">
                    <div class="row">
                        
                        @include('services.lists.listaUnidadesMedida')

                        @include('services.lists.listaProcesos')

                        @include('services.lists.listaClasificacions')

                        @include('services.lists.listaUnidadConsumo')

                        @include('services.lists.listaFamiliasMateriales')

                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="centrar-texto">
            <img src="https://cdn-icons-png.flaticon.com/512/2622/2622112.png" height="400px" width="400px" alt="Persona Triste">
            <div>
                <form action="{{route('admin.inicio')}}" method="GET">
                    <p>Ya no tiene esta hoja Asignada</p>
                    <div>
                        <button type="submit" class="btn btn-success tamano-texto">
                            Regresar al Inicio
                        </button>
                    </div>
                </form>
            </div> 
        </div>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/lista.css')}}">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/lista.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop