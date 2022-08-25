@extends('adminlte::page')

@section('title', 'Mano de Obra')

@section('content_header')
    <h1>Mano de Obra</h1>
@stop

@section('content')
    @if (auth()->user()->can('manoobra.inicio'))
        <div class="margen-principal">
            <div class="card">
                <div class="card-body">

                    @if (session('errorUserHandWork'))
                        <div class="alert alert-warning" role="alert">
                            {{session('errorUserHandWork')}}
                        </div>
                    @endif

                    @if (session('mensajemanoobra'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('mensajemanoobra')}}!</strong>
                            <button type="button" class="close btn btn-success btn-sm" data-dismiss="alert" aria-label="Close">
                                x
                            </button>
                        </div>
                    @endif

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="displayFormManoObra">
                        <label class="form-check-label" for="displayFormManoObra">Ver/Registrar Mano de Obra</label>
                    </div>

                    <div id="requestFormManoObra">
                        {!! Form::open(['url' => 'manoobra/actualizar', 'method' => 'post']) !!}
                        <table id="manoobra" class="manoobra-tabla table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">FAMILIA</th>
                                    <th scope="col">MODELO</th>
                                    <th scope="col">PROCESO</th>
                                    <th scope="col">TIEMPO (HORAS)</th>
                                    <th scope="col">COSTO</th>
                                </tr>
                            </thead>
                            <tbody style="border-color: #ed7d31" class="cuerpopadremanoobra">
                                <?php $i = 0; ?>
                                @foreach ($manoobras as $manoobra)
                                    <?php $i++; ?>
                                    <tr>
                                        <input hidden class="vamos-<?php echo $i ?>" value="<?php echo $manoobra->modelo_id ?>">
                                        <input hidden name="id[]" value="<?php echo $manoobra->id ?>">
                                        <td>
                                            <select class="opcionfamilia-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="familia_id[<?php echo $manoobra->id ?>]">
                                                <option class="tamano-texto-cuerpo-lista" value="">--</option>
                                                @foreach ($familias as $familia)
                                                    <option class="tamano-texto-cuerpo-lista" value="{{$familia->id}}" @if($familia->id===$manoobra->familia_id) selected='selected' @endif>
                                                        {{$familia->nombre}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="opcionmodelo-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="modelo_id[<?php echo $manoobra->id ?>]">
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" id="familia_id" name="proceso_id[<?php echo $manoobra->id ?>]">
                                                <option class="tamano-texto-cuerpo-lista" value="">--</option>
                                                @foreach ($procesos as $proceso)
                                                    <option class="tamano-texto-cuerpo-lista" value="{{$proceso->id}}" @if($proceso->id===$manoobra->proceso_id) selected='selected' @endif>
                                                        {{$proceso->nombre}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" class="form-control tamano-texto-cuerpo-lista" name="tiempohoras[<?php echo $manoobra->id ?>]" value="<?php echo $manoobra->tiempohoras ?>"></td>
                                        <td><input class="form-control tamano-texto-cuerpo-lista" name="costo[<?php echo $manoobra->id ?>]" value="<?php echo $manoobra->costo ?>"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <input type="submit" name="actualizar" value="Guardar Mano de Obra" class="btn btn-success tamano-texto-cuerpo-boton"/>
                        {!! Form::close() !!}
                    </div>
                    
                    <div style="display:none" id="memberFormManoObra">
                        <form action="{{route('manoobra.registrarmanoobra')}}" method="POST">
                            @csrf
                            <table class="manoobra-tabla table table-bordered" id="tablaManoObra">
                                <thead>
                                    <tr>
                                        <th scope="col">FAMILIA</th>
                                        <th scope="col">MODELO</th>
                                        <th scope="col">PROCESO</th>
                                        <th scope="col">TIEMPO (HORAS)</th>
                                        <th scope="col">COSTO</th>
                                    </tr>
                                </thead>
                                <tbody style="border-color: #ed7d31">
                                    <tr class="fila-fija-manoObra">
                                        <td>
                                            <select required name="familia_id" id="familiaSeleccionado" class="form-select tamano-texto-cuerpo-lista" aria-label="Default select example">
                                                <option value="">--</option>
                                                @foreach ($familias as $familia)
                                                    <option class="tamano-texto-cuerpo-lista" value="{{$familia->id}}">
                                                        {{$familia->nombre}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>  
                                        <td>
                                            <select required name="modelo_id" id="modeloSeleccionado" class="form-select tamano-texto-cuerpo-lista" aria-label="Default select example">
                                            </select>
                                        </td>                                    
                                        <td>
                                            <select required name="proceso_id" class="form-select tamano-texto-cuerpo-lista" aria-label="Default select example">
                                                <option class="tamano-texto-cuerpo-lista" value="">--</option>
                                                @foreach ($procesos as $proceso)
                                                    <option class="tamano-texto-cuerpo-lista" value="{{$proceso->id}}">
                                                        {{$proceso->nombre}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>   
                                        <td><input required type="number" name="tiempohora" placeholder="Tiempo en horas" class="form-control tamano-texto-cuerpo-lista"/></td>
                                        <td><input required name="costo" placeholder="Costo" class="form-control tamano-texto-cuerpo-lista"/></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="btn-der">
                                <input type="submit" name="insertarManoObra" value="Insert Mano de Obra" class="btn btn-primary"/>
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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/manoobra.css')}}">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/manoobra.js')}}"></script>
@stop