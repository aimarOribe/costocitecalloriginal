<div class="col-sm-6 col-md-3 offset-md-2 col-lg-3 offset-lg-0">
    <div class="margenes-botones">
        <input class="form-check-input" value="1" type="radio" name="formselector" onClick="displayFormListaFamiliasMateriales(this)" id="checkAactualizar" checked>
        <label class="form-check-label" for="checkActualizar">
            Update
        </label>  
        
        <input class="form-check-input" value="2" type="radio" name="formselector" onClick="displayFormListaFamiliasMateriales(this)" id="checkRegistrar">
        <label class="form-check-label" for="checkRegistrar">
            Register
        </label>
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
                    <td><input class="form-control listaFamiliasMaterialestextolista tamano-texto-cuerpo-lista" name="nombre[<?php echo $listaFamiliasMaterial->id ?>]" value="<?php echo $listaFamiliasMaterial->nombre ?>"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @can('listas.actualizarlistaFamiliasMateriales')
            <button type="submit" name="actualizarListaFamiliasMateriale" class="btn btn-warning boton-actualizar tamano-texto-cuerpo-boton">Update Families<?php echo "<br/>" ?>Materials</button>
        @endcan
        
        {!! Form::close() !!}
    </div>

    <div style="display:none" id="memberFormListaFamiliasMateriales">
        <form action="{{route('listas.registrarlistaFamiliasMateriales')}}" method="POST">
            @csrf
            <table class="listaFamiliasMateriales-tabla table table-bordered" id="tablaListaFamiliasMateriales">
                <tr class="fila-fija-listaFamiliasMateriales">
                    <td><input required name="nombre[]" placeholder="Nombre" class="form-control tamano-texto-cuerpo-lista"/></td>
                </tr>
            </table>
            <div class="btn-der">
                @can('listas.registrarlistaFamiliasMateriales')
                    <button type="submit" name="insertarListaFamiliasMateriales" class="btn btn-info tamano-texto-cuerpo-boton">Insert Material<?php echo "<br/>" ?>Families</button>
                @endcan
                <button id="adicionalListaFamiliasMateriales" name="adicionalListaFamiliasMateriales" type="button" class="btn btn-warning"> More + </button>
                <button id="eliminarListaFamiliasMateriales" name="eliminarListaFamiliasMateriales" type="button" class="btn btn-danger"> Less - </button>
            </div>
        </form>
    </div>
</div>