<br>

<div class="margenes-botones">
    <button type="button" class="btn btn-success btn-sm tamano-texto-cuerpo-boton" value="1" onClick="displayFormhmsidfcorte(this)">See Court</button>
    <button type="button" class="btn btn-primary btn-sm tamano-texto-cuerpo-boton" value="2" onClick="displayFormhmsidfcorte(this)">Register Court</button>
</div>

<div id="requestFormhmsidfcorte">
    {!! Form::open(['url' => 'gifhmsiefcorte/actualizar', 'method' => 'post']) !!}
    <table id="hmsidfcorte" class="hmsidfcorte-tabla table table-bordered">
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
                <th class="tipohmsief" scope="col">CORTE</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="cuerpopadregifhmsidfcorte">
            <?php $i = 0; ?>
            @foreach ($hmsiefcortes as $hmsiefcorte)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $hmsiefcorte->id ?>">
                    <td><input hidden type="text"></td>
                    <td><input type="text" class="hmsidfcortedescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $hmsiefcorte->id ?>]" value="<?php echo $hmsiefcorte->descripcion ?>"></td>
                    <td>
                        <select class="hmsidfcorteunidadmedida-<?php echo $i ?> form-control" name="listaunidadmedida_id[<?php echo $hmsiefcorte->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($unidaddemedidas as $unidaddemedida)
                                <option class="tamano-texto-cuerpo-lista" value="{{$unidaddemedida->id}}" @if($unidaddemedida->id===$hmsiefcorte->listaunidadmedida_id) selected='selected' @endif>
                                    {{$unidaddemedida->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input class="hmsidfcortevalorunitario-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="valorunitario[<?php echo $hmsiefcorte->id ?>]" value="<?php echo $hmsiefcorte->valorunitario ?>"></td>
                    <td><input type="number" class="hmsidfcorteconsumo-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="consumo[<?php echo $hmsiefcorte->id ?>]" value="<?php echo $hmsiefcorte->consumo ?>"></td>
                    <td><input type="number" class="hmsidfcortecantidadmeses-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="cantidadmeses[<?php echo $hmsiefcorte->id ?>]" value="<?php echo $hmsiefcorte->cantidadmeses ?>"></td>
                    <td><input disabled class="totalgastomensualhmsidfcorte-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gif.actualizar')
        <input type="submit" name="actualizarhmsidfcorte" value="Update Court" class="btn btn-warning tamano-texto-cuerpo-boton"/>
    @endcan
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormhmsidfcorte">
    <form action="{{route('gifhmsiefcorte.registrargifhmsiefcorte')}}" method="POST">
        @csrf
        <table class="hmsidfcorte-tabla table table-bordered" id="tabla">
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
                    <th class="tipohmsief" scope="col">CORTE</th>
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
                <input type="submit" name="insertarhmsidfcorte" value="Insert Court" class="btn btn-info"/>
            @endcan
        </div>
    </form>
</div>