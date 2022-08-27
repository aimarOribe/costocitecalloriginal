@extends('adminlte::page')

@section('title', 'DEP')

@section('content_header')
    <h1>DEP</h1>
@stop

@section('content')
    @if (auth()->user()->can('dep.inicio'))
        <div class="margen-principal">

            @if (session('errorUser'))
                <div class="alert alert-warning" role="alert">
                    {{session('errorUser')}}
                </div>
            @endif

            @if (session('mensajeped'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('mensajeped')}}!</strong>
                    <button type="button" class="close btn btn-success btn-sm" data-dismiss="alert" aria-label="Close">
                        x
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                
                    <div style="margin: 0 auto; max-width: 400px; text-align: center">
                        <div class="row" style="background-color: #ffff00; margin-bottom: 10px;">
                            <div class="col align-self-center">
                                <p style="font-weight: 700; font-size: 14px; padding-top: 22px">TOTAL DE DEPRECIACIÓN MENSUAL</p>
                            </div>
                            <div class="col align-self-center">
                                <input readonly style="font-weight: 700; font-size: 14px;" class="pedtotaldepreciacionmensual form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col align-self-center">
                                <p>AÑO ACTUAL</p>
                            </div>
                            <div class="col align-self-center">
                                <p id="fechaHoy"></p>
                            </div>
                        </div> 
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="displayFormdep">
                        <label class="form-check-label" for="displayFormdep">Ver/Registrar DEP</label>
                    </div>

                    <div id="requestFormdep">
                        {!! Form::open(['url' => 'dep/actualizar', 'method' => 'post']) !!}
                        <table id="dep" class="dep-tabla table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ACTIVO</th>
                                    <th scope="col">FECHA</th>
                                    <th scope="col">COSTO ($)</th>
                                    <th scope="col">CAMBIO DE DÓLAR EN LA FECHA DE COMPRA</th>
                                    <th scope="col">COSTO (S/)</th>
                                    <th scope="col">UNIDADES</th>
                                    <th scope="col">COSTO TOTAL</th>
                                    <th scope="col">AÑOS A DEPRECIAR</th>
                                    <th scope="col">VALOR RESIDUAL</th>
                                    <th scope="col">DEPRECIACIÓN ANUAL</th>
                                </tr>
                            </thead>
                            <tbody style="border-color: #5b9bd5" class="cuerpopadredep">
                                <?php $i = 0; ?>
                                @foreach ($deps as $dep)
                                    <?php $i++; ?>
                                    <tr>
                                        <input hidden name="id[]" value="<?php echo $dep->id ?>">
                                        <td><input type="text" class="form-control tamano-texto-cuerpo-lista" name="activo[<?php echo $dep->id ?>]" value="<?php echo $dep->activo ?>"></td>
                                        <td><input type="date" class="depfecha-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="fecha[<?php echo $dep->id ?>]" value="<?php echo $dep->fecha ?>"></td>
                                        <td><input class="depcostodolar-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="costodolar[<?php echo $dep->id ?>]" value="<?php echo $dep->costodolar ?>"></td>
                                        <td><input class="depccambiodolar-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="cambiodolarfechacompra[<?php echo $dep->id ?>]" value="<?php echo $dep->cambiodolarfechacompra ?>"></td>
                                        <td><input class="depcostosoles-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="costosoles[<?php echo $dep->id ?>]" value="<?php echo $dep->costosoles ?>"></td>
                                        <td><input type="number" class="depunidades-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="unidades[<?php echo $dep->id ?>]" value="<?php echo $dep->unidades ?>"></td>
                                        <td><input readonly class="depcostototal-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="costototal[<?php echo $dep->id ?>]" value="<?php echo $dep->costototal ?>"></td>
                                        <td><input type="number" class="depaniosdepreciar-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="aniosadepreciar[<?php echo $dep->id ?>]" value="<?php echo $dep->aniosadepreciar ?>"></td>
                                        <td><input class="depvalorresidual-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="valorresidual[<?php echo $dep->id ?>]" value="<?php echo $dep->valorresidual ?>"></td>
                                        <td><input readonly class="depdepreciacionanual-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="depreciacionanual[<?php echo $dep->id ?>]" value="<?php echo $dep->depreciacionanual ?>"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <input type="submit" name="actualizar" value="Guardar DEP" class="btn btn-success tamano-texto-cuerpo-boton"/>
                        {!! Form::close() !!}
                    </div>
                    
                    <div style="display:none" id="memberFormdep">
                        <form action="{{route('dep.registrardeps')}}" method="POST">
                            @csrf
                            <table class="dep-tabla table table-bordered" id="tabla">
                                <thead>
                                    <tr>
                                        <th scope="col">ACTIVO</th>
                                        <th scope="col">FECHA</th>
                                        <th scope="col">COSTO ($)</th>
                                        <th scope="col">CAMBIO DE DÓLAR EN LA FECHA DE COMPRA</th>
                                        <th scope="col">COSTO (S/)</th>
                                        <th scope="col">UNIDADES</th>
                                        <th scope="col">COSTO TOTAL</th>
                                        <th scope="col">AÑOS A DEPRECIAR</th>
                                        <th scope="col">VALOR RESIDUAL</th>
                                        <th scope="col">DEPRECIACIÓN ANUAL</th>
                                    </tr>
                                </thead>
                                <tbody style="border-color: #5b9bd5">
                                    <tr class="fila-fija">
                                        <td><input required type="text" class="form-control tamano-texto-cuerpo-lista" name="activo" /></td>
                                        <td><input required type="date" class="depfecha semanal form-control tamano-texto-cuerpo-lista" name="fecha"/></td>
                                        <td><input class="depcostodolar form-control tamano-texto-cuerpo-lista" name="costodolar" value="0"/></td>
                                        <td><input class="depccambiodolar form-control tamano-texto-cuerpo-lista" name="cambiodolarfechacompra" value="0"></td>
                                        <td><input class="depcostosoles form-control tamano-texto-cuerpo-lista" name="costosoles" value="0"></td>
                                        <td><input type="number" class="depunidades form-control tamano-texto-cuerpo-lista" name="unidades" value="0"></td>
                                        <td><input readonly class="depcostototal form-control tamano-texto-cuerpo-lista" name="costototal" value="0"></td>
                                        <td><input type="number" class="depaniosdepreciar form-control tamano-texto-cuerpo-lista" name="aniosadepreciar" value="0"></td>
                                        <td><input class="depvalorresidual form-control tamano-texto-cuerpo-lista" name="valorresidual" value="0"></td>
                                        <td><input readonly class="depdepreciacionanual form-control tamano-texto-cuerpo-lista" name="depreciacionanual" value="0"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="btn-der">
                                <input type="submit" name="insertar" value="Insertar DEP" class="btn btn-primary"/>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/dep.css')}}">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/dep.js')}}"></script>
@stop