<div class="gif-subtituloempleados">
    <div>
        <p>3.3</p>
    </div>
    <div>
        <p style="text-align: center">HERRAMIENTAS, MATERIALES O SUMINISTROS INDIRECTOS DE FABRICACIÓN - MENSUAL</p>
    </div>
    <div>
        <input readonly style="background-color: #2f5496" class="form-control costohmsidf" type="text">
    </div>
</div>

<br>

<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="displayFormhmsidfmodelajeseriado">
    <label class="form-check-label" for="displayFormhmsidfmodelajeseriado">Ver/Registrar Modelajes y Seriado</label>
</div>

<div id="requestFormhmsidfmodelajeseriado">
    {!! Form::open(['url' => 'gifhmsiefmodelajeseriado/actualizar', 'method' => 'post']) !!}
    <table id="hmsidfmodelajeseriado" class="hmsidfmodelajeseriado-tabla table table-bordered">
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
                <th class="tipohmsief" scope="col">MODELAJE Y SERIADO</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="cuerpopadregifmodelajeseriado">
            <?php $i = 0; ?>
            @foreach ($hmsiefmodelajeseriados as $hmsiefmodelajeseriado)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $hmsiefmodelajeseriado->id ?>">
                    <td><input hidden type="text"></td>
                    <td><input type="text" class="modelajeseriadodescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $hmsiefmodelajeseriado->id ?>]" value="<?php echo $hmsiefmodelajeseriado->descripcion ?>"></td>
                    <td>
                        <select class="modelajeseriadounidadmedida-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="listaunidadmedida_id[<?php echo $hmsiefmodelajeseriado->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($unidaddemedidas as $unidaddemedida)
                                <option class="tamano-texto-cuerpo-lista" value="{{$unidaddemedida->id}}" @if($unidaddemedida->id===$hmsiefmodelajeseriado->listaunidadmedida_id) selected='selected' @endif>
                                    {{$unidaddemedida->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input class="modelajeseriadovalorunitario-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="valorunitario[<?php echo $hmsiefmodelajeseriado->id ?>]" value="<?php echo $hmsiefmodelajeseriado->valorunitario ?>"></td>
                    <td><input type="number" class="modelajeseriadoconsumo-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="consumo[<?php echo $hmsiefmodelajeseriado->id ?>]" value="<?php echo $hmsiefmodelajeseriado->consumo ?>"></td>
                    <td><input type="number" class="modelajeseriadocantidadmeses-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="cantidadmeses[<?php echo $hmsiefmodelajeseriado->id ?>]" value="<?php echo $hmsiefmodelajeseriado->cantidadmeses ?>"></td>
                    <td><input disabled class="totalgastomensualmodelajeseriado-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gif.actualizar')
        <input type="submit" name="actualizarhmsidfmodelajeseriado" value="Guardar Modelajes y Seriado" class="btn btn-success tamano-texto-cuerpo-boton"/>
    @endcan
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormhmsidfmodelajeseriado">
    <form action="{{route('gifhmsiefmodelajeseriado.registrargifhmsiefmodelajeseriado')}}" method="POST">
        @csrf
        <table class="hmsidfmodelajeseriado-tabla table table-bordered" id="tabla">
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
                    <th class="tipohmsief" scope="col">MODELAJE Y SERIADO</th>
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
                        <select required class="form-control tamano-texto-cuerpo-lista" name="listaunidadmedida_id">
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
                <input type="submit" name="insertarhmsidfmodelajeseriado" value="Insertar Modelaje y Seriado" class="btn btn-primary"/>
            @endcan
        </div>
    </form>
</div>