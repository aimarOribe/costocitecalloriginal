@extends('layouts.template')

@section('title','Modelos e Insumos')

@section('css')
    <link rel="stylesheet" href="{{asset('css/fmatemateriales.css')}}">
@endsection

@section('content')
    @if (auth()->user()->can('familiamaterialesmateriales.inicio'))
        <div class="container margen-listas">
            <div class="margen-principal">
                <div class="card" style="padding: 20px">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 offset-md-12 col-lg-12 offset-lg-0">

                            @if (session('errorUserMateriales'))
                                <div class="alert alert-warning" role="alert">
                                    {{session('errorUserMateriales')}}
                                </div>
                            @endif
                        
                            @if (session('mensajemateriales'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{session('mensajemateriales')}}!</strong>
                                    <button type="button" class="close btn btn-success btn-sm" data-dismiss="alert" aria-label="Close">
                                        x
                                    </button>
                                </div>
                            @endif  

                            <div class="margenes-botones">
                                <button type="button" class="btn btn-success btn-sm tamano-texto-cuerpo-boton" value="1" onClick="displayFormfmmateriales(this)">See Materials</button>
                                <button type="button" class="btn btn-primary btn-sm tamano-texto-cuerpo-boton" value="2" onClick="displayFormfmmateriales(this)">Register Material</button>
                            </div>
                        
                            <div id="requestFormfmmateriales">
                                {!! Form::open(['url' => 'familiamaterialesmateriales/actualizar', 'method' => 'post']) !!}
                                <table id="fmmateriales" class="fmmateriales-tabla table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Familia de Materiales</th>
                                            <th scope="col">Material</th>
                                            <th scope="col">Unidad de Medida</th>
                                        </tr>
                                    </thead>
                                    <tbody style="border-color: #ed7d31">
                                        @foreach ($fmmateriales as $fmmateriale)
                                        <tr>
                                            <input hidden name="id[]" value="<?php echo $fmmateriale->id ?>">
                                            <td>
                                                <select class="form-control" id="familiamateriales_id" name="familiamateriales_id[<?php echo $fmmateriale->id ?>]">
                                                    <option class="tamano-texto-cuerpo-lista" value="--">--</option>
                                                    @foreach ($familiasmateriales as $familiasmaterial)
                                                        <option class="tamano-texto-cuerpo-lista" value="{{$familiasmaterial->id}}" @if($familiasmaterial->id===$fmmateriale->familiamateriales_id) selected='selected' @endif>
                                                            {{$familiasmaterial->nombre}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input class="form-control tamano-texto-cuerpo-lista" type="text" name="nombre[<?php echo $fmmateriale->id ?>]" value="<?php echo $fmmateriale->nombre ?>"></td>
                                            <td>
                                                <select class="form-control" id="unidadesmedidas_id" name="unidadesmedidas_id[<?php echo $fmmateriale->id ?>]">
                                                    <option class="tamano-texto-cuerpo-lista" value="--">--</option>
                                                    @foreach ($unidadesmedidas as $unidadesmedida)
                                                        <option class="tamano-texto-cuerpo-lista" value="{{$unidadesmedida->id}}" @if($unidadesmedida->id===$fmmateriale->listaunidadmedida_id) selected='selected' @endif>
                                                            {{$unidadesmedida->nombre}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @can('familiamaterialesmateriales.actualizarfamiliamaterialesmateriales')
                                    <button type="submit" name="actualizarModelosInsumosModelos" class="btn btn-warning boton-actualizar tamano-texto-cuerpo-boton">Update<?php echo "<br/>" ?>Materials</button>
                                @endcan
                                {!! Form::close() !!}
                            </div>
                        
                            <div style="display:none" id="memberFormfmmateriales">
                                <form action="{{route('familiamaterialesmateriales.registrarfamiliamaterialesmateriales')}}" method="POST">
                                    @csrf
                                    <table class="fmmateriales-tabla table table-bordered" id="tablafmmateriales">
                                        <thead>
                                            <tr>
                                                <th scope="col">Familia de Materiales</th>
                                                <th scope="col">Material</th>
                                                <th scope="col">Unidad de Medida</th>
                                            </tr>
                                        </thead>
                                        <tbody style="border-color: #ed7d31">
                                            <tr class="fila-fija-fmmateriales">
                                                <td>
                                                    <select name="familiamateriales_id[]" class="form-select" aria-label="Default select example">
                                                        <option>--</option>
                                                        @foreach ($familiasmateriales as $familiasmaterial)
                                                            <option value="{{$familiasmaterial->id}}">
                                                                {{$familiasmaterial->nombre}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input required name="nombre[]" placeholder="Nombre" class="form-control tamano-texto-cuerpo-lista"/></td>
                                                <td>
                                                    <select name="unidadesmedidas_id[]" class="form-select" aria-label="Default select example">
                                                        <option>--</option>
                                                        @foreach ($unidadesmedidas as $unidadesmedida)
                                                            <option value="{{$unidadesmedida->id}}">
                                                                {{$unidadesmedida->nombre}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="btn-der">
                                        @can('familiamaterialesmateriales.registrarfamiliamaterialesmateriales')
                                            <button type="submit" name="insertarfmmateriales" class="btn btn-info tamano-texto-cuerpo-boton">Insert<?php echo "<br/>" ?>Materials</button>
                                        @endcan
                                        <button id="adicionalfmmateriales" name="adicionalfmmateriales" type="button" class="btn btn-warning"> More + </button>
                                        <button id="eliminarfmmateriales" name="eliminarfmmateriales" type="button" class="btn btn-danger"> Less - </button>
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
    <script type="text/javascript" src="{{asset('js/fmatemateriales.js')}}"></script>
@endsection