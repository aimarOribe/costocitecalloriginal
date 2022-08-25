@extends('adminlte::page')

@section('title', 'GIF')

@section('content_header')
    <h1>GIF</h1>
@stop

@section('content')
    @if (auth()->user()->can('gif.inicio'))
        <div class="margen-principal">

            @if (session('errorUser'))
                <div class="alert alert-warning" role="alert">
                    {{session('errorUser')}}
                </div>
            @endif

            @if (session('mensajegif'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('mensajegif')}}!</strong>
                    <button type="button" class="close btn btn-success btn-sm" data-dismiss="alert" aria-label="Close">
                        x
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">

                    <div class="gif-titulo">
                        <div>
                            <p>3. GASTOS INDIRECTOS DE FABRICACIÓN POR MES</p>
                        </div>
                        <div>
                            <input readonly style="background-color: #ffff00" class="form-control costototalgif" type="text">                    
                        </div>
                    </div>

                    <br>

                    @include('services.gif.manoobraindirectasinbeneficios')

                    <br>

                    @include('services.gif.manoobraindirectaconbeneficios')

                    <br>

                    @include('services.gif.hmsidfmodelajeyseriado')

                    <br>

                    @include('services.gif.hmsidfcorte')

                    <br>

                    @include('services.gif.hmsidfaparado')

                    <br>

                    @include('services.gif.hmsidfarmado')

                    <br>

                    @include('services.gif.hmsidfalistado')

                    <br>

                    @include('services.gif.hmsidflimpieza')

                    <br>

                    @include('services.gif.hmsidfeppersonal')

                    <br>

                    @include('services.gif.rmcorte')

                    <br>

                    @include('services.gif.rmaparado')

                    <br>

                    @include('services.gif.rmarmado')

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/gif.css')}}">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/gif.js')}}"></script>
@stop