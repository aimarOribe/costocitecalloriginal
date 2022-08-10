<div class="gif-subtituloempleados">
    <div>
        <p>3.4</p>
    </div>
    <div>
        <p style="text-align: center">REPUESTOS Y MANTENIMIENTO</p>
    </div>
    <div>
        <input style="background-color: #2f5496" disabled class="form-control costorm" type="text">
    </div>
</div>

<br>

<div class="margenes-botones">
    <button type="button" class="btn btn-success btn-sm tamano-texto-cuerpo-boton" value="1" onClick="displayFormrmcorte(this)">Ver Cortes</button>
    <button type="button" class="btn btn-primary btn-sm tamano-texto-cuerpo-boton" value="2" onClick="displayFormrmcorte(this)">Registrar Cortes</button>
</div>

<div id="requestFormrmcorte">
    {!! Form::open(['url' => 'gifrmcorte/actualizar', 'method' => 'post']) !!}
    <table id="rmcorte" class="rmcorte-tabla table table-bordered">
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
                <th class="tipohmsief" scope="col">CORTE</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="cuerpopadregifrmcorte">
            <?php $i = 0; ?>
            @foreach ($rmcortes as $rmcorte)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $rmcorte->id ?>">
                    <td><input hidden type="text"></td>
                    <td><input type="text" class="rmcortedescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $rmcorte->id ?>]" value="<?php echo $rmcorte->descripcion ?>"></td>
                    <td>
                        <select class="rmcorteunidadmedida-<?php echo $i ?> form-control" name="listaunidadmedida_id[<?php echo $rmcorte->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($unidaddemedidas as $unidaddemedida)
                                <option class="tamano-texto-cuerpo-lista" value="{{$unidaddemedida->id}}" @if($unidaddemedida->id===$rmcorte->listaunidadmedida_id) selected='selected' @endif>
                                    {{$unidaddemedida->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input class="rmcortecantidad-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="cantidad[<?php echo $rmcorte->id ?>]" value="<?php echo $rmcorte->cantidad ?>"></td>
                    <td><input type="number" class="rmcortegastomanetenimiento-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="gastomantenimiento[<?php echo $rmcorte->id ?>]" value="<?php echo $rmcorte->gastomantenimiento ?>"></td>
                    <td><input type="number" class="rmcortefrecuenciaanual-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="frecuenciaanual[<?php echo $rmcorte->id ?>]" value="<?php echo $rmcorte->frecuenciaanual ?>"></td>
                    <td><input disabled class="totalgastomensualrmcorte-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gif.actualizar')
        <input type="submit" name="actualizarrmcorte" value="Actualizar Cortes" class="btn btn-warning tamano-texto-cuerpo-boton"/>
    @endcan
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormrmcorte">
    <form action="{{route('gifrmcorte.registrargifrmcorte')}}" method="POST">
        @csrf
        <table class="rmcorte-tabla table table-bordered" id="tabla">
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
                    <td><input required type="number" class="form-control tamano-texto-cuerpo-lista" name="cantidad"></td>
                    <td><input required type="number" class="form-control tamano-texto-cuerpo-lista" name="gastomantenimiento"></td>
                    <td><input required type="number" class="form-control tamano-texto-cuerpo-lista" name="frecuenciaanual"></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            @can('gi.registrar')
                <input type="submit" name="insertarrmcorte" value="Insertar Cortes" class="btn btn-info"/>
            @endcan
        </div>
    </form>
</div>