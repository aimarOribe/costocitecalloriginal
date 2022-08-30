<div class="col-sm-6 col-md-3 offset-md-2 col-lg-2 offset-lg-0">

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="displayFormListaUnidadConsumo">
        <label class="form-check-label" for="displayFormListaUnidadConsumo">Ver/Registrar Unidades de Consumo</label>
    </div>

    <div id="requestFormListaUnidadConsumo">
        <table id="listaUnidadConsumos" class="listaUnidadConsumos-tabla table table-bordered">
            <thead>
                <tr>
                    <th scope="col">UNIDAD DE CONSUMO</th>
                </tr>
            </thead>
            <tbody style="border-color: #5b9bd5" id="cuerpopadrelistaunidadconsumo"></tbody>
        </table>
        <button type="submit" name="actualizarListaUnidadConsumo" class="btn btn-success tamano-texto-cuerpo-boton boton-actualizar" id="clavebotoneditareliminarlistaunidadconsumo">Guardar Unidades<?php echo "<br/>" ?>de Consumo</button>
    </div>

    <div style="display:none" id="memberFormListaUnidadConsumo">
        <table class="listaUnidadConsumos-tabla table table-bordered" id="tablaListaUnidadConsumos">
            <thead>
                <tr>
                    <th scope="col">UNIDAD DE CONSUMO</th>
                </tr>
            </thead>
            <tbody style="border-color: #5b9bd5">
                <tr class="fila-fija-listaUnidadConsumos">
                    <td><input type="text" required name="nombre[]" placeholder="Nombre" class="form-control tamano-texto-cuerpo-lista"  id="claveunidadconsumolistaregistrar"/></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            <button type="submit" name="insertarListaUnidadConsumos" class="btn btn-primary tamano-texto-cuerpo-boton" id="clavebotonguardarlistaunidadconsumo">Insertar Unidades<?php echo "<br/>" ?>de Consumo</button>
        </div>
    </div>
</div>