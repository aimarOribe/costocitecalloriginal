@extends('adminlte::page')

@section('title', 'CITEcall Trujillo')

@section('content')
    @auth
        @if (auth()->user()->can('familias.inicio') || auth()->user()->can('flujodecajas.inicio') || auth()->user()->can('listas.inicio') || auth()->user()->can('modeloseinsumos.inicio') || auth()->user()->can('familiamaterialesmateriales.inicio') || auth()->user()->can('unidadesmedidaconversion.inicio') || auth()->user()->can('manoobra.inicio') || auth()->user()->can('gif.inicio') || auth()->user()->can('dep.inicio') || auth()->user()->can('gg.inicio'))
            @if (auth()->user()->can('familias.inicio'))
                <form action="{{route('familias.inicio')}}" method="GET">
                    <div class="centrar-texto">
                        <img src="https://cdn-icons-png.flaticon.com/512/994/994588.png" height="300px" width="300px" alt="Persona Triste">
                        <button type="submit" class="btn btn-success tamano-texto">
                            Ir a la hoja u hojas
                        </button>
                    </div>
                </form>
            </div>
                </form>
            @elseif (auth()->user()->can('flujodecajas.inicio'))
                <form action="{{route('flujodecajas.inicio')}}" method="GET">
                    <div class="centrar-texto">
                        <img src="https://cdn-icons-png.flaticon.com/512/994/994588.png" height="300px" width="300px" alt="Persona Triste">
                        <button type="submit" class="btn btn-success tamano-texto">
                            Ir a la hoja u hojas
                        </button>
                    </div>
                </form>
            @elseif (auth()->user()->can('listas.inicio'))
                <form action="{{route('listas.inicio')}}" method="GET">
                    <div class="centrar-texto">
                        <img src="https://cdn-icons-png.flaticon.com/512/994/994588.png" height="400px" width="400px" alt="Persona Triste">
                        <button type="submit" class="btn btn-success tamano-texto">
                            Ir a la hoja u hojas
                        </button>
                    </div>
                </form>
            @elseif (auth()->user()->can('modeloseinsumos.inicio'))
                <form action="{{route('modeloseinsumos.inicio')}}" method="GET">
                    <div class="centrar-texto">
                        <img src="https://cdn-icons-png.flaticon.com/512/994/994588.png" height="400px" width="400px" alt="Persona Triste">
                        <button type="submit" class="btn btn-success tamano-texto">
                            Ir a la hoja u hojas
                        </button>
                    </div>
                </form>
            @elseif (auth()->user()->can('familiamaterialesmateriales.inicio'))
                <form action="{{route('familiamaterialesmateriales.inicio')}}" method="GET">
                    <div class="centrar-texto">
                        <img src="https://cdn-icons-png.flaticon.com/512/994/994588.png" height="400px" width="400px" alt="Persona Triste">
                        <button type="submit" class="btn btn-success tamano-texto">
                            Ir a la hoja u hojas
                        </button>
                    </div>
                </form>
            @elseif (auth()->user()->can('unidadesmedidaconversion.inicio'))
                <form action="{{route('unidadesmedidaconversion.inicio')}}" method="GET">
                    <div class="centrar-texto">
                        <img src="https://cdn-icons-png.flaticon.com/512/994/994588.png" height="400px" width="400px" alt="Persona Triste">
                        <button type="submit" class="btn btn-success tamano-texto">
                            Ir a la hoja u hojas
                        </button>
                    </div>
                </form>
            @elseif (auth()->user()->can('manoobra.inicio'))
                <form action="{{route('manoobra.inicio')}}" method="GET">
                    <div class="centrar-texto">
                        <img src="https://cdn-icons-png.flaticon.com/512/994/994588.png" height="400px" width="400px" alt="Persona Triste">
                        <button type="submit" class="btn btn-success tamano-texto">
                            Ir a la hoja u hojas
                        </button>
                    </div>
                </form>
            @elseif (auth()->user()->can('dep.inicio'))
                <form action="{{route('dep.inicio')}}" method="GET">
                    <div class="centrar-texto">
                        <img src="https://cdn-icons-png.flaticon.com/512/994/994588.png" height="400px" width="400px" alt="Persona Triste">
                        <button type="submit" class="btn btn-success tamano-texto">
                            Ir a la hoja u hojas
                        </button>
                    </div>
                </form>
            @elseif (auth()->user()->can('gif.inicio'))
                <form action="{{route('gif.inicio')}}" method="GET">
                    <div class="centrar-texto">
                        <img src="https://cdn-icons-png.flaticon.com/512/994/994588.png" height="400px" width="400px" alt="Persona Triste">
                        <button type="submit" class="btn btn-success tamano-texto">
                            Ir a la hoja u hojas
                        </button>
                    </div>
                </form>
            @elseif (auth()->user()->can('gg.inicio'))
                <form action="{{route('gg.inicio')}}" method="GET">
                    <div class="centrar-texto">
                        <img src="https://cdn-icons-png.flaticon.com/512/994/994588.png" height="400px" width="400px" alt="Persona Triste">
                        <button type="submit" class="btn btn-success tamano-texto">
                            Ir a la hoja u hojas
                        </button>
                    </div>
                </form>
            @endif
        @else
            <div class="centrar-texto">
                <img src="https://cdn-icons-png.flaticon.com/512/2622/2622112.png" height="400px" width="400px" alt="Persona Triste">
                <p>No tiene ninguna hoja asignada</p>
            </div>
        @endif
    @endauth 
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
@stop