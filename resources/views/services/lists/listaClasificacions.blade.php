<div class="col-sm-6 col-md-3 offset-md-2 col-lg-2 offset-lg-0">

    @if (session('errorServidorclasificacion'))
        <div class="alert alert-danger" role="alert">
            {{session('errorServidorclasificacion')}}
        </div>
    @endif
    
    @if (session('mensajeclasificacion'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('mensajeclasificacion')}}!</strong>
            <button type="button" class="close btn btn-success btn-sm" data-dismiss="alert" aria-label="Close">
                x
            </button>
        </div>
    @endif

    <div class="margenes-botones">
        <input class="form-check-input" value="1" type="radio" name="formselector" onClick="displayFormListaClasificacion(this)" id="checkAactualizar" checked>
        <label class="form-check-label" for="checkActualizar">
            Update
        </label>  
        
        <input class="form-check-input" value="2" type="radio" name="formselector" onClick="displayFormListaClasificacion(this)" id="checkRegistrar">
        <label class="form-check-label" for="checkRegistrar">
            Register
        </label>
    </div>

    <div id="requestFormListaClasificacions">
        {!! Form::open(['url' => 'listaClasificacions/actualizar', 'method' => 'post']) !!}
        <table id="listaClasificacions" class="listaClasificacions-tabla table table-bordered">
            <thead>
                <tr>
                    <th scope="col">CLASIFICACION</th>
                </tr>
            </thead>
            <tbody style="border-color: #5b9bd5">
                @foreach ($listaClasificacions as $listaClasificacion)
                <tr>
                    <input hidden name="id[]" value="<?php echo $listaClasificacion->id ?>">
                    <td><input type="text" class="form-control listaClasificacionstextolista tamano-texto-cuerpo-lista" name="nombre[<?php echo $listaClasificacion->id ?>]" value="<?php echo $listaClasificacion->nombre ?>"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @can('listas.actualizarclasificacions')
            <button type="submit" name="actualizarListaClasificacion" class="btn btn-warning boton-actualizar tamano-texto-cuerpo-boton">Update<?php echo "<br/>" ?>Clasificaciones</button>
        @endcan
        {!! Form::close() !!}
    </div>

    <div style="display:none" id="memberFormistaClasificacions">
        <form action="{{route('listas.registrarclasificacions')}}" method="POST">
            @csrf
            <table class="listaClasificacions-tabla table table-bordered" id="tablaListaClasificacions">
                <thead>
                    <tr>
                        <th scope="col">CLASIFICACION</th>
                    </tr>
                </thead>
                <tbody style="border-color: #5b9bd5">
                    <tr class="fila-fija-listaClasificacions">
                        <td><input required type="text" name="nombre[]" placeholder="Nombre" class="form-control tamano-texto-cuerpo-lista"/></td>
                    </tr>
                </tbody>
            </table>
            <div class="btn-der">
                @can('listas.registrarclasificacions')
                    <button type="submit" name="insertarListaClasificacions" class="btn btn-info tamano-texto-cuerpo-boton">Insert<?php echo "<br/>" ?>Classifications</button>
                @endcan
                <button id="adicionalListaClasificacions" name="adicionalListaClasificacions" type="button" class="btn btn-warning"> More + </button>
                <button id="eliminarListaClasificacions" name="eliminarListaClasificacions" type="button" class="btn btn-danger"> Less - </button>
            </div>
        </form>
    </div>
</div>