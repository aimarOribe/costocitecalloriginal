<div class="gif-subtituloempleados">
    <div>
        <p>3.2</p>
    </div>
    <div>
        <p style="text-align: center">Costo de beneficios sociales (Solo beneficios Sociales para trabajadores que perciben sueldo al destajo)</p>
    </div>
    <div>
        <input style="background-color: #2f5496" disabled class="form-control costomanoobraconbeneficios" type="text">
    </div>
</div>

<br>

<div class="margenes-botones">
    <button type="button" class="btn btn-success btn-sm tamano-texto-cuerpo-boton" value="1" onClick="displayFormgifempleadosconbeneficios(this)">See Labor with Benefits</button>
    <button type="button" class="btn btn-primary btn-sm tamano-texto-cuerpo-boton" value="2" onClick="displayFormgifempleadosconbeneficios(this)">Register Labor with Benefits</button>
    <button type="button" class="btn btn-info btn-sm tamano-texto-cuerpo-boton" data-bs-toggle="modal" data-bs-target="#modalmanoobraConBeneficios">
        Regimen Laboral
    </button>
</div>

<div id="requestFormempleadosconbeneficios">
    {!! Form::open(['url' => 'gifmanoobraconbeneficios/actualizar', 'method' => 'post']) !!}
    <table id="empleadosconbeneficios" class="empleadosconbeneficios-tabla table table-bordered">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Sueldo  Mensual en Planilla</th>
                <th scope="col">N° de trabajadores</th>
                <th scope="col">Regimen Laboral</th>
                <th scope="col">Total Gasto Mensual</th>
            </tr>
        </thead>
        <tbody class="cuerpopadregifconbeneficios">
            <?php $i = 0; ?>
            @foreach ($gifempleadosconbeneficios as $gifempleadosconbeneficio)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $gifempleadosconbeneficio->id ?>">
                    <td><input type="text" class="nombreconbeneficios-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="nombre[<?php echo $gifempleadosconbeneficio->id ?>]" value="<?php echo $gifempleadosconbeneficio->nombre ?>"></td>
                    <td><input class="sueldoconbeneficios-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="sueldo[<?php echo $gifempleadosconbeneficio->id ?>]" value="<?php echo $gifempleadosconbeneficio->sueldo ?>"></td>
                    <td><input type="number" class="ntrabajadoresconbeneficios-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="ntrabajadores[<?php echo $gifempleadosconbeneficio->id ?>]" value="<?php echo $gifempleadosconbeneficio->ntrabajadores ?>"></td>
                    <td>
                        <select class="regimenlaboralconbeneficios-<?php echo $i ?> form-control" name="regimenlaboral_id[<?php echo $gifempleadosconbeneficio->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($regimenlaboralesconbeneficios as $regimenlaboralesconbeneficio)
                                <option class="tamano-texto-cuerpo-lista" value="{{$regimenlaboralesconbeneficio->numero}}" @if($regimenlaboralesconbeneficio->id===$gifempleadosconbeneficio->regimenlaboral_id) selected='selected' @endif>
                                    {{$regimenlaboralesconbeneficio->nombre}} -> {{$regimenlaboralesconbeneficio->numero}}%
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input disabled class="totalgastomensualconBeneficio-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gif.actualizar')
        <input type="submit" name="actualizarempleadosconbeneficios" value="Update Labor with Benefits" class="btn btn-warning tamano-texto-cuerpo-boton"/>
    @endcan
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormempleadosconbeneficios">
    <form action="{{route('gifmanoobraconbeneficios.registrargifmanoobraconbeneficios')}}" method="POST">
        @csrf
        <table class="empleadosconbeneficios-tabla table table-bordered" id="tabla">
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
                            @foreach ($regimenlaboralesconbeneficios as $regimenlaboralesconbeneficio)
                                <option class="tamano-texto-cuerpo-lista" value="{{$regimenlaboralesconbeneficio->id}}">
                                    {{$regimenlaboralesconbeneficio->nombre}} -> {{$regimenlaboralesconbeneficio->numero}}%
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            @can('gi.registrar')
                <input type="submit" name="insertarempleadosconbeneficios" value="Insert Labor with Benefits" class="btn btn-info"/>
            @endcan
        </div>
    </form>
</div>

{{-- MODAL DE REGIMEN LABORAL CON BENEFICIO --}}
<div class="modal fade" id="modalmanoobraConBeneficios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="EjemploModalLabel">Regimen Laboral</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="margenes-botones">
                <button type="button" class="btn btn-success btn-sm tamano-texto-cuerpo-boton" value="1" onClick="displayFormgifempleadosconbeneficiosmodal(this)">Ver Regimenes Laborales</button>
                <button type="button" class="btn btn-primary btn-sm tamano-texto-cuerpo-boton" value="2" onClick="displayFormgifempleadosconbeneficiosmodal(this)">Registrar Regimen Laboral</button>
            </div>

            <div id="requestFormempleadosconbeneficiosmodal">
                {!! Form::open(['url' => 'gifmanoobraconbeneficiosmodal/actualizar', 'method' => 'post']) !!}
                    <table id="empleadosconsinbeneficiosmodal" class="empleadosconsinbeneficiosmodal-tabla table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Numero</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($regimenlaboralesconbeneficios as $regimenlaboralesconbeneficio)
                                <tr>
                                    <input hidden name="id[]" value="<?php echo $regimenlaboralesconbeneficio->id ?>">
                                    <td><input type="text" class="form-control tamano-texto-cuerpo-lista" name="nombre[<?php echo $regimenlaboralesconbeneficio->id ?>]" value="<?php echo $regimenlaboralesconbeneficio->nombre ?>"></td>
                                    <td><input class="form-control familianumeroslista tamano-texto-cuerpo-lista" name="numero[<?php echo $regimenlaboralesconbeneficio->id ?>]" value="<?php echo $regimenlaboralesconbeneficio->numero ?>"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="submit" name="actualizarempleadosconsinbeneficiosmodal" value="Actualizar Regimenes Laborales" class="btn btn-warning tamano-texto-cuerpo-boton"/>
                {!! Form::close() !!}
            </div>

            <div style="display:none" id="memberFormempleadosconbeneficiosmodal">
                {!! Form::open(['url' => 'gifmanoobraconbeneficiosmodal', 'method' => 'post']) !!}
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
{{-- MODAL DE REGIMEN LABORAL CON BENEFICIO --}}