<div class="col-sm-6 col-md-3 offset-md-2 col-lg-2 offset-lg-0">

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="displayFormListaProcesos">
        <label class="form-check-label" for="displayFormListaProcesos">Ver/Registrar Procesos</label>
    </div>

    <div id="requestFormListaProcesos">
        <table id="listaProcesos" class="listaProcesos-tabla table table-bordered">
            <thead>
                <tr>
                    <th scope="col">PROCESO</th>
                </tr>
            </thead>
            <tbody style="border-color: #5b9bd5" id="cuerpopadrelistaprocesos"></tbody>
        </table>
        <button type="submit" name="actualizarListaProceso" class="btn btn-success boton-actualizar tamano-texto-cuerpo-boton" id="clavebotoneditareliminarlistaproceso">Guardar<?php echo "<br/>" ?>Procesos</button>
    </div>

    <div style="display:none" id="memberFormListaProcesos">
        <table class="listaProcesos-tabla table table-bordered" id="tablaListaProcesos">
            <thead>
                <tr>
                    <th scope="col">PROCESO</th>
                </tr>
            </thead>
            <tbody style="border-color: #5b9bd5">
                <tr class="fila-fija-listaProcesos">
                    <td><input type="text" required name="nombre" placeholder="Nombre" class="form-control tamano-texto-cuerpo-lista" id="claveprocesoslistaregistrar"/></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            <button type="submit" name="insertarListaProcesos" class="btn btn-primary tamano-texto-cuerpo-boton" id="clavebotonguardarlistaproceso">Insertar<?php echo "<br/>" ?>Procesos</button>
        </div>
    </div>
</div>