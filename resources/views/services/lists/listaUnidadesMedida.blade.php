<div class="col-sm-6 col-md-3 offset-md-2 col-lg-3 offset-lg-0">

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="displayFormListaUnidadMedida">
        <label class="form-check-label" for="displayFormListaUnidadMedida">Ver/Registrar Unidades de Medida</label>
    </div>

    <div id="requestFormListaUnidadDeMedidas">
        {!! Form::open(['url' => 'listaUnidadMedidas/actualizar', 'method' => 'post']) !!}
        <table id="unidadMedidas" class="listaUnidadDeMedidas-tabla table table-bordered">
            <thead>
                <tr>
                    <th scope="col">UNIDAD MEDIDA</th>
                </tr>
            </thead>
            <tbody style="border-color: #5b9bd5">
                @foreach ($listaUnidadDeMedidas as $listaUnidadDeMedida)
                <tr>
                    <input hidden name="id[]" value="<?php echo $listaUnidadDeMedida->id ?>">
                    <td><input type="text" class="form-control unidadDeMedidatextolista tamano-texto-cuerpo-lista" name="nombre[<?php echo $listaUnidadDeMedida->id ?>]" value="<?php echo $listaUnidadDeMedida->nombre ?>"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @can('listas.actualizarlistaUnidadMedidas')
            <button type="submit" name="actualizarListaUnidadMedida" class="btn btn-success boton-actualizar tamano-texto-cuerpo-boton">Guardar Unidades<?php echo "<br/>" ?>de Medida</button>
        @endcan
        {!! Form::close() !!}
    </div>

    <div style="display:none" id="memberFormListaUnidadDeMedidas">
        <form action="{{route('listas.registrarlistaUnidadMedidas')}}" method="POST">
            @csrf
            <table class="listaUnidadDeMedidas-tabla table table-bordered" id="tablaListaUnidadMedida">
                <thead>
                    <tr>
                        <th scope="col">UNIDAD MEDIDA</th>
                    </tr>
                </thead>
                <tbody style="border-color: #5b9bd5">
                    <tr class="fila-fija-listaUnidadDeMedidas">
                        <td><input type="text" required name="nombre[]" placeholder="Nombre" class="form-control tamano-texto-cuerpo-lista"/></td>
                    </tr>
                </tbody>
            </table>
            <div class="btn-der">
                @can('listas.registrarlistaUnidadMedidas')
                    <button type="submit" name="insertarListaUnidadMedida" class="btn btn-primary tamano-texto-cuerpo-boton">Insertar Unidades<?php echo "<br/>" ?>de Medida</button>
                @endcan
                <button id="adicionalListaUnidadMedida" name="adicionalListaUnidadMedida" type="button" class="btn btn-warning "> More + </button>
                <button id="eliminarListaUnidadMedida" name="eliminarListaUnidadMedida" type="button" class="btn btn-danger"> Less - </button>
            </div>
        </form>
    </div>
</div>