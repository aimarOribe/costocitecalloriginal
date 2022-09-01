@extends('adminlte::page')

@section('title', 'Materiales')

@section('content_header')
    <h1>Materiales</h1>
@stop

@section('content')
    @if (auth()->user()->can('familiamaterialesmateriales.inicio'))
        <div class="container margen-listas">
            <div class="margen-principal">
                <div class="card" style="padding: 20px">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 offset-md-12 col-lg-12 offset-lg-0">

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="displayFormfmmateriales">
                                <label class="form-check-label" for="displayFormfmmateriales">Ver/Registrar Materiales</label>
                            </div>
                        
                            <div id="requestFormfmmateriales">
                                <table id="fmmateriales" class="fmmateriales-tabla table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Familia de Materiales</th>
                                            <th scope="col">Material</th>
                                            <th scope="col">Unidad de Medida</th>
                                            <th scope="col">Presentacion</th>
                                            <th scope="col">Stock</th>
                                            <th scope="col">Costo Promedio</th>
                                            <th scope="col">Costo Real</th>
                                        </tr>
                                    </thead>
                                    <tbody style="border-color: #ed7d31" class="cuerpopadrefmaterialesmateriales" id="cuerpopadrefmaterialesmateriales"></tbody>
                                </table>
                                <button type="submit" name="actualizarModelosInsumosModelos" class="btn btn-success tamano-texto-cuerpo-boton" id="clavebotonactualizareliminarfmmateriales">Guardar Materiales</button>
                            </div>
                        
                            <div style="display:none" id="memberFormfmmateriales">
                                <table class="fmmateriales-tabla table table-bordered" id="tablafmmateriales">
                                    <thead>
                                        <tr>
                                            <th scope="col">Familia de Materiales</th>
                                            <th scope="col">Material</th>
                                            <th scope="col">Unidad de Medida</th>
                                            <th scope="col">Presentacion</th>
                                        </tr>
                                    </thead>
                                    <tbody style="border-color: #ed7d31">
                                        <tr class="fila-fija-fmmateriales">
                                            <td>
                                                <select required name="familiamateriales_id[]" class="form-select tamano-texto-cuerpo-lista" aria-label="Default select example" id="clavefmmfamiliamaterialesregistrar">
                                                    <option class="tamano-texto-cuerpo-lista" value="">--</option>
                                                    @foreach ($familiasmateriales as $familiasmaterial)
                                                        <option class="tamano-texto-cuerpo-lista" value="{{$familiasmaterial->id}}">
                                                            {{$familiasmaterial->nombre}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input required name="nombre[]" placeholder="Nombre" class="form-control tamano-texto-cuerpo-lista" id="clavefmmnombreregistrar"/></td>
                                            <td>
                                                <select required name="unidadesmedidas_id[]" class="form-select tamano-texto-cuerpo-lista" aria-label="Default select example" id="clavefmmunidadmedidasregistrar">
                                                    <option class="tamano-texto-cuerpo-lista" value="">--</option>
                                                    @foreach ($unidadesmedidas as $unidadesmedida)
                                                        <option class="tamano-texto-cuerpo-lista" value="{{$unidadesmedida->id}}">
                                                            {{$unidadesmedida->nombre}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input required name="presentacion[]" placeholder="Presentacion" class="form-control tamano-texto-cuerpo-lista" id="clavefmmpresentacionregistrar"/></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="btn-der">
                                    <button type="submit" name="insertarfmmateriales" class="btn btn-primary tamano-texto-cuerpo-boton" id="clavebotonguardarfmmateriales">Insertar Materiales</button>
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
    <link rel="stylesheet" href="{{asset('css/fmatemateriales.css')}}">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/fmatemateriales.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop