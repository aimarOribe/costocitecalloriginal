<div class="gif-subtituloempleados">
    <div>
        <p>4.4</p>
    </div>
    <div>
        <p style="text-align: center">SERVICIOS BÁSICOS</p>
    </div>
    <div>
        <input style="background-color: #2f5496" disabled class="form-control costoggserviciosbasicos" type="text">
    </div>
</div>

<br>

<div class="margenes-botones">
    <button type="button" class="btn btn-success btn-sm tamano-texto-cuerpo-boton" value="1" onClick="displayFormggserviciobasico(this)">Ver Servicios Basicos</button>
    <button type="button" class="btn btn-primary btn-sm tamano-texto-cuerpo-boton" value="2" onClick="displayFormggserviciobasico(this)">Registrar Servicio Basico</button>
</div>

<div id="requestFormggserviciobasico">
    {!! Form::open(['url' => 'ggserviciosbasicos/actualizar', 'method' => 'post']) !!}
    <table id="ggserviciobasico" class="ggserviciobasico-tabla table table-bordered">
        <thead>
            <tr>
                <th scope="col">Descripcion</th>
                <th scope="col">COSTO DEL SERVICIO</th>
                <th scope="col">% DE USO</th>
                <th scope="col">Total Gasto Mensual</th>
            </tr>
        </thead>
        <tbody class="cuerpopadreggserviciobasico">
            <?php $i = 0; ?>
            @foreach ($ggserviciosbasicos as $ggserviciosbasico)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $ggserviciosbasico->id ?>">
                    <td><input type="text" class="ggsvdescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $ggserviciosbasico->id ?>]" value="<?php echo $ggserviciosbasico->descripcion ?>"></td>
                    <td><input class="ggsbcostoservicio-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="costoservicio[<?php echo $ggserviciosbasico->id ?>]" value="<?php echo $ggserviciosbasico->costoservicio ?>"></td>
                    <td><input class="ggsbporcentajeuso-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="porcentajeuso[<?php echo $ggserviciosbasico->id ?>]" value="<?php echo $ggserviciosbasico->porcentajeuso ?>"></td>
                    <td><input disabled class="ggsbtotalgastomensual-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gg.actualizar')
        <input type="submit" name="actualizarggserviciobasico" value="Actualizar Servicios Basicos" class="btn btn-warning tamano-texto-cuerpo-boton"/>
    @endcan
    
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormggserviciobasico">
    <form action="{{route('ggserviciosbasicos.registrarggserviciosbasicos')}}" method="POST">
        @csrf
        <table class="ggserviciobasico-tabla table table-bordered" id="tabla">
            <thead>
                <tr>
                    <th scope="col">DESCRIPCION</th>
                    <th scope="col">COSTO DEL SERVICIO</th>
                    <th scope="col">% DE USO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input required type="text" class="form-control tamano-texto-cuerpo-lista" name="descripcion"></td>
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="costoservicio"></td>
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="porcentajeuso"></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            @can('gg.registrar')
                <input type="submit" name="insertarggserviciobasico" value="Insertar Mantenimiento de Auto" class="btn btn-info"/>
            @endcan
        </div>
    </form>
</div>