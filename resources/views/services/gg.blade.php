@extends('adminlte::page')

@section('title', 'GG')

@section('content_header')
    <h1>GG</h1>
@stop

@section('content')
    @if (auth()->user()->can('gg.inicio'))
        <div class="margen-principal">

            @if (session('errorUser'))
                <div class="alert alert-warning" role="alert">
                    {{session('errorUser')}}
                </div>
            @endif

            @if (session('mensajegg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('mensajegg')}}!</strong>
                    <button type="button" class="close btn btn-success btn-sm" data-dismiss="alert" aria-label="Close">
                        x
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">

                    <div class="gif-titulo">
                        <div>
                            <p>4. GASTOS GENERALES MENSUALES</p>
                        </div>
                        <div>
                            <input disabled style="background-color: #ffff00" class="form-control costototalgg" type="text">                    
                        </div>
                    </div>

                    <br>

                    @include('services.gg.gasueldosadministrativos')     

                    <br>

                    <br>

                    @include('services.gg.gggautilesescritorio')   

                    <br>

                    <br>

                    @include('services.gg.gggaeventosanuales')
                    
                    <br>

                    @include('services.gg.ggvsueldoadministrativo')

                    <br>

                    <br>

                    @include('services.gg.ggvalmuerzoejecutivo')

                    <br>

                    <br>

                    @include('services.gg.ggvotrogastoventa')

                    <br>

                    <br>

                    @include('services.gg.ggtpasajecombustible')

                    <br>

                    <br>

                    @include('services.gg.ggtmantenimientoauto')

                    <br>

                    <br>

                    @include('services.gg.ggserviciosbasicos')

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
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/gg.css')}}">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/gg.js')}}"></script>
@stop