@extends('layouts.template')

@section('title','Modelos e Insumos')

@section('css')
    <link rel="stylesheet" href="{{asset('css/modeloinsumos.css')}}">
@endsection

@section('content')
    @if (auth()->user()->can('modeloseinsumos.inicio'))
        <div class="container margen-listas">

            <div class="margen-principal">
                <div class="card" style="padding: 20px">
                    <div class="row">
                        
                        @include('services.modelosinsumos.modelos')

                    </div>
                </div>
                <br>
                <div class="card" style="padding: 20px">
                    <div class="row">
                        
                        @include('services.modelosinsumos.insumos')

                    </div>
                </div>

            </div>
        </div>
    @else
        <div class="centrar-texto">
            <img src="https://cdn-icons-png.flaticon.com/512/2622/2622112.png" height="400px" width="400px" alt="Persona Triste">
            <div>
                <form action="{{route('home.inicio')}}" method="GET">
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
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/modeloinsumos.js')}}"></script>
@endsection