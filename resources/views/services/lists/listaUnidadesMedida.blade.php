<div class="col-sm-6 col-md-3 offset-md-2 col-lg-3 offset-lg-0">
    
    @if (session('errorServidorUnidadesMedidas'))
        <div class="alert alert-danger" role="alert">
            {{session('errorServidorUnidadesMedidas')}}
        </div>
    @endif

    @if (session('mensajeunidadmedida'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('mensajeunidadmedida')}}!</strong>
            <button type="button" class="close btn btn-success btn-sm" data-dismiss="alert" aria-label="Close">
                x
            </button>
        </div>
    @endif

    <div class="margenes-botones">
        <button type="button" class="btn btn-success btn-sm tamano-texto-cuerpo-boton" value="1" onClick="displayFormListaUnidadMedida(this)">See Measurement units</button>
        <button type="button" class="btn btn-primary btn-sm tamano-texto-cuerpo-boton" value="2" onClick="displayFormListaUnidadMedida(this)">Register Unit of measurement</button>
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
            <button type="submit" name="actualizarListaUnidadMedida" class="btn btn-warning boton-actualizar tamano-texto-cuerpo-boton">Update Unidad<?php echo "<br/>" ?>Medida</button>
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
                    <button type="submit" name="insertarListaUnidadMedida" class="btn btn-info tamano-texto-cuerpo-boton">Insert Measurement<?php echo "<br/>" ?>Units</button>
                @endcan
                <button id="adicionalListaUnidadMedida" name="adicionalListaUnidadMedida" type="button" class="btn btn-warning "> More + </button>
                <button id="eliminarListaUnidadMedida" name="eliminarListaUnidadMedida" type="button" class="btn btn-danger"> Less - </button>
            </div>
        </form>
    </div>
</div>