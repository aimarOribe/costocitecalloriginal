@extends('layouts.template')

@section('title','Unidades De Conversion')

@section('css')
    <link rel="stylesheet" href="{{asset('css/unidadmedidaconversion.css')}}">
@endsection

@section('content')
    @if (auth()->user()->can('familiamaterialesmateriales.inicio'))
        <div class="container margen-listas">
            <div class="margen-principal">
                <div class="card" style="padding: 20px">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 offset-md-12 col-lg-12 offset-lg-0">

                            @if (session('errorUserunidadconversion'))
                                <div class="alert alert-warning" role="alert">
                                    {{session('errorUserunidadconversion')}}
                                </div>
                            @endif
                        
                            @if (session('mensajeunidadconversion'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{session('mensajeunidadconversion')}}!</strong>
                                    <button type="button" class="close btn btn-success btn-sm" data-dismiss="alert" aria-label="Close">
                                        x
                                    </button>
                                </div>
                            @endif  

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="displayFormlistaunidadmedidaconversion">
                                <label class="form-check-label" for="displayFormlistaunidadmedidaconversion">Ver/Registrar Unidad de Medida de Conversion</label>
                            </div>
                        
                            <div id="requestFormlistaunidadmedidaconversion">
                                {!! Form::open(['url' => 'unidadesmedidaconversion/actualizar', 'method' => 'post']) !!}
                                <table id="listaunidadmedidaconversion" class="listaunidadmedidaconversion-tabla table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Material</th>
                                            <th scope="col">Unidad de Medida</th>
                                            <th scope="col">Conversion</th>
                                        </tr>
                                    </thead>
                                    <tbody style="border-color: #ed7d31">
                                        @foreach ($unidadesmedidaconversiones as $unidadesmedidaconversion)
                                        <tr>
                                            <input hidden name="id[]" value="<?php echo $unidadesmedidaconversion->id ?>">
                                            <td>
                                                <select class="form-control tamano-texto-cuerpo-lista" id="material_id" name="material_id[<?php echo $unidadesmedidaconversion->id ?>]">
                                                    <option class="tamano-texto-cuerpo-lista" value="">--</option>
                                                    @foreach ($fmmateriales as $fmmaterial)
                                                        <option class="tamano-texto-cuerpo-lista" value="{{$fmmaterial->id}}" @if($fmmaterial->id===$unidadesmedidaconversion->material_id) selected='selected' @endif>
                                                            {{$fmmaterial->nombre}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control tamano-texto-cuerpo-lista" id="unidadesmedidas_id" name="unidadesmedidas_id[<?php echo $unidadesmedidaconversion->id ?>]">
                                                    <option class="tamano-texto-cuerpo-lista" value="">--</option>
                                                    @foreach ($unidadesmedidas as $unidadesmedida)
                                                        <option class="tamano-texto-cuerpo-lista" value="{{$unidadesmedida->id}}" @if($unidadesmedida->id===$unidadesmedidaconversion->listaunidadmedida_id) selected='selected' @endif>
                                                            {{$unidadesmedida->nombre}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input class="form-control tamano-texto-cuerpo-lista" type="text" name="conversion[<?php echo $unidadesmedidaconversion->id ?>]" value="<?php echo $unidadesmedidaconversion->conversion ?>"></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @can('unidadesmedidaconversion.actualizarunidadesmedidaconversion')
                                    <button type="submit" name="actualizarlistaunidadmedidaconversion" class="btn btn-success tamano-texto-cuerpo-boton">Guardar Unidades de Conversion</button>
                                @endcan
                                {!! Form::close() !!}
                            </div>
                        
                            <div style="display:none" id="memberFormlistaunidadmedidaconversion">
                                <form action="{{route('unidadesmedidaconversion.registrarunidadesmedidaconversion')}}" method="POST">
                                    @csrf
                                    <table class="listaunidadmedidaconversion-tabla table table-bordered" id="tablalistaunidadmedidaconversion">
                                        <thead>
                                            <tr>
                                                <th scope="col">Material</th>
                                                <th scope="col">Unidad de Medida</th>
                                                <th scope="col">Conversion</th>
                                            </tr>
                                        </thead>
                                        <tbody style="border-color: #ed7d31">
                                            <tr class="fila-fija-listaunidadmedidaconversion">
                                                <td>
                                                    <select required name="material_id[]" class="form-select tamano-texto-cuerpo-lista" aria-label="Default select example">
                                                        <option class="tamano-texto-cuerpo-lista" value="">--</option>
                                                        @foreach ($fmmateriales as $fmmaterial)
                                                            <option class="tamano-texto-cuerpo-lista" value="{{$fmmaterial->id}}">
                                                                {{$fmmaterial->nombre}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select required name="unidadesmedidas_id[]" class="form-select tamano-texto-cuerpo-lista" aria-label="Default select example">
                                                        <option class="tamano-texto-cuerpo-lista" value="">--</option>
                                                        @foreach ($unidadesmedidas as $unidadesmedida)
                                                            <option class="tamano-texto-cuerpo-lista" value="{{$unidadesmedida->id}}">
                                                                {{$unidadesmedida->nombre}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input required name="conversion[]" placeholder="Conversion" class="form-control tamano-texto-cuerpo-lista"/></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="btn-der">
                                        @can('unidadesmedidaconversion.registrarunidadesmedidaconversion')
                                            <button type="submit" name="insertarlistaunidadmedidaconversion" class="btn btn-primary tamano-texto-cuerpo-boton">Insertar Unidades de Conversion</button>
                                        @endcan
                                        <button id="adicionallistaunidadmedidaconversion" name="adicionallistaunidadmedidaconversion" type="button" class="btn btn-warning"> More + </button>
                                        <button id="eliminarlistaunidadmedidaconversion" name="eliminarlistaunidadmedidaconversion" type="button" class="btn btn-danger"> Less - </button>
                                    </div>
                                </form>
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
    <script type="text/javascript" src="{{asset('js/unidadmedidaconversion.js')}}"></script>
@endsection