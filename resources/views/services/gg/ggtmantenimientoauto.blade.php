<div class="margenes-botones">
    <button type="button" class="btn btn-success btn-sm tamano-texto-cuerpo-boton" value="1" onClick="displayFormggtmantenimientoauto(this)">Ver Mantenimiento de Autos</button>
    <button type="button" class="btn btn-primary btn-sm tamano-texto-cuerpo-boton" value="2" onClick="displayFormggtmantenimientoauto(this)">Registrar Mantenimiento de Auto</button>
</div>

<div id="requestFormggtmantenimientoauto">
    {!! Form::open(['url' => 'ggtmantenimientoauto/actualizar', 'method' => 'post']) !!}
    <table id="ggtmantenimientoauto" class="ggtmantenimientoauto-tabla table table-bordered">
        <thead>
            <tr style="background-color: #ececec">
                <th scope="col">Mantenimiento de Auto</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Gasto</th>
                <th scope="col">Periodo Anual</th>
                <th scope="col">% DE USO</th>
                <th scope="col">Total Gasto Mensual</th>
            </tr>
        </thead>
        <tbody class="cuerpopadreggtmantenimientoauto">
            <?php $i = 0; ?>
            @foreach ($ggtmantenimientoautos as $ggtmantenimientoauto)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $ggtmantenimientoauto->id ?>">
                    <td><input hidden type="text"></td>
                    <td><input type="text" class="ggtmadescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $ggtmantenimientoauto->id ?>]" value="<?php echo $ggtmantenimientoauto->descripcion ?>"></td>
                    <td><input class="ggtmagasto-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="gasto[<?php echo $ggtmantenimientoauto->id ?>]" value="<?php echo $ggtmantenimientoauto->gasto ?>"></td>
                    <td><input class="ggtmaperiodoanual-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="periodoanual[<?php echo $ggtmantenimientoauto->id ?>]" value="<?php echo $ggtmantenimientoauto->periodoanual ?>"></td>
                    <td><input class="ggtmaporcentajeuso-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="porcentajeuso[<?php echo $ggtmantenimientoauto->id ?>]" value="<?php echo $ggtmantenimientoauto->porcentajeuso ?>"></td>
                    <td><input disabled class="ggtmatotalgastomensual-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gg.actualizar')
        <input type="submit" name="actualizarggtmantenimientoauto" value="Actualizar Mantenimiento de Autos" class="btn btn-warning tamano-texto-cuerpo-boton"/>
    @endcan
    
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormggtmantenimientoauto">
    <form action="{{route('ggtmantenimientoauto.registrarggtmantenimientoauto')}}" method="POST">
        @csrf
        <table class="ggtmantenimientoauto-tabla table table-bordered" id="tabla">
            <thead>
                <tr style="background-color: #ececec">
                    <th scope="col">Mantenimiento de Auto</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Gasto</th>
                    <th scope="col">Periodo Anual</th>
                    <th scope="col">% DE USO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input hidden type="text"></td>
                    <td><input required type="text" class="form-control tamano-texto-cuerpo-lista" name="descripcion"></td>
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="gasto"></td>
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="periodoanual"></td>
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="porcentajeuso"></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            @can('gg.registrar')
                <input type="submit" name="insertarggtmantenimientoauto" value="Insertar Mantenimiento de Auto" class="btn btn-info"/>
            @endcan
        </div>
    </form>
</div>