<div class="col-sm-12 col-md-12 offset-md-12 col-lg-12 offset-lg-0">

    @if (session('errorUserInsumos'))
        <div class="alert alert-warning" role="alert">
            {{session('errorUserInsumos')}}
        </div>
    @endif

    @if (session('mensajeinsumos'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('mensajeinsumos')}}!</strong>
            <button type="button" class="close btn btn-success btn-sm" data-dismiss="alert" aria-label="Close">
                x
            </button>
        </div>
    @endif

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="displayFormModelosInsumosInsumos">
        <label class="form-check-label" for="displayFormModelosInsumosInsumos" style="text-align: left">Ver/Registrar Insumos de Familias</label>
    </div>

    <div id="requestFormModelosInsumosInsumos">
        {!! Form::open(['url' => 'modeloseinsumosinsumos/actualizar', 'method' => 'post']) !!}
        <table id="modelosInsumosInsumos" class="modelosInsumosInsumos-tabla table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Familia</th>
                    <th scope="col">Familia de Materiales</th>
                </tr>
            </thead>
            <tbody style="border-color: #ed7d31">
                @foreach ($insumofamilias as $insumofamilia)
                <tr>
                    <input hidden name="id[]" value="<?php echo $insumofamilia->id ?>">
                    <td>
                        <select class="form-control tamano-texto-cuerpo-lista" id="familia_id" name="familia_id[<?php echo $insumofamilia->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($familias as $familia)
                                <option class="tamano-texto-cuerpo-lista" value="{{$familia->id}}" @if($familia->id===$insumofamilia->familia_id) selected='selected' @endif>
                                    {{$familia->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="form-control tamano-texto-cuerpo-lista" id="listafamiliamateriales_id" name="listafamiliamateriales_id[<?php echo $insumofamilia->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($familiasMateriales as $familiasMateriale)
                                <option class="tamano-texto-cuerpo-lista" value="{{$familiasMateriale->id}}" @if($familiasMateriale->id===$insumofamilia->listafamiliamateriales_id) selected='selected' @endif>
                                    {{$familiasMateriale->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" name="actualizarModelosInsumosInsumos" class="btn btn-success tamano-texto-cuerpo-boton">Guardar Insumos de Familias</button>
        {!! Form::close() !!}
    </div>

    <div style="display:none" id="memberFormModelosInsumosInsumos">
        <form action="{{route('modeloseinsumos.registrarmodeloseinsumosinsumos')}}" method="POST">
            @csrf
            <table class="modelosInsumosInsumos-tabla table table-bordered" id="tablamodeloseinsumosinsumos">
                <thead>
                    <tr>
                        <th scope="col">Familia</th>
                        <th scope="col">Familia de Materiales</th>
                    </tr>
                </thead>
                <tbody style="border-color: #ed7d31">
                    <tr class="fila-fija-modeloseinsumosinsumos">
                        <td>
                            <select required name="familia_id[]" class="form-select tamano-texto-cuerpo-lista" aria-label="Default select example">
                                <option class="tamano-texto-cuerpo-lista" value="">--</option>
                                @foreach ($familias as $familia)
                                    <option class="tamano-texto-cuerpo-lista" value="{{$familia->id}}">
                                        {{$familia->nombre}}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select required name="listafamiliamateriales_id[]" class="form-select tamano-texto-cuerpo-lista" aria-label="Default select example">
                                <option class="tamano-texto-cuerpo-lista" value="">--</option>
                                @foreach ($familiasMateriales as $familiasMateriale)
                                    <option class="tamano-texto-cuerpo-lista" value="{{$familiasMateriale->id}}">
                                        {{$familiasMateriale->nombre}}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="btn-der">
                <button type="submit" name="insertarmodeloseinsumosinsumos" class="btn btn-primary tamano-texto-cuerpo-boton">Insertar Insumos de Familias</button>
                <button id="adicionalmodeloseinsumosinsumos" name="adicionalmodeloseinsumosinsumos" type="button" class="btn btn-warning"> More + </button>
                <button id="eliminarmodeloseinsumosinsumos" name="eliminarmodeloseinsumosinsumos" type="button" class="btn btn-danger"> Less - </button>
            </div>
        </form>
    </div>
</div>