<div class="col-sm-12 col-md-12 offset-md-12 col-lg-12 offset-lg-0">

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="displayFormModelosInsumosModelos">
        <label class="form-check-label" for="displayFormModelosInsumosModelos" style="text-align: left;">Ver/Registrar Modelos de Familias</label>
    </div>

    <div id="requestFormModelosInsumosModelos">
        <table id="modelosInsumosModelos" class="modelosInsumosModelos-tabla table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Familia</th>
                    <th scope="col">Modelo</th>
                </tr>
            </thead>
            <tbody style="border-color: #ed7d31" class="cuerpopadremodeloinsumosmodelo" id="cuerpopadremodeloinsumosmodelo"></tbody>
        </table>
        <button type="submit" name="actualizarModelosInsumosModelos" class="btn btn-success tamano-texto-cuerpo-boton" id="clavebotonactualizareliminarmodeloinsumosmodelo">Guardar Modelos de Familia</button>
    </div>

    <div style="display:none" id="memberFormModelosInsumosModelos">
        <table class="modelosInsumosModelos-tabla table table-bordered" id="tablamodeloseinsumosmodelos">
            <thead>
                <tr>
                    <th scope="col">Familia</th>
                    <th scope="col">Modelo</th>
                </tr>
            </thead>
            <tbody style="border-color: #ed7d31">
                <tr class="fila-fija-modeloseinsumosmodelos">
                    <td>
                        <select required name="familia_id[]" class="form-select tamano-texto-cuerpo-lista" aria-label="Default select example" id="clavemodelofamiliaregistrar">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($familias as $familia)
                                <option class="tamano-texto-cuerpo-lista" value="{{$familia->id}}">
                                    {{$familia->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input required name="modelo[]" placeholder="Nombre" class="form-control tamano-texto-cuerpo-lista" id="clavemodelomodeloregistrar"/></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            <button type="submit" name="insertarmodeloseinsumosmodelos" class="btn btn-primary tamano-texto-cuerpo-boton" id="clavebotonguardarmodeloinsumosmodelo">Insertar Modelos de Familia</button>
        </div>
    </div>
</div>