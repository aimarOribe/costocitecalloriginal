<div class="gif-subtituloempleados">
    <div>
        <p>3.1</p>
    </div>
    <div>
        <p style="text-align: center">Costos de Mano de Obra Indirecta - Distribuidos Producción Mensual</p>
    </div>
    <div>
        <input style="background-color: #2f5496" disabled class="form-control costomanoobrasinbeneficios" type="text">
    </div>
</div>

<br>

<div class="margenes-botones">
    <button type="button" class="btn btn-success btn-sm tamano-texto-cuerpo-boton" value="1" onClick="displayFormgifempleadosconsinbeneficios(this)">See Workforce</button>
    <button type="button" class="btn btn-primary btn-sm tamano-texto-cuerpo-boton" value="2" onClick="displayFormgifempleadosconsinbeneficios(this)">Register Workforce</button>
    {{-- <button type="button" class="btn btn-info btn-sm tamano-texto-cuerpo-boton" data-toggle="modal" data-target="#EjemploModal">Regimen Laboral</button> --}}
    <button type="button" class="btn btn-info btn-sm tamano-texto-cuerpo-boton" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Regimen Laboral
    </button>
</div>

<div id="requestFormempleadosconsinbeneficios">
    {!! Form::open(['url' => 'gifmanoobrasinbeneficios/actualizar', 'method' => 'post']) !!}
    <table id="empleadosconsinbeneficios" class="empleadosconsinbeneficios-tabla table table-bordered">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Sueldo  Mensual en Planilla</th>
                <th scope="col">N° de trabajadores</th>
                <th scope="col">Regimen Laboral</th>
                <th scope="col">Total Gasto Mensual</th>
            </tr>
        </thead>
        <tbody class="cuerpopadregif">
            <?php $i = 0; ?>
            @foreach ($gifempleadossinbeneficios as $gifempleadossinbeneficio)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $gifempleadossinbeneficio->id ?>">
                    <td><input type="text" class="nombre-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="nombre[<?php echo $gifempleadossinbeneficio->id ?>]" value="<?php echo $gifempleadossinbeneficio->nombre ?>"></td>
                    <td><input class="sueldo-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="sueldo[<?php echo $gifempleadossinbeneficio->id ?>]" value="<?php echo $gifempleadossinbeneficio->sueldo ?>"></td>
                    <td><input type="number" class="ntrabajadores-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="ntrabajadores[<?php echo $gifempleadossinbeneficio->id ?>]" value="<?php echo $gifempleadossinbeneficio->ntrabajadores ?>"></td>
                    <td>
                        <select class="regimenlaboral-<?php echo $i ?> form-control" name="regimenlaboral_id[<?php echo $gifempleadossinbeneficio->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($regimenlaborales as $regimenlaboral)
                                <option class="tamano-texto-cuerpo-lista" value="{{$regimenlaboral->numero}}" @if($regimenlaboral->id===$gifempleadossinbeneficio->regimenlaboral_id) selected='selected' @endif>
                                    {{$regimenlaboral->nombre}} -> {{$regimenlaboral->numero}}%
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input disabled class="totalgastomensual-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gif.actualizar')
        <input type="submit" name="actualizarempleadosconsinbeneficios" value="Update Workforce" class="btn btn-warning tamano-texto-cuerpo-boton"/>
    @endcan
    
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormempleadosconsinbeneficios">
    <form action="{{route('gifmanoobrasinbeneficios.registrargifmanoobrasinbeneficios')}}" method="POST">
        @csrf
        <table class="empleadosconsinbeneficios-tabla table table-bordered" id="tabla">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Sueldo  Mensual en Planilla</th>
                    <th scope="col">N° de trabajadores</th>
                    <th scope="col">Regimen Laboral</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input required type="text" class="form-control tamano-texto-cuerpo-lista" name="nombre"></td>
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="sueldo"></td>
                    <td><input required type="number" class="form-control tamano-texto-cuerpo-lista" name="ntrabajadores"></td>
                    <td>
                        <select required class="form-control" name="regimenlaboral_id">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($regimenlaborales as $regimenlaboral)
                                <option class="tamano-texto-cuerpo-lista" value="{{$regimenlaboral->id}}">
                                    {{$regimenlaboral->nombre}} -> {{$regimenlaboral->numero}}%
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            @can('gi.registrar')
                <input type="submit" name="insertarempleadosconsinbeneficios" value="Insert Workforce" class="btn btn-info"/>
            @endcan
        </div>
    </form>
</div>

{{-- MODAL DE REGIMEN LABORAL SIN BENEFICIO --}}
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="EjemploModalLabel">Regimen Laboral</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="margenes-botones">
                <button type="button" class="btn btn-success btn-sm tamano-texto-cuerpo-boton" value="1" onClick="displayFormgifempleadosconsinbeneficiosmodal(this)">Ver Regimenes Laborales</button>
                <button type="button" class="btn btn-primary btn-sm tamano-texto-cuerpo-boton" value="2" onClick="displayFormgifempleadosconsinbeneficiosmodal(this)">Registrar Regimen Laboral</button>
            </div>

            <div id="requestFormempleadosconsinbeneficiosmodal">
                {!! Form::open(['url' => 'gifmanoobrasinbeneficiosmodal/actualizar', 'method' => 'post']) !!}
                    <table id="empleadosconsinbeneficiosmodal" class="empleadosconsinbeneficiosmodal-tabla table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Numero</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($regimenlaborales as $regimenlaboral)
                                <tr>
                                    <input hidden name="id[]" value="<?php echo $regimenlaboral->id ?>">
                                    <td><input type="text" class="form-control tamano-texto-cuerpo-lista" name="nombre[<?php echo $regimenlaboral->id ?>]" value="<?php echo $regimenlaboral->nombre ?>"></td>
                                    <td><input class="form-control familianumeroslista tamano-texto-cuerpo-lista" name="numero[<?php echo $regimenlaboral->id ?>]" value="<?php echo $regimenlaboral->numero ?>"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="submit" name="actualizarempleadosconsinbeneficiosmodal" value="Actualizar Regimenes Laborales" class="btn btn-warning tamano-texto-cuerpo-boton"/>
                {!! Form::close() !!}
            </div>

            <div style="display:none" id="memberFormempleadosconsinbeneficiosmodal">
                {!! Form::open(['url' => 'gifmanoobrasinbeneficiosmodal', 'method' => 'post']) !!}
                <table class="empleadosconsinbeneficiosmodal-tabla table table-bordered" id="tabla">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Numero</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input required type="text" class="form-control tamano-texto-cuerpo-lista" name="nombre"></td>
                            <td><input required class="form-control tamano-texto-cuerpo-lista" name="numero"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="btn-der">
                    <input type="submit" name="insertarempleadosconsinbeneficios" value="Insertar Regimen Laboral" class="btn btn-info"/>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
      </div>
    </div>
  </div>
{{-- MODAL DE REGIMEN LABORAL SIN BENEFICIO --}}

