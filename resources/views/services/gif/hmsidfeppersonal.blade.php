<div class="margenes-botones">
    <input class="form-check-input" value="1" type="radio" name="formselector" onClick="displayFormhmsidfeppersonal(this)" id="checkAactualizar" checked>
    <label class="form-check-label" for="checkActualizar">
        Update
    </label>  
    
    <input class="form-check-input" value="2" type="radio" name="formselector" onClick="displayFormhmsidfeppersonal(this)" id="checkRegistrar">
    <label class="form-check-label" for="checkRegistrar">
        Register
    </label>
</div>

<div id="requestFormhmsidfeppersonal">
    {!! Form::open(['url' => 'gifhmsiefeppersonal/actualizar', 'method' => 'post']) !!}
    <table id="hmsidfeppersonal" class="hmsidfeppersonal-tabla table table-bordered">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Descripción del Material</th>
                <th scope="col">Unidad De Medida</th>
                <th scope="col">Valor Unit</th>
                <th scope="col">Consumo</th>
                <th scope="col">Cantidad de Meses</th>
                <th scope="col">Consumo por mes</th>
            </tr>
            <tr class="tipos" style="background-color: #c6c6c6">
                <th class="tipohmsief" scope="col">EQUIPO DE PROTECCION PERSONAL</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="cuerpopadregifhmsidfeppersonal">
            <?php $i = 0; ?>
            @foreach ($hmsiefeppersonales as $hmsiefeppersonal)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $hmsiefeppersonal->id ?>">
                    <td><input hidden type="text"></td>
                    <td><input type="text" class="hmsidfeppersonaldescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $hmsiefeppersonal->id ?>]" value="<?php echo $hmsiefeppersonal->descripcion ?>"></td>
                    <td>
                        <select class="hmsidfeppersonalunidadmedida-<?php echo $i ?> form-control" name="listaunidadmedida_id[<?php echo $hmsiefeppersonal->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($unidaddemedidas as $unidaddemedida)
                                <option class="tamano-texto-cuerpo-lista" value="{{$unidaddemedida->id}}" @if($unidaddemedida->id===$hmsiefeppersonal->listaunidadmedida_id) selected='selected' @endif>
                                    {{$unidaddemedida->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input class="hmsidfeppersonalvalorunitario-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="valorunitario[<?php echo $hmsiefeppersonal->id ?>]" value="<?php echo $hmsiefeppersonal->valorunitario ?>"></td>
                    <td><input type="number" class="hmsidfeppersonalconsumo-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="consumo[<?php echo $hmsiefeppersonal->id ?>]" value="<?php echo $hmsiefeppersonal->consumo ?>"></td>
                    <td><input type="number" class="hmsidfeppersonalcantidadmeses-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="cantidadmeses[<?php echo $hmsiefeppersonal->id ?>]" value="<?php echo $hmsiefeppersonal->cantidadmeses ?>"></td>
                    <td><input disabled class="totalgastomensualhmsidfeppersonal-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gif.actualizar')
        <input type="submit" name="actualizarhmsidfeppersonal" value="Update armed" class="btn btn-warning tamano-texto-cuerpo-boton"/>
    @endcan
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormhmsidfeppersonal">
    <form action="{{route('gifhmsiefeppersonal.registrargifhmsiefeppersonal')}}" method="POST">
        @csrf
        <table class="hmsidfeppersonal-tabla table table-bordered" id="tabla">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Descripción del Material</th>
                    <th scope="col">Unidad De Medida</th>
                    <th scope="col">Valor Unit</th>
                    <th scope="col">Consumo</th>
                    <th scope="col">Cantidad de Meses</th>
                </tr>
                <tr class="tipos" style="background-color: #c6c6c6">
                    <th class="tipohmsief" scope="col">EQUIPO DE PROTECCION PERSONAL</th>
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
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="valorunitario"></td>
                    <td><input required type="number" class="form-control tamano-texto-cuerpo-lista" name="consumo"></td>
                    <td><input required type="number" class="form-control tamano-texto-cuerpo-lista" name="cantidadmeses"></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            @can('gi.registrar')
                <input type="submit" name="insertarhmsidfeppersonal" value="Insert armed" class="btn btn-info"/>
            @endcan
        </div>
    </form>
</div>