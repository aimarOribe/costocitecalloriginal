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

<div class="margenes-botones">
    <button type="button" class="btn btn-success btn-sm tamano-texto-cuerpo-boton" value="1" onClick="displayFormggtpasajecombustible(this)">Ver Pasajes y Combustible</button>
    <button type="button" class="btn btn-primary btn-sm tamano-texto-cuerpo-boton" value="2" onClick="displayFormggtpasajecombustible(this)">Registrar Pasaje y Combustible</button>
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
                    <td><input class="ggtpcgasto-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="gasto[<?php echo $ggtpasajecombustible->id ?>]" value="<?php echo $ggtpasajecombustible->gasto ?>"></td>
                    <td><input class="ggtpcperiodoanual-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="periodoanual[<?php echo $ggtpasajecombustible->id ?>]" value="<?php echo $ggtpasajecombustible->periodoanual ?>"></td>
                    <td><input disabled class="ggtpctotalgastomensual-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gg.actualizar')
        <input type="submit" name="actualizargggasueldosadministrativos" value="Actualizar Pasajes y Combustible" class="btn btn-warning tamano-texto-cuerpo-boton"/>
    @endcan
    
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
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="periodoanual"></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            @can('gg.registrar')
                <input type="submit" name="insertarggtpasajecombustible" value="Insertar Pasaje y Combustible" class="btn btn-info"/>
            @endcan
        </div>
    </form>
</div>