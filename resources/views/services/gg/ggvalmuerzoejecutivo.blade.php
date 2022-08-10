<div class="margenes-botones">
    <button type="button" class="btn btn-success btn-sm tamano-texto-cuerpo-boton" value="1" onClick="displayFormggvalmuerzoejecutivo(this)">Ver Almuerzos Ejecutivos</button>
    <button type="button" class="btn btn-primary btn-sm tamano-texto-cuerpo-boton" value="2" onClick="displayFormggvalmuerzoejecutivo(this)">Registrar Almuerzo Ejecutivo</button>
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
                    <td><input class="ggvaegasto-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="gasto[<?php echo $ggvalmuerzoejecutivo->id ?>]" value="<?php echo $ggvalmuerzoejecutivo->gasto ?>"></td>
                    <td><input class="ggvaeperiodoanual-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="periodoanual[<?php echo $ggvalmuerzoejecutivo->id ?>]" value="<?php echo $ggvalmuerzoejecutivo->periodoanual ?>"></td>
                    <td><input disabled class="ggvaetotalgastomensual-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gg.actualizar')
        <input type="submit" name="actualizarggvalmuerzoejecutivo" value="Actualizar Almuerzos Ejecutivos" class="btn btn-warning tamano-texto-cuerpo-boton"/>
    @endcan
    
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
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="periodoanual"></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            @can('gg.registrar')
                <input type="submit" name="insertarggvalmuerzoejecutivo" value="Insertar Almuerzo Ejecutivo" class="btn btn-info"/>
            @endcan
        </div>
    </form>
</div>