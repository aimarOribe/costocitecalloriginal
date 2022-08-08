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
    <input class="form-check-input" value="1" type="radio" name="formselector" onClick="displayFormgifempleadosconbeneficios(this)" id="checkAactualizar" checked>
    <label class="form-check-label" for="checkActualizar">
        Update
    </label>  
    
    <input class="form-check-input" value="2" type="radio" name="formselector" onClick="displayFormgifempleadosconbeneficios(this)" id="checkRegistrar">
    <label class="form-check-label" for="checkRegistrar">
        Register
    </label>
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
        <input type="submit" name="actualizarempleadosconbeneficios" value="Update Social Benefits" class="btn btn-warning tamano-texto-cuerpo-boton"/>
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
                <input type="submit" name="insertarempleadosconbeneficios" value="Insert Social Benefits" class="btn btn-info"/>
            @endcan
        </div>
    </form>
</div>