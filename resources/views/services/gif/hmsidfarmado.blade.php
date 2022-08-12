<br>

<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="displayFormhmsidfarmado">
    <label class="form-check-label" for="displayFormhmsidfarmado">Ver/Registrar Armado</label>
</div>

<div id="requestFormhmsidfarmado">
    {!! Form::open(['url' => 'gifhmsiefarmado/actualizar', 'method' => 'post']) !!}
    <table id="hmsidfarmado" class="hmsidfarmado-tabla table table-bordered">
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
                <th class="tipohmsief" scope="col">ARMADO</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="cuerpopadregifhmsidfarmado">
            <?php $i = 0; ?>
            @foreach ($hmsiefarmados as $hmsiefarmado)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $hmsiefarmado->id ?>">
                    <td><input hidden type="text"></td>
                    <td><input type="text" class="hmsidfarmadodescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $hmsiefarmado->id ?>]" value="<?php echo $hmsiefarmado->descripcion ?>"></td>
                    <td>
                        <select class="hmsidfarmadounidadmedida-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="listaunidadmedida_id[<?php echo $hmsiefarmado->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($unidaddemedidas as $unidaddemedida)
                                <option class="tamano-texto-cuerpo-lista" value="{{$unidaddemedida->id}}" @if($unidaddemedida->id===$hmsiefarmado->listaunidadmedida_id) selected='selected' @endif>
                                    {{$unidaddemedida->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input class="hmsidfarmadovalorunitario-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="valorunitario[<?php echo $hmsiefarmado->id ?>]" value="<?php echo $hmsiefarmado->valorunitario ?>"></td>
                    <td><input type="number" class="hmsidfarmadoconsumo-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="consumo[<?php echo $hmsiefarmado->id ?>]" value="<?php echo $hmsiefarmado->consumo ?>"></td>
                    <td><input type="number" class="hmsidfarmadocantidadmeses-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="cantidadmeses[<?php echo $hmsiefarmado->id ?>]" value="<?php echo $hmsiefarmado->cantidadmeses ?>"></td>
                    <td><input readonly class="totalgastomensualhmsidfarmado-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gif.actualizar')
        <input type="submit" name="actualizarhmsidfarmado" value="Guardar Armado" class="btn btn-success tamano-texto-cuerpo-boton"/>
    @endcan
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormhmsidfarmado">
    <form action="{{route('gifhmsiefarmado.registrargifhmsiefarmado')}}" method="POST">
        @csrf
        <table class="hmsidfarmado-tabla table table-bordered" id="tabla">
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
                <input type="submit" name="insertarhmsidfarmado" value="Insertar Armado" class="btn btn-primary"/>
            @endcan
        </div>
    </form>
</div>