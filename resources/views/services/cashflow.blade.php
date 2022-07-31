@extends('layouts.template')

@section('title','Flujo de Caja')

@section('css')
    <link rel="stylesheet" href="{{asset('css/flujocaja.css')}}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css"> --}}
@endsection

@section('content')
    @if (auth()->user()->can('flujodecajas.inicio'))
        <div class="margen-principal">
            <div class="card">
                <div class="card-body">
                    <div class="margenes-botones">
                        <input class="form-check-input" value="1" type="radio" name="formselector" onClick="displayForm(this)" id="checkAactualizarFlujoCaja" checked>
                        <label class="form-check-label" for="checkAactualizarFlujoCaja">
                            Update
                        </label>  
                        
                        <input class="form-check-input" value="2" type="radio" name="formselector" onClick="displayForm(this)" id="checkRegistrarFlujoCaja">
                        <label class="form-check-label" for="checkRegistrarFlujoCaja">
                            Register
                        </label>
                    </div>

                    <div id="requestFormFlujoCaja">
                        {!! Form::open(['url' => 'flujodecajas/actualizar', 'method' => 'post']) !!}
                        <table class="flujocaja-tabla table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="8" class="titulo-flujocaja">FLUJO DE CAJA</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="subtitulo-flujocaja-metalica">TOTAL</th>
                                    <th class="subtitulo-flujocaja">S/-</th>
                                    <th class="subtitulo-flujocaja">S/100.00</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th scope="col">MES</th>
                                    <th scope="col">FECHA</th>
                                    <th scope="col">CLASIFICACIÓN</th>
                                    <th scope="col">DETALLE</th>
                                    <th scope="col">RESPONSABLE</th>
                                    <th scope="col" style="background-color: #548235">INGRESO <?php echo "<br/>" ?> (S/.)</th>
                                    <th scope="col" style="background-color: #c65911">EGRESO <?php echo "<br/>" ?> (S/.)</th>
                                    <th scope="col">DOCUMENTO</th>
                                </tr>
                            </thead>
                            <tbody style="border-color: #5b9bd5">
                                @foreach ($flujocajas as $flujocaja)
                                    <tr>
                                        <input hidden name="id[]" value="<?php echo $flujocaja->id ?>">
                                        <td><input type="month" class="form-control fujocajatextolista tamano-texto-cuerpo-lista" name="mes[<?php echo $flujocaja->id ?>]" value="<?php echo $flujocaja->mes ?>"></td>
                                        <td><input type="date" class="form-control fujocajatextolista tamano-texto-cuerpo-lista" name="fecha[<?php echo $flujocaja->id ?>]" value="<?php echo $flujocaja->fecha ?>"></td>
                                        <td>
                                            <select class="form-control fujocajatextolista" id="clasificacion_id" name="clasificacion_id[<?php echo $flujocaja->id ?>]">
                                                <option class="tamano-texto-cuerpo-lista" value="">--</option>
                                                @foreach ($clasificaciones as $clasificacion)
                                                    <option class="tamano-texto-cuerpo-lista" value="{{$clasificacion->id}}" @if($clasificacion->id===$flujocaja->clasificacion_id) selected='selected' @endif>
                                                        {{$clasificacion->nombre}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input class="form-control fujocajatextolista tamano-texto-cuerpo-lista" name="detalle[<?php echo $flujocaja->id ?>]" value="<?php echo $flujocaja->detalle ?>"></td>
                                        <td><input class="form-control fujocajatextolista tamano-texto-cuerpo-lista" name="responsable[<?php echo $flujocaja->id ?>]" value="<?php echo $flujocaja->responsable ?>"></td>
                                        <td style="background-color: #c6e0b4"><input class="form-control fujocajatextoPlatalista tamano-texto-cuerpo-lista" name="ingreso[<?php echo $flujocaja->id ?>]" value="<?php echo $flujocaja->ingreso ?>"></td>
                                        <td style="background-color: #f4b084"><input class="form-control fujocajatextoPlatalista tamano-texto-cuerpo-lista" name="egreso[<?php echo $flujocaja->id ?>]" value="<?php echo $flujocaja->egreso ?>"></td>
                                        <td><input class="form-control fujocajatextolista tamano-texto-cuerpo-lista" name="documento[<?php echo $flujocaja->id ?>]" value="<?php echo $flujocaja->documento ?>"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @can('flujodecajas.actualizar')
                            <input type="submit" name="actualizarFlujoCaja" value="Update Cash Flow" class="btn btn-warning tamano-texto-cuerpo-boton"/>
                        @endcan
                        
                        {!! Form::close() !!}
                    </div>
                    
                    <div style="display:none" id="memberFormFlujoCaja">
                        <form action="{{route('flujodecajas.registrar')}}" method="POST">
                            @csrf
                            <table class="flujocaja-tabla table table-bordered" id="tabla">
                                <tr class="fila-fija">
                                    <td><input type="month" required name="mes[]" placeholder="Mes" class="form-control tamano-texto-cuerpo-lista"/></td>
                                    <td><input type="date" required name="fecha[]" placeholder="Fecha" class="form-control tamano-texto-cuerpo-lista"/></td>
                                    <td>
                                        <select name="clasificacion_id[]" class="form-select" aria-label="Default select example">
                                            <option>--</option>
                                            @foreach ($clasificaciones as $clasificacion)
                                                <option value="{{$clasificacion->id}}">
                                                    {{$clasificacion->nombre}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input required name="detalle[]" placeholder="Detalle" class="form-control tamano-texto-cuerpo-lista"/></td>
                                    <td><input required name="responsable[]" placeholder="Responsable" class="form-control tamano-texto-cuerpo-lista"/></td>
                                    <td><input required name="ingreso[]" placeholder="Ingreso" class="form-control tamano-texto-cuerpo-lista"/></td>
                                    <td><input required name="egreso[]" placeholder="Egreso" class="form-control tamano-texto-cuerpo-lista"/></td>
                                    <td><input required name="documento[]" placeholder="Documento" class="form-control tamano-texto-cuerpo-lista"/></td>
                                </tr>
                            </table>
                            <div class="btn-der">
                                @can('flujodecajas.registrar')
                                    <input type="submit" name="insertarFlujoCaja" value="Insert Cash Flow" class="btn btn-info"/>
                                @endcan
                                <button id="adicionalFlujoCaja" name="adicionalFlujoCaja" type="button" class="btn btn-warning"> More + </button>
                                <button id="eliminarFlujoCaja" name="eliminarFlujoCaja" type="button" class="btn btn-danger"> Less - </button>
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
    <script type="text/javascript" src="{{asset('js/flujocaja.js')}}"></script>
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $('#familias').DataTable({
            searching: false,
            responsive: true,
            autoWidth: false
        });
    </script> --}}
@endsection