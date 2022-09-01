@extends('adminlte::page')

@section('title', 'Familia')

@section('content_header')
    <h1>Familia</h1>
@stop

@section('content')
    @if (auth()->user()->can('familias.inicio'))
        <div class="margen-principal">

            <div class="card">
                <div class="card-body">

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="displayForm">
                        <label class="form-check-label" for="displayForm">Ver/Registrar Familias</label>
                    </div>

                    <div id="requestForm">
                        <table id="familias" class="familia-tabla table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">FAMILIA</th>
                                    <th scope="col">CAP. PROD SEM (DOCENAS)</th>
                                    <th scope="col">CAP PROD MENSUAL</th>
                                </tr>
                            </thead>
                            <tbody style="border-color: #ed7d31" class="cuerpopadrefamilia" id="cuerpopadrefamilia"></tbody>
                        </table>
                        <input type="submit" name="actualizar" value="Guardar Familias" class="btn btn-success tamano-texto-cuerpo-boton" id="clavebotoneditareliminarfamilia"/>
                    </div>
                    
                    <div style="display:none" id="memberForm">
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
                                    <td><input type="text" required name="nombre" placeholder="FAMILIA" class="form-control tamano-texto-cuerpo-lista" id="clavenombrefamiliaregistrar"/></td>
                                    <td><input type="number" name="capprosemdocenas" placeholder="CAP. PROD SEM (DOCENAS)" class="semanal form-control tamano-texto-cuerpo-lista" id="clavecapprosemdocenasfamiliaregistrar"/></td>
                                    <td><input type="number" name="capprodmensual" placeholder="CAP PROD MENSUAL" class="mensual form-control tamano-texto-cuerpo-lista" id="clavecapprodmensualfamiliaregistrar"/></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="btn-der">
                            <input type="submit" name="insertar" value="Insertar Familia" class="btn btn-primary" id="clavebotonguardarfamilia"/>
                        </div>
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
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/familia.css')}}">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/familia.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop