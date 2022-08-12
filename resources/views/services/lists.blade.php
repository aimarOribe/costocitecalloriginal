@extends('layouts.template')

@section('title','Listas')

@section('css')
    <link rel="stylesheet" href="{{asset('css/lista.css')}}">
@endsection

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
    <script type="text/javascript" src="{{asset('js/lista.js')}}"></script>
@endsection