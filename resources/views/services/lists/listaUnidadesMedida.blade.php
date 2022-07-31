<div class="col-sm-6 col-md-3 offset-md-2 col-lg-3 offset-lg-0">
    <div class="margenes-botones">
        <input class="form-check-input" value="1" type="radio" name="formselector" onClick="displayFormListaUnidadMedida(this)" id="checkAactualizar" checked>
        <label class="form-check-label" for="checkActualizar">
            Update
        </label>  
        
        <input class="form-check-input" value="2" type="radio" name="formselector" onClick="displayFormListaUnidadMedida(this)" id="checkRegistrar">
        <label class="form-check-label" for="checkRegistrar">
            Register
          </label>
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
                    <td><input class="form-control unidadDeMedidatextolista tamano-texto-cuerpo-lista" name="nombre[<?php echo $listaUnidadDeMedida->id ?>]" value="<?php echo $listaUnidadDeMedida->nombre ?>"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @can('listas.actualizarlistaUnidadMedidas')
            <button type="submit" name="actualizarListaUnidadMedida" class="btn btn-warning boton-actualizar tamano-texto-cuerpo-boton">Update Unidad<?php echo "<br/>" ?>Medida</button>
        @endcan
        {!! Form::close() !!}
    </div>

    <div style="display:none" id="memberFormListaUnidadDeMedidas">
        <form action="{{route('listas.registrarlistaUnidadMedidas')}}" method="POST">
            @csrf
            <table class="listaUnidadDeMedidas-tabla table table-bordered" id="tablaListaUnidadMedida">
                <tr class="fila-fija-listaUnidadDeMedidas">
                    <td><input required name="nombre[]" placeholder="Nombre" class="form-control tamano-texto-cuerpo-lista"/></td>
                </tr>
            </table>
            <div class="btn-der">
                @can('listas.registrarlistaUnidadMedidas')
                    <button type="submit" name="insertarListaUnidadMedida" class="btn btn-info tamano-texto-cuerpo-boton">Insert Measurement<?php echo "<br/>" ?>Units</button>
                @endcan
                <button id="adicionalListaUnidadMedida" name="adicionalListaUnidadMedida" type="button" class="btn btn-warning "> More + </button>
                <button id="eliminarListaUnidadMedida" name="eliminarListaUnidadMedida" type="button" class="btn btn-danger"> Less - </button>
            </div>
        </form>
    </div>
</div>