@extends('adminlte::page')

@section('title', 'Unidades de Conversion')

@section('content_header')
    <h1>Unidades de Conversión</h1>
@stop

@section('content')
    @if (auth()->user()->can('familiamaterialesmateriales.inicio'))
        <div class="container margen-listas">
            <div class="margen-principal">
                <div class="card" style="padding: 20px">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 offset-md-12 col-lg-12 offset-lg-0"> 

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="displayFormlistaunidadmedidaconversion">
                                <label class="form-check-label" for="displayFormlistaunidadmedidaconversion">Ver/Registrar Unidad de Medida de Conversion</label>
                            </div>
                        
                            <div id="requestFormlistaunidadmedidaconversion">
                                <table id="listaunidadmedidaconversion" class="listaunidadmedidaconversion-tabla table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Material</th>
                                            <th scope="col">Unidad de Medida</th>
                                            <th scope="col">Conversion</th>
                                        </tr>
                                    </thead>
                                    <tbody style="border-color: #ed7d31" class="cuerpopadreunidadmedidaconversion" id="cuerpopadreunidadmedidaconversion"></tbody>
                                </table>
                                <button type="submit" name="actualizarlistaunidadmedidaconversion" class="btn btn-success tamano-texto-cuerpo-boton" id="clavebotonactualizareliminarunidadesmedidaconversion">Guardar Unidades de Conversion</button>
                            </div>
                        
                            <div style="display:none" id="memberFormlistaunidadmedidaconversion">
                                <table class="listaunidadmedidaconversion-tabla table table-bordered" id="tablalistaunidadmedidaconversion">
                                    <thead>
                                        <tr>
                                            <th scope="col">Material</th>
                                            <th scope="col">Unidad de Medida</th>
                                            <th scope="col">Conversion</th>
                                        </tr>
                                    </thead>
                                    <tbody style="border-color: #ed7d31">
                                        <tr>
                                            <td>
                                                <select name="material_id[]" class="form-select tamano-texto-cuerpo-lista" aria-label="Default select example" id="claveunidadconversionmaterialregistrar">
                                                    <option class="tamano-texto-cuerpo-lista" value="">--</option>
                                                    @foreach ($fmmateriales as $fmmaterial)
                                                        <option class="tamano-texto-cuerpo-lista" value="{{$fmmaterial->id}}">
                                                            {{$fmmaterial->nombre}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select name="unidadesmedidas_id[]" class="form-select tamano-texto-cuerpo-lista" aria-label="Default select example" id="claveunidadconversionunidadmedidaactualizar">
                                                    <option class="tamano-texto-cuerpo-lista" value="">--</option>
                                                    @foreach ($unidadesmedidas as $unidadesmedida)
                                                        <option class="tamano-texto-cuerpo-lista" value="{{$unidadesmedida->id}}">
                                                            {{$unidadesmedida->nombre}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input name="conversion[]" placeholder="Conversion" class="form-control tamano-texto-cuerpo-lista" id="claveunidadconversionconversionregistrar"/></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="btn-der">
                                    <button type="submit" name="insertarlistaunidadmedidaconversion" class="btn btn-primary tamano-texto-cuerpo-boton" id="clavebotonaguardarunidadesmedidaconversion">Insertar Unidades de Conversion</button>
                                </div>
                            </div>
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
    <link rel="stylesheet" href="{{asset('css/unidadmedidaconversion.css')}}">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/unidadmedidaconversion.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop