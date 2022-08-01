@extends('layouts.template')

@section('title','Familia')

@section('css')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
    @auth
        @if (auth()->user()->can('familias.inicio') || auth()->user()->can('flujodecajas.inicio') || auth()->user()->can('listas.inicio') || auth()->user()->can('modeloseinsumos.inicio') || auth()->user()->can('manoobra.inicio'))
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
                        <button type="submit" class="btn btn-success">
                            Ir a la hoja u hojas
                        </button>
                    </div>
                </form>
            @elseif (auth()->user()->can('modeloseinsumos.inicio'))
                <form action="{{route('modeloseinsumos.inicio')}}" method="GET">
                    <div class="centrar-texto">
                        <img src="https://cdn-icons-png.flaticon.com/512/994/994588.png" height="400px" width="400px" alt="Persona Triste">
                        <button type="submit" class="btn btn-success">
                            Ir a la hoja u hojas
                        </button>
                    </div>
                </form>
            @elseif (auth()->user()->can('manoobra.inicio'))
                <form action="{{route('manoobra.inicio')}}" method="GET">
                    <div class="centrar-texto">
                        <img src="https://cdn-icons-png.flaticon.com/512/994/994588.png" height="400px" width="400px" alt="Persona Triste">
                        <button type="submit" class="btn btn-success">
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
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/familia.js')}}"></script>
@endsection