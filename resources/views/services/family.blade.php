@extends('adminlte::page')

@section('title', 'Familia')

@section('content_header')
    <h1>Familia</h1>
@stop

@section('content')
    @if (auth()->user()->can('familias.inicio'))
        <div class="margen-principal">

            @if (session('errorUser'))
                <div class="alert alert-warning" role="alert">
                    {{session('errorUser')}}
                </div>
            @endif

            @if (session('mensajefamilia'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('mensajefamilia')}}!</strong>
                    <button type="button" class="close btn btn-success btn-sm" data-dismiss="alert" aria-label="Close">
                        x
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="displayForm">
                        <label class="form-check-label" for="displayForm">Ver/Registrar Familias</label>
                    </div>

                    <div id="requestForm">
                        {!! Form::open(['url' => 'familias/actualizar', 'method' => 'post']) !!}
                        <table id="familias" class="familia-tabla table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">FAMILIA</th>
                                    <th scope="col">CAP. PROD SEM (DOCENAS)</th>
                                    <th scope="col">CAP PROD MENSUAL</th>
                                </tr>
                            </thead>
                            <tbody style="border-color: #ed7d31" class="cuerpopadrefamilia">
                                <?php $i = 0; ?>
                                @foreach ($familias as $familia)
                                    <?php $i++; ?>
                                    <tr>
                                        <input hidden name="id[]" value="<?php echo $familia->id ?>">
                                        <td><input type="text" class="form-control tamano-texto-cuerpo-lista" name="nombre[<?php echo $familia->id ?>]" value="<?php echo $familia->nombre ?>"></td>
                                        <td><input type="number" class="semanal-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="capprosemdocenas[<?php echo $familia->id ?>]" value="<?php echo $familia->capprosemdocenas ?>"></td>
                                        <td><input type="number" class="mensual-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="capprodmensual[<?php echo $familia->id ?>]" value="<?php echo $familia->capprodmensual ?>"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <input type="submit" name="actualizar" value="Guardar Familias" class="btn btn-success tamano-texto-cuerpo-boton"/>
                        {!! Form::close() !!}
                    </div>
                    
                    <div style="display:none" id="memberForm">
                        <form action="{{route('familias.registrar')}}" method="POST">
                            @csrf
                            <table class="familia-tabla table table-bordered" id="tabla">
                                <thead>
                                    <tr>
                                        <th>FAMILIA</th>
                                        <th>CAP. PROD SEM (DOCENAS)</th>
                                        <th>CAP PROD MENSUAL</th>
                                    </tr>
                                </thead>
                                <tbody style="border-color: #ed7d31">
                                    <tr class="fila-fija">
                                        <td><input type="text" required name="nombre[]" placeholder="FAMILIA" class="form-control tamano-texto-cuerpo-lista"/></td>
                                        <td><input type="number" name="capprosemdocenas[]" placeholder="CAP. PROD SEM (DOCENAS)" class="semanal form-control tamano-texto-cuerpo-lista"/></td>
                                        <td><input type="number" name="capprodmensual[]" placeholder="CAP PROD MENSUAL" class="mensual form-control tamano-texto-cuerpo-lista"/></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="btn-der">
                                <input type="submit" name="insertar" value="Insertar Familia" class="btn btn-primary"/>
                            </div>
                        </form>
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
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/familia.css')}}">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/familia.js')}}"></script>
@stop