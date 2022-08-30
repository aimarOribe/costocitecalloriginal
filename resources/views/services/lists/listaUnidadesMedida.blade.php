<div class="col-sm-6 col-md-3 offset-md-2 col-lg-3 offset-lg-0">

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="displayFormListaUnidadMedida">
        <label class="form-check-label" for="displayFormListaUnidadMedida">Ver/Registrar Unidades de Medida</label>
    </div>

    <div id="requestFormListaUnidadDeMedidas">
        <table id="unidadMedidas" class="listaUnidadDeMedidas-tabla table table-bordered">
            <thead>
                <tr>
                    <th scope="col">UNIDAD MEDIDA</th>
                </tr>
            </thead>
            <tbody style="border-color: #5b9bd5" id="cuerpopadrelistaunidadmedida"></tbody>
        </table>
        <button type="submit" name="actualizarListaUnidadMedida" class="btn btn-success boton-actualizar tamano-texto-cuerpo-boton" id="clavebotoneditareliminarlistaunidadmedida">Guardar Unidades<?php echo "<br/>" ?>de Medida</button>
    </div>

    <div style="display:none" id="memberFormListaUnidadDeMedidas">
        <table class="listaUnidadDeMedidas-tabla table table-bordered" id="tablaListaUnidadMedida">
            <thead>
                <tr>
                    <th scope="col">UNIDAD MEDIDA</th>
                </tr>
            </thead>
            <tbody style="border-color: #5b9bd5">
                <tr>
                    <td><input type="text" required name="nombre" placeholder="Nombre" class="form-control tamano-texto-cuerpo-lista" id="claveunidadmedidalistaregistrar"/></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            <button type="submit" name="insertarListaUnidadMedida" class="btn btn-primary tamano-texto-cuerpo-boton" id="clavebotonguardarlistaunidadmedida">Insertar Unidades<?php echo "<br/>" ?>de Medida</button>
        </div>
    </div>
</div>