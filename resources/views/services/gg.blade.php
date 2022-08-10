@extends('layouts.template')

@section('title','GG')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/gg.css')}}">
@endsection

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
    <script type="text/javascript" src="{{asset('js/gg.js')}}"></script>
@endsection