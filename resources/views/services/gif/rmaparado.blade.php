<br>

<div class="margenes-botones">
    <button type="button" class="btn btn-success btn-sm tamano-texto-cuerpo-boton" value="1" onClick="displayFormrmaparado(this)">Ver Aparados</button>
    <button type="button" class="btn btn-primary btn-sm tamano-texto-cuerpo-boton" value="2" onClick="displayFormrmaparado(this)">Registrar Aparados</button>
</div>

<div id="requestFormrmaparado">
    {!! Form::open(['url' => 'gifrmaparado/actualizar', 'method' => 'post']) !!}
    <table id="rmaparado" class="rmaparado-tabla table table-bordered">
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
                <th class="tipohmsief" scope="col">APARADO</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="cuerpopadregifrmaparado">
            <?php $i = 0; ?>
            @foreach ($rmaparados as $rmaparado)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $rmaparado->id ?>">
                    <td><input hidden type="text"></td>
                    <td><input type="text" class="rmaparadodescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $rmaparado->id ?>]" value="<?php echo $rmaparado->descripcion ?>"></td>
                    <td>
                        <select class="rmaparadounidadmedida-<?php echo $i ?> form-control" name="listaunidadmedida_id[<?php echo $rmaparado->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($unidaddemedidas as $unidaddemedida)
                                <option class="tamano-texto-cuerpo-lista" value="{{$unidaddemedida->id}}" @if($unidaddemedida->id===$rmaparado->listaunidadmedida_id) selected='selected' @endif>
                                    {{$unidaddemedida->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input class="rmaparadocantidad-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="cantidad[<?php echo $rmaparado->id ?>]" value="<?php echo $rmaparado->cantidad ?>"></td>
                    <td><input type="number" class="rmaparadogastomanetenimiento-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="gastomantenimiento[<?php echo $rmaparado->id ?>]" value="<?php echo $rmaparado->gastomantenimiento ?>"></td>
                    <td><input type="number" class="rmaparadofrecuenciaanual-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="frecuenciaanual[<?php echo $rmaparado->id ?>]" value="<?php echo $rmaparado->frecuenciaanual ?>"></td>
                    <td><input disabled class="totalgastomensualrmaparado-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gif.actualizar')
        <input type="submit" name="actualizarrmaparado" value="Update rigged" class="btn btn-warning tamano-texto-cuerpo-boton"/>
    @endcan
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormrmaparado">
    <form action="{{route('gifrmaparado.registrargifrmaparado')}}" method="POST">
        @csrf
        <table class="rmaparado-tabla table table-bordered" id="tabla">
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
                    <td><input required type="number" class="form-control tamano-texto-cuerpo-lista" name="cantidad"></td>
                    <td><input required type="number" class="form-control tamano-texto-cuerpo-lista" name="gastomantenimiento"></td>
                    <td><input required type="number" class="form-control tamano-texto-cuerpo-lista" name="frecuenciaanual"></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            @can('gi.registrar')
                <input type="submit" name="insertarrmaparado" value="Insert rigged" class="btn btn-info"/>
            @endcan
        </div>
    </form>
</div>