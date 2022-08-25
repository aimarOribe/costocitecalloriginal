<div class="gif-subtituloempleados">
    <div>
        <p>4.3</p>
    </div>
    <div>
        <p style="text-align: center">TRANSPORTE</p>
    </div>
    <div>
        <input style="background-color: #2f5496" disabled class="form-control costoggt" type="text">
    </div>
</div>

<br>

<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="displayFormggtpasajecombustible">
    <label class="form-check-label" for="displayFormggtpasajecombustible">Ver/Registrar Pasajes y Combustible</label>
</div>

<div id="requestFormggtpasajecombustible">
    {!! Form::open(['url' => 'ggtpasajecombustible/actualizar', 'method' => 'post']) !!}
    <table id="ggtpasajecombustible" class="ggtpasajecombustible-tabla table table-bordered">
        <thead>
            <tr style="background-color: #ececec">
                <th scope="col">Pasajes y Combustible</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Gasto</th>
                <th scope="col">Periodo Anual</th>
                <th scope="col">Total Gasto Mensual</th>
            </tr>
        </thead>
        <tbody class="cuerpopadreggtpasajecombustible">
            <?php $i = 0; ?>
            @foreach ($ggtpasajecombustibles as $ggtpasajecombustible)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $ggtpasajecombustible->id ?>">
                    <td><input hidden type="text"></td>
                    <td><input type="text" class="ggtpcdescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $ggtpasajecombustible->id ?>]" value="<?php echo $ggtpasajecombustible->descripcion ?>"></td>
                    <td><input class="ggtpcgasto-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="gasto[<?php echo $ggtpasajecombustible->id ?>]" value="<?php echo $ggtpasajecombustible->gasto ?>"></td>
                    <td><input type="number" class="ggtpcperiodoanual-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="periodoanual[<?php echo $ggtpasajecombustible->id ?>]" value="<?php echo $ggtpasajecombustible->periodoanual ?>"></td>
                    <td><input readonly class="ggtpctotalgastomensual-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <input type="submit" name="actualizargggasueldosadministrativos" value="Guardar Pasajes y Combustible" class="btn btn-success tamano-texto-cuerpo-boton"/>
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormggtpasajecombustible">
    <form action="{{route('ggtpasajecombustible.registrarggtpasajecombustible')}}" method="POST">
        @csrf
        <table class="ggtpasajecombustible-tabla table table-bordered" id="tabla">
            <thead>
                <tr style="background-color: #ececec">
                    <th scope="col">Pasajes y Combustible</th>
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
            <input type="submit" name="insertarggtpasajecombustible" value="Insertar Pasaje y Combustible" class="btn btn-primary"/>
        </div>
    </form>
</div>