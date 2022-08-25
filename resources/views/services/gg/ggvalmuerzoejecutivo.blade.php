<div class="form-check form-switch col-4">
    <input class="form-check-input" type="checkbox" role="switch" id="displayFormggvalmuerzoejecutivo">
    <label class="form-check-label" for="displayFormggvalmuerzoejecutivo">Ver/Registrar Almuerzos Ejecutivos</label>
</div>

<div id="requestFormggvalmuerzoejecutivo">
    {!! Form::open(['url' => 'ggvalmuerzoejecutivo/actualizar', 'method' => 'post']) !!}
    <table id="ggvalmuerzoejecutivo" class="ggvalmuerzoejecutivo-tabla table table-bordered">
        <thead>
            <tr style="background-color: #ececec">
                <th scope="col">Almuerzos Ejecutivos</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Gasto</th>
                <th scope="col">Periodo Anual</th>
                <th scope="col">Total Gasto Mensual</th>
            </tr>
        </thead>
        <tbody class="cuerpopadreggvalmuerzoejecutivo">
            <?php $i = 0; ?>
            @foreach ($ggvalmuerzoejecutivos as $ggvalmuerzoejecutivo)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $ggvalmuerzoejecutivo->id ?>">
                    <td><input hidden type="text"></td>
                    <td><input type="text" class="ggvaedescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $ggvalmuerzoejecutivo->id ?>]" value="<?php echo $ggvalmuerzoejecutivo->descripcion ?>"></td>
                    <td><input class="ggvaegasto-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="gasto[<?php echo $ggvalmuerzoejecutivo->id ?>]" value="<?php echo $ggvalmuerzoejecutivo->gasto ?>"></td>
                    <td><input type="number" class="ggvaeperiodoanual-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="periodoanual[<?php echo $ggvalmuerzoejecutivo->id ?>]" value="<?php echo $ggvalmuerzoejecutivo->periodoanual ?>"></td>
                    <td><input readonly class="ggvaetotalgastomensual-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <input type="submit" name="actualizarggvalmuerzoejecutivo" value="Guardar Almuerzos Ejecutivos" class="btn btn-success tamano-texto-cuerpo-boton"/>
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormggvalmuerzoejecutivo">
    <form action="{{route('ggvalmuerzoejecutivo.registrarggvalmuerzoejecutivo')}}" method="POST">
        @csrf
        <table class="ggvalmuerzoejecutivo-tabla table table-bordered" id="tabla">
            <thead>
                <tr style="background-color: #ececec">
                    <th scope="col">Almuerzos Ejecutivos</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Gasto</th>
                    <th scope="col">Periodo Anual</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input hidden type="text"></td>
                    <td><input required type="text" class="form-control tamano-texto-cuerpo-lista" name="descripcion"></td>
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="gasto"></td>
                    <td><input required type="number" required class="form-control tamano-texto-cuerpo-lista" name="periodoanual"></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            <input type="submit" name="insertarggvalmuerzoejecutivo" value="Insertar Almuerzo Ejecutivo" class="btn btn-primary"/>
        </div>
    </form>
</div>