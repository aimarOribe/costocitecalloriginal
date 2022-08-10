<div class="col-sm-12 col-md-12 offset-md-12 col-lg-12 offset-lg-0">

    @if (session('errorUserModelos'))
        <div class="alert alert-warning" role="alert">
            {{session('errorUserModelos')}}
        </div>
    @endif

    @if (session('mensajemodelos'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('mensajemodelos')}}!</strong>
            <button type="button" class="close btn btn-success btn-sm" data-dismiss="alert" aria-label="Close">
                x
            </button>
        </div>
    @endif

    <div class="margenes-botones">
        <button type="button" class="btn btn-success btn-sm tamano-texto-cuerpo-boton" value="1" onClick="displayFormModelosInsumosModelos(this)">See Model Families</button>
        <button type="button" class="btn btn-primary btn-sm tamano-texto-cuerpo-boton" value="2" onClick="displayFormModelosInsumosModelos(this)">Register Model Family</button>
    </div>

    <div id="requestFormModelosInsumosModelos">
        {!! Form::open(['url' => 'modeloseinsumosmodelos/actualizar', 'method' => 'post']) !!}
        <table id="modelosInsumosModelos" class="modelosInsumosModelos-tabla table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Familia</th>
                    <th scope="col">Modelo</th>
                </tr>
            </thead>
            <tbody style="border-color: #ed7d31">
                @foreach ($modelofamilias as $modelofamilia)
                <tr>
                    <input hidden name="id[]" value="<?php echo $modelofamilia->id ?>">
                    <td>
                        <select class="form-control" id="familia_id" name="familia_id[<?php echo $modelofamilia->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="--">--</option>
                            @foreach ($familias as $familia)
                                <option class="tamano-texto-cuerpo-lista" value="{{$familia->id}}" @if($familia->id===$modelofamilia->familia_id) selected='selected' @endif>
                                    {{$familia->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input class="form-control tamano-texto-cuerpo-lista" type="text" name="modelo[<?php echo $modelofamilia->id ?>]" value="<?php echo $modelofamilia->modelo ?>"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @can('modeloseinsumos.actualizarmodeloseinsumosmodelos')
            <button type="submit" name="actualizarModelosInsumosModelos" class="btn btn-warning boton-actualizar tamano-texto-cuerpo-boton">Update<?php echo "<br/>" ?>Models</button>
        @endcan
        {!! Form::close() !!}
    </div>

    <div style="display:none" id="memberFormModelosInsumosModelos">
        <form action="{{route('modeloseinsumos.registrarmodeloseinsumosmodelos')}}" method="POST">
            @csrf
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
                            <select name="familia_id[]" class="form-select tamano-texto-cuerpo-lista" aria-label="Default select example">
                                <option class="tamano-texto-cuerpo-lista">--</option>
                                @foreach ($familias as $familia)
                                    <option class="tamano-texto-cuerpo-lista" value="{{$familia->id}}">
                                        {{$familia->nombre}}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input required name="modelo[]" placeholder="Nombre" class="form-control tamano-texto-cuerpo-lista"/></td>
                    </tr>
                </tbody>
            </table>
            <div class="btn-der">
                @can('modeloseinsumos.registrarmodeloseinsumosmodelos')
                    <button type="submit" name="insertarmodeloseinsumosmodelos" class="btn btn-info tamano-texto-cuerpo-boton">Insert<?php echo "<br/>" ?>Models</button>
                @endcan
                <button id="adicionalmodeloseinsumosmodelos" name="adicionalmodeloseinsumosmodelos" type="button" class="btn btn-warning"> More + </button>
                <button id="eliminarmodeloseinsumosmodelos" name="eliminarmodeloseinsumosmodelos" type="button" class="btn btn-danger"> Less - </button>
            </div>
        </form>
    </div>
</div>