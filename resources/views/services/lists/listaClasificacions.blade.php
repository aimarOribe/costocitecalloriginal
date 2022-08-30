<div class="col-sm-6 col-md-3 offset-md-2 col-lg-2 offset-lg-0">

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="displayFormListaClasificacion">
        <label class="form-check-label" for="displayFormListaClasificacion">Ver/Registrar Clasificaciones</label>
    </div>

    <div id="requestFormListaClasificacions">
        <table id="listaClasificacions" class="listaClasificacions-tabla table table-bordered">
            <thead>
                <tr>
                    <th scope="col">CLASIFICACION</th>
                </tr>
            </thead>
            <tbody style="border-color: #5b9bd5" id="cuerpopadrelistaclasificacion"></tbody>
        </table>
        <button type="submit" name="actualizarListaClasificacion" class="btn btn-success boton-actualizar tamano-texto-cuerpo-boton" id="clavebotoneditareliminarlistaclasificacion">Guardar<?php echo "<br/>" ?>Clasificaciones</button>
    </div>

    <div style="display:none" id="memberFormistaClasificacions">
        <table class="listaClasificacions-tabla table table-bordered" id="tablaListaClasificacions">
            <thead>
                <tr>
                    <th scope="col">CLASIFICACION</th>
                </tr>
            </thead>
            <tbody style="border-color: #5b9bd5">
                <tr>
                    <td><input required type="text" name="nombre[]" placeholder="Nombre" class="form-control tamano-texto-cuerpo-lista" id="claveclasificacionlistaregistrar"/></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            <button type="submit" name="insertarListaClasificacions" class="btn btn-primary tamano-texto-cuerpo-boton" id="clavebotonguardarlistaclasificacion">Insertar<?php echo "<br/>" ?>Clasificaciones</button>
        </div>
    </div>
</div>