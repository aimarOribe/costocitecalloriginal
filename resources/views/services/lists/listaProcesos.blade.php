<div class="col-sm-6 col-md-3 offset-md-2 col-lg-2 offset-lg-0">

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="displayFormListaProcesos">
        <label class="form-check-label" for="displayFormListaProcesos">Ver/Registrar Procesos</label>
    </div>

    <div id="requestFormListaProcesos">
        {!! Form::open(['url' => 'listaProcesos/actualizar', 'method' => 'post']) !!}
        <table id="listaProcesos" class="listaProcesos-tabla table table-bordered">
            <thead>
                <tr>
                    <th scope="col">PROCESO</th>
                </tr>
            </thead>
            <tbody style="border-color: #5b9bd5">
                @foreach ($listaProcesos as $listaProceso)
                <tr>
                    <input hidden name="id[]" value="<?php echo $listaProceso->id ?>">
                    <td><input type="text" class="form-control listaProcesostextolista tamano-texto-cuerpo-lista" name="nombre[<?php echo $listaProceso->id ?>]" value="<?php echo $listaProceso->nombre ?>"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @can('listas.actualizarlistaProcesos')
        <button type="submit" name="actualizarListaProceso" class="btn btn-success boton-actualizar tamano-texto-cuerpo-boton">Guardar<?php echo "<br/>" ?>Procesos</button>
        @endcan
        {!! Form::close() !!}
    </div>

    <div style="display:none" id="memberFormListaProcesos">
        <form action="{{route('listas.registrarlistaProcesos')}}" method="POST">
            @csrf
            <table class="listaProcesos-tabla table table-bordered" id="tablaListaProcesos">
                <thead>
                    <tr>
                        <th scope="col">PROCESO</th>
                    </tr>
                </thead>
                <tbody style="border-color: #5b9bd5">
                    <tr class="fila-fija-listaProcesos">
                        <td><input type="text" required name="nombre[]" placeholder="Nombre" class="form-control tamano-texto-cuerpo-lista"/></td>
                    </tr>
                </tbody>
            </table>
            <div class="btn-der">
                @can('listas.registrarlistaProcesos')
                    <button type="submit" name="insertarListaProcesos" class="btn btn-primary tamano-texto-cuerpo-boton">Insertar<?php echo "<br/>" ?>Procesos</button>
                @endcan
                <button id="adicionalListaProcesos" name="adicionalListaProcesos" type="button" class="btn btn-warning"> More + </button>
                <button id="eliminarListaProcesos" name="eliminarListaProcesos" type="button" class="btn btn-danger"> Less - </button>
            </div>
        </form>
    </div>
</div>