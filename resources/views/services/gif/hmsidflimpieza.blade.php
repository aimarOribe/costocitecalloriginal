<br>

<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="displayFormhmsidflimpieza">
    <label class="form-check-label" for="displayFormhmsidflimpieza">Ver/Registrar Limpieza</label>
</div>

<div id="requestFormhmsidflimpieza">
    {!! Form::open(['url' => 'gifhmsieflimpieza/actualizar', 'method' => 'post']) !!}
    <table id="hmsidflimpieza" class="hmsidflimpieza-tabla table table-bordered">
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
                <th class="tipohmsief" scope="col">LIMPIEZA</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class="cuerpopadregifhmsidflimpieza">
            <?php $i = 0; ?>
            @foreach ($hmsieflimpiezas as $hmsieflimpieza)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $hmsieflimpieza->id ?>">
                    <td><input hidden type="text"></td>
                    <td><input type="text" class="hmsidflimpiezadescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $hmsieflimpieza->id ?>]" value="<?php echo $hmsieflimpieza->descripcion ?>"></td>
                    <td>
                        <select class="hmsidflimpiezaunidadmedida-<?php echo $i ?> form-control" name="listaunidadmedida_id[<?php echo $hmsieflimpieza->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($unidaddemedidas as $unidaddemedida)
                                <option class="tamano-texto-cuerpo-lista" value="{{$unidaddemedida->id}}" @if($unidaddemedida->id===$hmsieflimpieza->listaunidadmedida_id) selected='selected' @endif>
                                    {{$unidaddemedida->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input class="hmsidflimpiezavalorunitario-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="valorunitario[<?php echo $hmsieflimpieza->id ?>]" value="<?php echo $hmsieflimpieza->valorunitario ?>"></td>
                    <td><input type="number" class="hmsidflimpiezaconsumo-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="consumo[<?php echo $hmsieflimpieza->id ?>]" value="<?php echo $hmsieflimpieza->consumo ?>"></td>
                    <td><input type="number" class="hmsidflimpiezacantidadmeses-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="cantidadmeses[<?php echo $hmsieflimpieza->id ?>]" value="<?php echo $hmsieflimpieza->cantidadmeses ?>"></td>
                    <td><input disabled class="totalgastomensualhmsidflimpieza-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gif.actualizar')
        <input type="submit" name="actualizarhmsidflimpieza" value="Guardar Limpieza" class="btn btn-success tamano-texto-cuerpo-boton"/>
    @endcan
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormhmsidflimpieza">
    <form action="{{route('gifhmsieflimpieza.registrargifhmsieflimpieza')}}" method="POST">
        @csrf
        <table class="hmsidflimpieza-tabla table table-bordered" id="tabla">
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
                    <th class="tipohmsief" scope="col">LIMPIEZA</th>
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
                <input type="submit" name="insertarhmsidflimpieza" value="Insertar Limpieza" class="btn btn-primary"/>
            @endcan
        </div>
    </form>
</div>