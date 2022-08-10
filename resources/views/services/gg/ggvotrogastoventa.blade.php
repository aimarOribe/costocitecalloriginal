<div class="margenes-botones">
    <button type="button" class="btn btn-success btn-sm tamano-texto-cuerpo-boton" value="1" onClick="displayFormggvotrogastoventa(this)">Ver Otros Gastos Ventas</button>
    <button type="button" class="btn btn-primary btn-sm tamano-texto-cuerpo-boton" value="2" onClick="displayFormggvotrogastoventa(this)">Registrar Otro Gasto Venta</button>
</div>

<div id="requestFormggvotrogastoventa">
    {!! Form::open(['url' => 'ggvotrogastoventa/actualizar', 'method' => 'post']) !!}
    <table id="ggvotrogastoventa" class="ggvotrogastoventa-tabla table table-bordered">
        <thead>
            <tr style="background-color: #ececec">
                <th scope="col">Otros Gastos de Ventas</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Gasto</th>
                <th scope="col">Periodo Anual</th>
                <th scope="col">Total Gasto Mensual</th>
            </tr>
        </thead>
        <tbody class="cuerpopadreggvotrogastoventa">
            <?php $i = 0; ?>
            @foreach ($ggvotrogastoventas as $ggvotrogastoventa)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $ggvotrogastoventa->id ?>">
                    <td><input hidden type="text"></td>
                    <td><input type="text" class="ggvogvdescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $ggvotrogastoventa->id ?>]" value="<?php echo $ggvotrogastoventa->descripcion ?>"></td>
                    <td><input class="ggvogvgasto-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="gasto[<?php echo $ggvotrogastoventa->id ?>]" value="<?php echo $ggvotrogastoventa->gasto ?>"></td>
                    <td><input class="ggvogvperiodoanual-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="periodoanual[<?php echo $ggvotrogastoventa->id ?>]" value="<?php echo $ggvotrogastoventa->periodoanual ?>"></td>
                    <td><input disabled class="ggvogvtotalgastomensual-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gg.actualizar')
        <input type="submit" name="actualizarggvotrogastoventa" value="Actualizar Otro Gasto Venta" class="btn btn-warning tamano-texto-cuerpo-boton"/>
    @endcan
    
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormggvotrogastoventa">
    <form action="{{route('ggvotrogastoventa.registrarggvotrogastoventa')}}" method="POST">
        @csrf
        <table class="ggvotrogastoventa-tabla table table-bordered" id="tabla">
            <thead>
                <tr style="background-color: #ececec">
                    <th scope="col">Otros Gastos de Ventas</th>
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
                <input type="submit" name="insertarggvotrogastoventa" value="Insertar Otro Gasto Venta" class="btn btn-info"/>
            @endcan
        </div>
    </form>
</div>