<br>

<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="displayFormhmsidfalistado">
    <label class="form-check-label" for="displayFormhmsidfalistado">Ver/Registrar Alistado</label>
</div>

<div id="requestFormhmsidfalistado">
    {!! Form::open(['url' => 'gifhmsiefalistado/actualizar', 'method' => 'post']) !!}
    <table id="hmsidfalistado" class="hmsidfalistado-tabla table table-bordered">
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
                <th class="tipohmsief" scope="col">ALISTADO</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="cuerpopadregifhmsidfalistado">
            <?php $i = 0; ?>
            @foreach ($hmsiefalistados as $hmsiefalistado)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $hmsiefalistado->id ?>">
                    <td><input hidden type="text"></td>
                    <td><input type="text" class="hmsidfalistadodescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $hmsiefalistado->id ?>]" value="<?php echo $hmsiefalistado->descripcion ?>"></td>
                    <td>
                        <select class="hmsidfalistadounidadmedida-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="listaunidadmedida_id[<?php echo $hmsiefalistado->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($unidaddemedidas as $unidaddemedida)
                                <option class="tamano-texto-cuerpo-lista" value="{{$unidaddemedida->id}}" @if($unidaddemedida->id===$hmsiefalistado->listaunidadmedida_id) selected='selected' @endif>
                                    {{$unidaddemedida->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input class="hmsidfalistadovalorunitario-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="valorunitario[<?php echo $hmsiefalistado->id ?>]" value="<?php echo $hmsiefalistado->valorunitario ?>"></td>
                    <td><input type="number" class="hmsidfalistadoconsumo-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="consumo[<?php echo $hmsiefalistado->id ?>]" value="<?php echo $hmsiefalistado->consumo ?>"></td>
                    <td><input type="number" class="hmsidfalistadocantidadmeses-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="cantidadmeses[<?php echo $hmsiefalistado->id ?>]" value="<?php echo $hmsiefalistado->cantidadmeses ?>"></td>
                    <td><input readonly class="totalgastomensualhmsidfalistado-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <input type="submit" name="actualizarhmsidfalistado" value="Guardar Alistado" class="btn btn-success tamano-texto-cuerpo-boton"/>
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormhmsidfalistado">
    <form action="{{route('gifhmsiefalistado.registrargifhmsiefalistado')}}" method="POST">
        @csrf
        <table class="hmsidfalistado-tabla table table-bordered" id="tabla">
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
                    <th class="tipohmsief" scope="col">ALISTADO</th>
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
            <input type="submit" name="insertarhmsidfalistado" value="Insertar Alistado" class="btn btn-primary"/>
        </div>
    </form>
</div>