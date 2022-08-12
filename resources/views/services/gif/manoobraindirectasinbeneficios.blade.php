<div class="gif-subtituloempleados">
    <div>
        <p>3.1</p>
    </div>
    <div>
        <p style="text-align: center">Costos de Mano de Obra Indirecta - Distribuidos Producción Mensual</p>
    </div>
    <div>
        <input readonly style="background-color: #2f5496" class="form-control costomanoobrasinbeneficios" type="text">
    </div>
</div>

<br>

<div class="margenes-botones">

    <div class="container row">
        <div class="form-check form-switch col-3">
            <input class="form-check-input" type="checkbox" role="switch" id="displayFormgifempleadosconsinbeneficios">
            <label class="form-check-label" for="displayFormgifempleadosconsinbeneficios">Ver/Registrar Mano de Obra</label>
        </div>
        <div class="col-9">
            <button type="button" class="btn btn-secondary btn-sm tamano-texto-cuerpo-boton" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Regimen Laboral
            </button>
        </div>
    </div>
    
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
                    <td><input class="sueldo-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="sueldo[<?php echo $gifempleadossinbeneficio->id ?>]" value="<?php echo $gifempleadossinbeneficio->sueldo ?>"></td>
                    <td><input type="number" class="ntrabajadores-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="ntrabajadores[<?php echo $gifempleadossinbeneficio->id ?>]" value="<?php echo $gifempleadossinbeneficio->ntrabajadores ?>"></td>
                    <td>
                        <select class="regimenlaboral-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="regimenlaboral_id[<?php echo $gifempleadossinbeneficio->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($regimenlaborales as $regimenlaboral)
                                <option class="tamano-texto-cuerpo-lista" value="{{$regimenlaboral->numero}}" @if($regimenlaboral->id===$gifempleadossinbeneficio->regimenlaboral_id) selected='selected' @endif>
                                    {{$regimenlaboral->nombre}} -> {{$regimenlaboral->numero}}%
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input disabled class="totalgastomensual-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gif.actualizar')
        <input type="submit" name="actualizarempleadosconsinbeneficios" value="Guardar Mano de Obra" class="btn btn-success tamano-texto-cuerpo-boton"/>
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
                <input type="submit" name="insertarempleadosconsinbeneficios" value="Insertar Mano de Obra" class="btn btn-primary"/>
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

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="displayFormgifempleadosconsinbeneficiosmodal">
                <label class="form-check-label" for="displayFormgifempleadosconsinbeneficiosmodal">Ver/Registrar Regimenes Laborales</label>
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
                                    <td><input class="form-control tamano-texto-cuerpo-lista" name="numero[<?php echo $regimenlaboral->id ?>]" value="<?php echo $regimenlaboral->numero ?>"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="submit" name="actualizarempleadosconsinbeneficiosmodal" value="Guardar Regimenes Laborales" class="btn btn-success tamano-texto-cuerpo-boton"/>
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
                    <input type="submit" name="insertarempleadosconsinbeneficios" value="Insertar Regimen Laboral" class="btn btn-primary"/>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
      </div>
    </div>
  </div>
{{-- MODAL DE REGIMEN LABORAL SIN BENEFICIO --}}

