<div class="col-sm-6 col-md-3 offset-md-2 col-lg-2 offset-lg-0">

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="displayFormListaUnidadConsumo">
        <label class="form-check-label" for="displayFormListaUnidadConsumo">Ver/Registrar Unidades de Consumo</label>
    </div>

    <div id="requestFormListaUnidadConsumo">
        {!! Form::open(['url' => 'listaUnidadConsumo/actualizar', 'method' => 'post']) !!}
        <table id="listaUnidadConsumos" class="listaUnidadConsumos-tabla table table-bordered">
            <thead>
                <tr>
                    <th scope="col">UNIDAD DE CONSUMO</th>
                </tr>
            </thead>
            <tbody style="border-color: #5b9bd5">
                @foreach ($listaUnidadConsumos as $listaUnidadConsumo)
                <tr>
                    <input hidden name="id[]" value="<?php echo $listaUnidadConsumo->id ?>">
                    <td><input type="text" class="form-control listaUnidadConsumoStextolista tamano-texto-cuerpo-lista" name="nombre[<?php echo $listaUnidadConsumo->id ?>]" value="<?php echo $listaUnidadConsumo->nombre ?>"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @can('listas.actualizarlistaUnidadConsumo')
            <button type="submit" name="actualizarListaUnidadConsumo" class="btn btn-success tamano-texto-cuerpo-boton boton-actualizar">Guardar Unidades<?php echo "<br/>" ?>de Consumo</button>
        @endcan
        {!! Form::close() !!}
    </div>

    <div style="display:none" id="memberFormListaUnidadConsumo">
        <form action="{{route('listas.registrarlistaUnidadConsumo')}}" method="POST">
            @csrf
            <table class="listaUnidadConsumos-tabla table table-bordered" id="tablaListaUnidadConsumos">
                <thead>
                    <tr>
                        <th scope="col">UNIDAD DE CONSUMO</th>
                    </tr>
                </thead>
                <tbody style="border-color: #5b9bd5">
                    <tr class="fila-fija-listaUnidadConsumos">
                        <td><input type="text" required name="nombre[]" placeholder="Nombre" class="form-control tamano-texto-cuerpo-lista"/></td>
                    </tr>
                </tbody>
            </table>
            <div class="btn-der">
                @can('listas.registrarlistaUnidadConsumo')
                    <button type="submit" name="insertarListaUnidadConsumos" class="btn btn-primary tamano-texto-cuerpo-boton">Insertar Unidades<?php echo "<br/>" ?>de Consumo</button>
                @endcan
                <button id="adicionalListaUnidadConsumos" name="adicionalListaUnidadConsumos" type="button" class="btn btn-warning"> More + </button>
                <button id="eliminarListaUnidadConsumos" name="eliminarListaUnidadConsumos" type="button" class="btn btn-danger"> Less - </button>
            </div>
        </form>
    </div>
</div>