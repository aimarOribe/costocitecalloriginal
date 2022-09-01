<div class="col-sm-12 col-md-12 offset-md-12 col-lg-12 offset-lg-0">

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="displayFormModelosInsumosInsumos">
        <label class="form-check-label" for="displayFormModelosInsumosInsumos" style="text-align: left">Ver/Registrar Insumos de Familias</label>
    </div>

    <div id="requestFormModelosInsumosInsumos">
        <table id="modelosInsumosInsumos" class="modelosInsumosInsumos-tabla table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Familia</th>
                    <th scope="col">Familia de Materiales</th>
                </tr>
            </thead>
            <tbody style="border-color: #ed7d31" class="cuerpopadremodeloinsumosinsumos" id="cuerpopadremodeloinsumosinsumos"></tbody>
        </table>
        <button type="submit" name="actualizarModelosInsumosInsumos" class="btn btn-success tamano-texto-cuerpo-boton" id="clavebotonactualizareliminarmodeloinsumosinsumos">Guardar Insumos de Familias</button>
    </div>

    <div style="display:none" id="memberFormModelosInsumosInsumos">
        <table class="modelosInsumosInsumos-tabla table table-bordered" id="tablamodeloseinsumosinsumos">
            <thead>
                <tr>
                    <th scope="col">Familia</th>
                    <th scope="col">Familia de Materiales</th>
                </tr>
            </thead>
            <tbody style="border-color: #ed7d31">
                <tr class="fila-fija-modeloseinsumosinsumos">
                    <td>
                        <select required name="familia_id[]" class="form-select tamano-texto-cuerpo-lista" aria-label="Default select example" id="clavefamiliainsumoregistrar">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($familias as $familia)
                                <option class="tamano-texto-cuerpo-lista" value="{{$familia->id}}">
                                    {{$familia->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select required name="listafamiliamateriales_id[]" class="form-select tamano-texto-cuerpo-lista" aria-label="Default select example" id="clavefamiliamaterialesinsumoregistrar">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($familiasMateriales as $familiasMateriale)
                                <option class="tamano-texto-cuerpo-lista" value="{{$familiasMateriale->id}}">
                                    {{$familiasMateriale->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            <button type="submit" name="insertarmodeloseinsumosinsumos" class="btn btn-primary tamano-texto-cuerpo-boton" id="clavebotonguardarmodeloinsumosinsumos">Insertar Insumos de Familias</button>
        </div>
    </div>
</div>