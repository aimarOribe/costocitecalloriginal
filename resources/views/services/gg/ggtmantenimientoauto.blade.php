<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="displayFormggtmantenimientoauto">
    <label class="form-check-label" for="displayFormggtmantenimientoauto">Ver/Registrar Mantenimiento de Auto</label>
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
                    <td><input class="ggtmagasto-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="gasto[<?php echo $ggtmantenimientoauto->id ?>]" value="<?php echo $ggtmantenimientoauto->gasto ?>"></td>
                    <td><input type="number" class="ggtmaperiodoanual-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="periodoanual[<?php echo $ggtmantenimientoauto->id ?>]" value="<?php echo $ggtmantenimientoauto->periodoanual ?>"></td>
                    <td><input class="ggtmaporcentajeuso-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="porcentajeuso[<?php echo $ggtmantenimientoauto->id ?>]" value="<?php echo $ggtmantenimientoauto->porcentajeuso ?>"></td>
                    <td><input readonly class="ggtmatotalgastomensual-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <input type="submit" name="actualizarggtmantenimientoauto" value="Guardar Mantenimiento de Autos" class="btn btn-success tamano-texto-cuerpo-boton"/>
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
                    <td><input required type="number" required class="form-control tamano-texto-cuerpo-lista" name="periodoanual"></td>
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="porcentajeuso"></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            <input type="submit" name="insertarggtmantenimientoauto" value="Insertar Mantenimiento de Auto" class="btn btn-primary"/>
        </div>
    </form>
</div>