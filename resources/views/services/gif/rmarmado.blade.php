<div class="margenes-botones">
    <input class="form-check-input" value="1" type="radio" name="formselector" onClick="displayFormrmarmado(this)" id="checkAactualizar" checked>
    <label class="form-check-label" for="checkActualizar">
        Update
    </label>  
    
    <input class="form-check-input" value="2" type="radio" name="formselector" onClick="displayFormrmarmado(this)" id="checkRegistrar">
    <label class="form-check-label" for="checkRegistrar">
        Register
    </label>
</div>

<div id="requestFormrmarmado">
    {!! Form::open(['url' => 'gifrmarmado/actualizar', 'method' => 'post']) !!}
    <table id="rmarmado" class="rmarmado-tabla table table-bordered">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Descripción del Material</th>
                <th scope="col">Unidad De Medida</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Gasto Por Mantenimiento</th>
                <th scope="col">Frecuencia Anual</th>
                <th scope="col">Costo Mensual</th>
            </tr>
            <tr class="tipos" style="background-color: #c6c6c6">
                <th class="tipohmsief" scope="col">ARMADO</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="cuerpopadregifrmarmado">
            <?php $i = 0; ?>
            @foreach ($rmarmados as $rmarmado)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $rmarmado->id ?>">
                    <td><input hidden type="text"></td>
                    <td><input type="text" class="rmarmadodescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $rmarmado->id ?>]" value="<?php echo $rmarmado->descripcion ?>"></td>
                    <td>
                        <select class="rmarmadounidadmedida-<?php echo $i ?> form-control" name="listaunidadmedida_id[<?php echo $rmarmado->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($unidaddemedidas as $unidaddemedida)
                                <option class="tamano-texto-cuerpo-lista" value="{{$unidaddemedida->id}}" @if($unidaddemedida->id===$rmarmado->listaunidadmedida_id) selected='selected' @endif>
                                    {{$unidaddemedida->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input class="rmarmadocantidad-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="cantidad[<?php echo $rmarmado->id ?>]" value="<?php echo $rmarmado->cantidad ?>"></td>
                    <td><input type="number" class="rmarmadogastomanetenimiento-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="gastomantenimiento[<?php echo $rmarmado->id ?>]" value="<?php echo $rmarmado->gastomantenimiento ?>"></td>
                    <td><input type="number" class="rmarmadofrecuenciaanual-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="frecuenciaanual[<?php echo $rmarmado->id ?>]" value="<?php echo $rmarmado->frecuenciaanual ?>"></td>
                    <td><input disabled class="totalgastomensualrmarmado-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gif.actualizar')
        <input type="submit" name="actualizarrmarmado" value="Update armed" class="btn btn-warning tamano-texto-cuerpo-boton"/>
    @endcan
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormrmarmado">
    <form action="{{route('gifrmarmado.registrargifrmarmado')}}" method="POST">
        @csrf
        <table class="rmarmado-tabla table table-bordered" id="tabla">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Descripción del Material</th>
                    <th scope="col">Unidad De Medida</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Gasto Por Mantenimiento</th>
                    <th scope="col">Frecuencia Anual</th>
                </tr>
                <tr class="tipos" style="background-color: #c6c6c6">
                    <th class="tipohmsief" scope="col">ARMADO</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input hidden type="text"></td>
                    <td><input required type="text" class="form-control tamano-texto-cuerpo-lista" name="descripcion"></td>
                    <td>
                        <select required class="form-control" name="listaunidadmedida_id">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($unidaddemedidas as $unidaddemedida)
                                <option class="tamano-texto-cuerpo-lista" value="{{$unidaddemedida->id}}">
                                    {{$unidaddemedida->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input required type="number" class="form-control tamano-texto-cuerpo-lista" name="cantidad"></td>
                    <td><input required type="number" class="form-control tamano-texto-cuerpo-lista" name="gastomantenimiento"></td>
                    <td><input required type="number" class="form-control tamano-texto-cuerpo-lista" name="frecuenciaanual"></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            @can('gi.registrar')
                <input type="submit" name="insertarrmarmado" value="Insert armed" class="btn btn-info"/>
            @endcan
        </div>
    </form>
</div>