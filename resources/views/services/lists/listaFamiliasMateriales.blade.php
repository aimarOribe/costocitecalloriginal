<div class="col-sm-6 col-md-3 offset-md-2 col-lg-3 offset-lg-0">
    
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="displayFormListaFamiliasMateriales">
        <label class="form-check-label" for="displayFormListaFamiliasMateriales">Ver/Registrar Familia de Materiales</label>
    </div>

    <div id="requestFormListaFamiliasMateriales">
        {!! Form::open(['url' => 'listaFamiliasMateriales/actualizar', 'method' => 'post']) !!}
        <table id="listaFamiliasMateriales" class="listaFamiliasMateriales-tabla table table-bordered">
            <thead>
                <tr>
                    <th scope="col">FAMILIAS DE MATERIALES</th>
                </tr>
            </thead>
            <tbody style="border-color: #5b9bd5">
                @foreach ($listaFamiliasMateriales as $listaFamiliasMaterial)
                <tr>
                    <input hidden name="id[]" value="<?php echo $listaFamiliasMaterial->id ?>">
                    <td><input type="text" class="form-control listaFamiliasMaterialestextolista tamano-texto-cuerpo-lista" name="nombre[<?php echo $listaFamiliasMaterial->id ?>]" value="<?php echo $listaFamiliasMaterial->nombre ?>"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @can('listas.actualizarlistaFamiliasMateriales')
            <button type="submit" name="actualizarListaFamiliasMateriale" class="btn btn-success boton-actualizar tamano-texto-cuerpo-boton">Guardar Familia<?php echo "<br/>" ?>de Materiales</button>
        @endcan
        
        {!! Form::close() !!}
    </div>

    <div style="display:none" id="memberFormListaFamiliasMateriales">
        <form action="{{route('listas.registrarlistaFamiliasMateriales')}}" method="POST">
            @csrf
            <table class="listaFamiliasMateriales-tabla table table-bordered" id="tablaListaFamiliasMateriales">
                <thead>
                    <tr>
                        <th scope="col">FAMILIAS DE MATERIALES</th>
                    </tr>
                </thead>
                <tbody style="border-color: #5b9bd5">
                    <tr class="fila-fija-listaFamiliasMateriales">
                        <td><input required type="text" name="nombre[]" placeholder="Nombre" class="form-control tamano-texto-cuerpo-lista"/></td>
                    </tr>
                </tbody>
            </table>
            <div class="btn-der">
                @can('listas.registrarlistaFamiliasMateriales')
                    <button type="submit" name="insertarListaFamiliasMateriales" class="btn btn-primary tamano-texto-cuerpo-boton">Insertar Familia<?php echo "<br/>" ?>de Material</button>
                @endcan
                <button id="adicionalListaFamiliasMateriales" name="adicionalListaFamiliasMateriales" type="button" class="btn btn-warning"> More + </button>
                <button id="eliminarListaFamiliasMateriales" name="eliminarListaFamiliasMateriales" type="button" class="btn btn-danger"> Less - </button>
            </div>
        </form>
    </div>
</div>