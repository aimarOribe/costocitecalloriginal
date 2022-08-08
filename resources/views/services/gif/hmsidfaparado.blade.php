<div class="margenes-botones">
    <input class="form-check-input" value="1" type="radio" name="formselector" onClick="displayFormhmsidfaparado(this)" id="checkAactualizar" checked>
    <label class="form-check-label" for="checkActualizar">
        Update
    </label>  
    
    <input class="form-check-input" value="2" type="radio" name="formselector" onClick="displayFormhmsidfaparado(this)" id="checkRegistrar">
    <label class="form-check-label" for="checkRegistrar">
        Register
    </label>
</div>

<div id="requestFormhmsidfaparado">
    {!! Form::open(['url' => 'gifhmsiefaparado/actualizar', 'method' => 'post']) !!}
    <table id="hmsidfaparado" class="hmsidfaparado-tabla table table-bordered">
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
                <th class="tipohmsief" scope="col">APARADO</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="cuerpopadregifhmsidfaparado">
            <?php $i = 0; ?>
            @foreach ($hmsiefaparados as $hmsiefaparado)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $hmsiefaparado->id ?>">
                    <td><input hidden type="text"></td>
                    <td><input type="text" class="hmsidfaparadodescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $hmsiefaparado->id ?>]" value="<?php echo $hmsiefaparado->descripcion ?>"></td>
                    <td>
                        <select class="hmsidfaparadounidadmedida-<?php echo $i ?> form-control" name="listaunidadmedida_id[<?php echo $hmsiefaparado->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($unidaddemedidas as $unidaddemedida)
                                <option class="tamano-texto-cuerpo-lista" value="{{$unidaddemedida->id}}" @if($unidaddemedida->id===$hmsiefaparado->listaunidadmedida_id) selected='selected' @endif>
                                    {{$unidaddemedida->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input class="hmsidfaparadovalorunitario-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="valorunitario[<?php echo $hmsiefaparado->id ?>]" value="<?php echo $hmsiefaparado->valorunitario ?>"></td>
                    <td><input type="number" class="hmsidfaparadoconsumo-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="consumo[<?php echo $hmsiefaparado->id ?>]" value="<?php echo $hmsiefaparado->consumo ?>"></td>
                    <td><input type="number" class="hmsidfaparadocantidadmeses-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="cantidadmeses[<?php echo $hmsiefaparado->id ?>]" value="<?php echo $hmsiefaparado->cantidadmeses ?>"></td>
                    <td><input disabled class="totalgastomensualhmsidfaparado-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gif.actualizar')
        <input type="submit" name="actualizarhmsidfaparado" value="Update rigged" class="btn btn-warning tamano-texto-cuerpo-boton"/>
    @endcan
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormhmsidfaparado">
    <form action="{{route('gifhmsiefaparado.registrargifhmsiefaparado')}}" method="POST">
        @csrf
        <table class="hmsidfaparado-tabla table table-bordered" id="tabla">
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
                    <th class="tipohmsief" scope="col">APARADO</th>
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
                <input type="submit" name="insertarhmsidfaparado" value="Insert rigged" class="btn btn-info"/>
            @endcan
        </div>
    </form>
</div>