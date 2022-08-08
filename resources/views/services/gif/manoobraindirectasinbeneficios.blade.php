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
    <input class="form-check-input" value="1" type="radio" name="formselector" onClick="displayFormgifempleadosconsinbeneficios(this)" id="checkAactualizar" checked>
    <label class="form-check-label" for="checkActualizar">
        Update
    </label>  
    
    <input class="form-check-input" value="2" type="radio" name="formselector" onClick="displayFormgifempleadosconsinbeneficios(this)" id="checkRegistrar">
    <label class="form-check-label" for="checkRegistrar">
        Register
    </label>
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
        <input type="submit" name="actualizarempleadosconsinbeneficios" value="Update Indirect labor" class="btn btn-warning tamano-texto-cuerpo-boton"/>
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
                <input type="submit" name="insertarempleadosconsinbeneficios" value="Insert Indirect labor" class="btn btn-info"/>
            @endcan
        </div>
    </form>
</div>