<div class="col-sm-6 col-md-3 offset-md-2 col-lg-3 offset-lg-0">
    
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="displayFormListaFamiliasMateriales">
        <label class="form-check-label" for="displayFormListaFamiliasMateriales">Ver/Registrar Familia de Materiales</label>
    </div>

    <div id="requestFormListaFamiliasMateriales">
        <table id="listaFamiliasMateriales" class="listaFamiliasMateriales-tabla table table-bordered">
            <thead>
                <tr>
                    <th scope="col">FAMILIAS DE MATERIALES</th>
                </tr>
            </thead>
            <tbody style="border-color: #5b9bd5" id="cuerpopadrelistafamiliamateriales"></tbody>
        </table>
        <button type="submit" name="actualizarListaFamiliasMateriale" class="btn btn-success boton-actualizar tamano-texto-cuerpo-boton" id="clavebotoneditareliminarlistafamiliamateriales">Guardar Familia<?php echo "<br/>" ?>de Materiales</button>
    </div>

    <div style="display:none" id="memberFormListaFamiliasMateriales">
        <table class="listaFamiliasMateriales-tabla table table-bordered" id="tablaListaFamiliasMateriales">
            <thead>
                <tr>
                    <th scope="col">FAMILIAS DE MATERIALES</th>
                </tr>
            </thead>
            <tbody style="border-color: #5b9bd5">
                <tr>
                    <td><input required type="text" name="nombre[]" placeholder="Nombre" class="form-control tamano-texto-cuerpo-lista" id="clavefamiliamaterialeslistaregistrar"/></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            <button type="submit" name="insertarListaFamiliasMateriales" class="btn btn-primary tamano-texto-cuerpo-boton" id="clavebotonguardarlistafamiliameteriales">Insertar Familia<?php echo "<br/>" ?>de Material</button>
        </div>
    </div>
</div>