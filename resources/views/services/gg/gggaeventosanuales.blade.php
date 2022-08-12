<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="displayFormgggaeventosanuales">
    <label class="form-check-label" for="displayFormgggaeventosanuales">Ver/Registrar Eventos Anuales</label>
</div>

<div id="requestFormgggaeventosanuales">
    {!! Form::open(['url' => 'gggaeventosanuales/actualizar', 'method' => 'post']) !!}
    <table id="gggaeventosanuales" class="gggaeventosanuales-tabla table table-bordered">
        <thead>
            <tr style="background-color: #ececec">
                <th scope="col">EVENTOS ANUALES PARA EL PERSONAL</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Gasto</th>
                <th scope="col">Periodo Anual</th>
                <th scope="col">Total Gasto Mensual</th>
            </tr>
        </thead>
        <tbody class="cuerpopadregggaeventosanuales">
            <?php $i = 0; ?>
            @foreach ($gggaeventosanuales as $gggaeventosanual)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $gggaeventosanual->id ?>">
                    <td><input hidden type="text"></td>
                    <td><input type="text" class="gggaeapdescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $gggaeventosanual->id ?>]" value="<?php echo $gggaeventosanual->descripcion ?>"></td>
                    <td><input class="gggaeapgasto-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="gasto[<?php echo $gggaeventosanual->id ?>]" value="<?php echo $gggaeventosanual->gasto ?>"></td>
                    <td><input type="number" class="gggaeapperiodoanual-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="periodoanual[<?php echo $gggaeventosanual->id ?>]" value="<?php echo $gggaeventosanual->periodoanual ?>"></td>
                    <td><input readonly class="gggaeaptotalgastomensual-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gg.actualizar')
        <input type="submit" name="actualizargggaeventosanuales" value="Guardar Eventos Anuales para el Personal" class="btn btn-success tamano-texto-cuerpo-boton"/>
    @endcan
    
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormgggaeventosanuales">
    <form action="{{route('gggaeventosanuales.registrargggaeventosanuales')}}" method="POST">
        @csrf
        <table class="gggaeventosanuales-tabla table table-bordered" id="tabla">
            <thead>
                <tr style="background-color: #ececec">
                    <th scope="col">EVENTOS ANUALES PARA EL PERSONAL</th>
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
            @can('gg.registrar')
                <input type="submit" name="insertargggaeventosanuales" value="Insertar Evento Anual para el Personal" class="btn btn-primary"/>
            @endcan
        </div>
    </form>
</div>