@extends('layouts.template')

@section('title','Mano de Obra')

@section('css')
    <link rel="stylesheet" href="{{asset('css/manoobra.css')}}">
@endsection

@section('content')
    @if (auth()->user()->can('manoobra.inicio'))
        <div class="margen-principal">
            <div class="card">
                <div class="card-body">
                    <div class="margenes-botones">
                        <input class="form-check-input" value="1" type="radio" name="formselector" onClick="displayFormManoObra(this)" id="checkAactualizar" checked>
                        <label class="form-check-label" for="checkActualizar">
                            Update
                        </label>  
                        
                        <input class="form-check-input" value="2" type="radio" name="formselector" onClick="displayFormManoObra(this)" id="checkRegistrar">
                        <label class="form-check-label" for="checkRegistrar">
                            Register
                        </label>
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
                            <tbody style="border-color: #ed7d31">
                                @foreach ($manoobras as $manoobra)
                                    <tr>
                                        <input hidden name="id[]" value="<?php echo $manoobra->id ?>">
                                        <td>
                                            <select class="form-control" id="familia_id" name="familia_id[<?php echo $manoobra->id ?>]">
                                                <option class="tamano-texto-cuerpo-lista" value="">--</option>
                                                @foreach ($familias as $familia)
                                                    <option class="tamano-texto-cuerpo-lista" value="{{$familia->id}}" @if($familia->id===$manoobra->familia_id) selected='selected' @endif>
                                                        {{$familia->nombre}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input class="form-control tamano-texto-cuerpo-lista" name="familia_id[<?php echo $familia->id ?>]" value="<?php echo $familia->nombre ?>"></td>
                                        <td><input class="form-control tamano-texto-cuerpo-lista" name="capprosemdocenas[<?php echo $familia->id ?>]" value="<?php echo $familia->capprosemdocenas ?>"></td>
                                        <td><input class="form-control tamano-texto-cuerpo-lista" name="capprodmensual[<?php echo $familia->id ?>]" value="<?php echo $familia->capprodmensual ?>"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @can('manoobra.actualizarmanoobra')
                            <input type="submit" name="actualizar" value="Update HandWork" class="btn btn-warning tamano-texto-cuerpo-boton"/>
                        @endcan
                        {!! Form::close() !!}
                    </div>
                    
                    <div style="display:none" id="memberFormManoObra">
                        <form action="{{route('manoobra.registrarmanoobra')}}" method="POST">
                            @csrf
                            <table class="manoobra-tabla table table-bordered" id="tablaManoObra">
                                <tr class="fila-fija-manoObra">
                                    <td>
                                        <select name="familia_id[]" id="familiaSeleccionado" class="form-select" aria-label="Default select example">
                                            <option>--</option>
                                            @foreach ($familias as $familia)
                                                <option value="{{$familia->id}}">
                                                    {{$familia->nombre}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>  
                                    <td>
                                        <select name="modelo_id[]" id="modeloSeleccionado" class="form-select" aria-label="Default select example">
                                            <option>--</option>
                                            @foreach ($modelos as $modelo)
                                                <option value="{{$modelo->id}}">
                                                    {{$modelo->modelo}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>                                    
                                    <td>
                                        <select name="proceso_id[]" class="form-select" aria-label="Default select example">
                                            <option>--</option>
                                            @foreach ($procesos as $proceso)
                                                <option value="{{$proceso->id}}">
                                                    {{$proceso->nombre}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>   
                                    <td><input required name="tiempohoras[]" placeholder="Tiempo en horas" class="form-control tamano-texto-cuerpo-lista"/></td>
                                    <td><input required name="costo[]" placeholder="Costo" class="form-control tamano-texto-cuerpo-lista"/></td>
                                </tr>
                            </table>
                            <div class="btn-der">
                                @can('manoobra.registrarmanoobra')
                                    <input type="submit" name="insertarManoObra" value="Insert HandWork" class="btn btn-info"/>
                                @endcan
                                <button id="adicionalManoObra" name="adicionalManoObra" type="button" class="btn btn-warning"> More + </button>
                                <button id="eliminarManoObra" name="eliminarManoObra" type="button" class="btn btn-danger"> Less - </button>
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
    <script type="text/javascript" src="{{asset('js/manoobra.js')}}"></script>
@endsection