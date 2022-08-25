<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="displayFormgggautilesescritorio">
    <label class="form-check-label" for="displayFormgggautilesescritorio">Ver/Registrar Utiles de Escritorio</label>
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
                    <td><input class="gggausgasto-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="gasto[<?php echo $gggautilesescritorio->id ?>]" value="<?php echo $gggautilesescritorio->gasto ?>"></td>
                    <td><input type="number" class="gggauscantidad-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="cantidad[<?php echo $gggautilesescritorio->id ?>]" value="<?php echo $gggautilesescritorio->cantidad ?>"></td>
                    <td><input type="number" class="gggausperiodoanual-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="periodoanual[<?php echo $gggautilesescritorio->id ?>]" value="<?php echo $gggautilesescritorio->periodoanual ?>"></td>
                    <td><input readonly class="gggaustotalgastomensual-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
        <input type="submit" name="actualizargggautilesescritorio" value="Guardar Utiles de Escritorio" class="btn btn-success tamano-texto-cuerpo-boton"/>
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
                    <td><input required type="number" required class="form-control tamano-texto-cuerpo-lista" name="cantidad"></td>
                    <td><input required type="number" required class="form-control tamano-texto-cuerpo-lista" name="periodoanual"></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            <input type="submit" name="insertargggasueldosadministrativos" value="Insertar Utiles de Escritorio" class="btn btn-primary"/>
        </div>
    </form>
</div>