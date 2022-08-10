<div class="margenes-botones">
    <button type="button" class="btn btn-success btn-sm tamano-texto-cuerpo-boton" value="1" onClick="displayFormgggautilesescritorio(this)">Ver Utiles de Escritorio</button>
    <button type="button" class="btn btn-primary btn-sm tamano-texto-cuerpo-boton" value="2" onClick="displayFormgggautilesescritorio(this)">Registrar Utiles de Escritori</button>
</div>

<div id="requestFormgggautilesescritorio">
    {!! Form::open(['url' => 'gggautilesescritorio/actualizar', 'method' => 'post']) !!}
    <table id="gggautilesescritorio" class="gggautilesescritorio-tabla table table-bordered">
        <thead>
            <tr style="background-color: #ececec">
                <th scope="col">Útiles de Escritorio</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Gasto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Periodo Anual</th>
                <th scope="col">Total Gasto Mensual</th>
            </tr>
        </thead>
        <tbody class="cuerpopadregggautilesescritorio">
            <?php $i = 0; ?>
            @foreach ($gggautilesescritorios as $gggautilesescritorio)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $gggautilesescritorio->id ?>">
                    <td><input hidden type="text"></td>
                    <td><input type="text" class="gggausdescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $gggautilesescritorio->id ?>]" value="<?php echo $gggautilesescritorio->descripcion ?>"></td>
                    <td><input class="gggausgasto-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="gasto[<?php echo $gggautilesescritorio->id ?>]" value="<?php echo $gggautilesescritorio->gasto ?>"></td>
                    <td><input class="gggauscantidad-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="cantidad[<?php echo $gggautilesescritorio->id ?>]" value="<?php echo $gggautilesescritorio->cantidad ?>"></td>
                    <td><input class="gggausperiodoanual-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="periodoanual[<?php echo $gggautilesescritorio->id ?>]" value="<?php echo $gggautilesescritorio->periodoanual ?>"></td>
                    <td><input disabled class="gggaustotalgastomensual-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gg.actualizar')
        <input type="submit" name="actualizargggautilesescritorio" value="Actualizar Utiles de Escritorio" class="btn btn-warning tamano-texto-cuerpo-boton"/>
    @endcan
    
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormgggautilesescritorio">
    <form action="{{route('gggautilesescritorio.registrargggautilesescritorio')}}" method="POST">
        @csrf
        <table class="gggautilesescritorio-tabla table table-bordered" id="tabla">
            <thead>
                <tr style="background-color: #ececec">
                    <th scope="col">Útiles de Escritorio</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Gasto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Periodo Anual</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input hidden type="text"></td>
                    <td><input required type="text" class="form-control tamano-texto-cuerpo-lista" name="descripcion"></td>
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="gasto"></td>
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="cantidad"></td>
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="periodoanual"></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            @can('gg.registrar')
                <input type="submit" name="insertargggasueldosadministrativos" value="Insertar Utiles de Escritorio" class="btn btn-info"/>
            @endcan
        </div>
    </form>
</div>