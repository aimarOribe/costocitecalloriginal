<div class="gif-subtituloempleados">
    <div>
        <p>3.4</p>
    </div>
    <div>
        <p style="text-align: center">REPUESTOS Y MANTENIMIENTO</p>
    </div>
    <div>
        <input readonly style="background-color: #2f5496" class="form-control costorm" type="text">
    </div>
</div>

<br>

<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="displayFormrmcorte">
    <label class="form-check-label" for="displayFormrmcorte">Ver/Registrar Corte</label>
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
                        <select class="rmcorteunidadmedida-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="listaunidadmedida_id[<?php echo $rmcorte->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($unidaddemedidas as $unidaddemedida)
                                <option class="tamano-texto-cuerpo-lista" value="{{$unidaddemedida->id}}" @if($unidaddemedida->id===$rmcorte->listaunidadmedida_id) selected='selected' @endif>
                                    {{$unidaddemedida->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" class="rmcortecantidad-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="cantidad[<?php echo $rmcorte->id ?>]" value="<?php echo $rmcorte->cantidad ?>"></td>
                    <td><input class="rmcortegastomanetenimiento-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="gastomantenimiento[<?php echo $rmcorte->id ?>]" value="<?php echo $rmcorte->gastomantenimiento ?>"></td>
                    <td><input type="number" class="rmcortefrecuenciaanual-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="frecuenciaanual[<?php echo $rmcorte->id ?>]" value="<?php echo $rmcorte->frecuenciaanual ?>"></td>
                    <td><input readonly class="totalgastomensualrmcorte-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <input type="submit" name="actualizarrmcorte" value="Guardar Cortes" class="btn btn-success tamano-texto-cuerpo-boton"/>
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
                        <select required class="form-control tamano-texto-cuerpo-lista" name="listaunidadmedida_id">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($unidaddemedidas as $unidaddemedida)
                                <option class="tamano-texto-cuerpo-lista" value="{{$unidaddemedida->id}}">
                                    {{$unidaddemedida->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input required type="number" class="form-control tamano-texto-cuerpo-lista" name="cantidad"></td>
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="gastomantenimiento"></td>
                    <td><input required type="number" class="form-control tamano-texto-cuerpo-lista" name="frecuenciaanual"></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            <input type="submit" name="insertarrmcorte" value="Insertar Cortes" class="btn btn-primary"/>
        </div>
    </form>
</div>