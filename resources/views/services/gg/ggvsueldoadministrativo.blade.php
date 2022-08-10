<div class="gif-subtituloempleados">
    <div>
        <p>4.2</p>
    </div>
    <div>
        <p style="text-align: center">VENTAS</p>
    </div>
    <div>
        <input style="background-color: #2f5496" disabled class="form-control costoggv" type="text">
    </div>
</div>

<br>

<div class="margenes-botones">
    <button type="button" class="btn btn-success btn-sm tamano-texto-cuerpo-boton" value="1" onClick="displayFormggvsueldosadministrativos(this)">Ver Sueldos Administrativos</button>
    <button type="button" class="btn btn-primary btn-sm tamano-texto-cuerpo-boton" value="2" onClick="displayFormggvsueldosadministrativos(this)">Registrar Sueldo Administrativo</button>
    <button type="button" class="btn btn-info btn-sm tamano-texto-cuerpo-boton" data-bs-toggle="modal" data-bs-target="#ggvstaticBackdrop">
        Regimen Laboral
    </button>
</div>

<div id="requestFormggvsueldosadministrativos">
    {!! Form::open(['url' => 'ggvsueldoadministrativo/actualizar', 'method' => 'post']) !!}
    <table id="ggvsueldosadministrativos" class="ggvsueldosadministrativos-tabla table table-bordered">
        <thead>
            <tr style="background-color: #ececec">
                <th scope="col">Sueldos Administrativos</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Sueldo Mensual en Planilla</th>
                <th scope="col">Honorarios Mensuales</th>
                <th scope="col">Regimen Laboral</th>
                <th scope="col">Gastos Mensuales</th>
            </tr>
        </thead>
        <tbody class="cuerpopadreggvsueldosadministrativos">
            <?php $i = 0; ?>
            @foreach ($ggvsueldosadministrativos as $ggvsueldosadministrativo)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $ggvsueldosadministrativo->id ?>">
                    <td><input hidden type="text"></td>
                    <td><input type="text" class="ggvsadescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $ggvsueldosadministrativo->id ?>]" value="<?php echo $ggvsueldosadministrativo->descripcion ?>"></td>
                    <td><input class="ggvsasueldomensualplanilla-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="sueldomensualplanilla[<?php echo $ggvsueldosadministrativo->id ?>]" value="<?php echo $ggvsueldosadministrativo->sueldomensualplanilla ?>"></td>
                    <td><input class="ggvsahonoratiosmensuales-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" name="honoratiosmensuales[<?php echo $ggvsueldosadministrativo->id ?>]" value="<?php echo $ggvsueldosadministrativo->honoratiosmensuales ?>"></td>
                    <td>
                        <select class="ggvsaregimenlaboral-<?php echo $i ?> form-control" name="regimenlaboral_id[<?php echo $ggvsueldosadministrativo->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($regimenlaboralventas as $regimenlaboralventa)
                                <option class="tamano-texto-cuerpo-lista" value="{{$regimenlaboralventa->numero}}" @if($regimenlaboralventa->id===$ggvsueldosadministrativo->regimenlaboral_id) selected='selected' @endif>
                                    {{$regimenlaboralventa->nombre}} -> {{$regimenlaboralventa->numero}}%
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input disabled class="ggvsatotalgastomensual-<?php echo $i ?> form-control familianumeroslista tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gg.actualizar')
        <input type="submit" name="actualizarggvsueldosadministrativos" value="Actualizar Sueldos Administrativos" class="btn btn-warning tamano-texto-cuerpo-boton"/>
    @endcan
    
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormggvsueldosadministrativos">
    <form action="{{route('ggvsueldoadministrativo.registrarggvsueldoadministrativo')}}" method="POST">
        @csrf
        <table class="ggvsueldosadministrativos-tabla table table-bordered" id="tabla">
            <thead>
                <tr style="background-color: #ececec">
                    <th scope="col">Sueldos Administrativos</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Sueldo Mensual en Planilla</th>
                    <th scope="col">Honorarios Mensuales</th>
                    <th scope="col">Regimen Laboral</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input hidden type="text"></td>
                    <td><input required type="text" class="form-control tamano-texto-cuerpo-lista" name="descripcion"></td>
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="sueldomensualplanilla"></td>
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="honoratiosmensuales"></td>
                    <td>
                        <select required class="form-control" name="regimenlaboral_id">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($regimenlaboralventas as $regimenlaboralventa)
                                <option class="tamano-texto-cuerpo-lista" value="{{$regimenlaboralventa->id}}">
                                    {{$regimenlaboralventa->nombre}} -> {{$regimenlaboralventa->numero}}%
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            @can('gg.registrar')
                <input type="submit" name="insertarggvsueldosadministrativos" value="Insertar Sueldo Administrativo" class="btn btn-info"/>
            @endcan
        </div>
    </form>
</div>

{{-- MODAL DE REGIMEN LABORAL SIN BENEFICIO --}}
<div class="modal fade" id="ggvstaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="EjemploModalLabel">Regimen Laboral</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="margenes-botones">
                <button type="button" class="btn btn-success btn-sm tamano-texto-cuerpo-boton" value="1" onClick="displayFormgggasueldosadministrativosmodal(this)">Ver Regimenes Laborales</button>
                <button type="button" class="btn btn-primary btn-sm tamano-texto-cuerpo-boton" value="2" onClick="displayFormgggasueldosadministrativosmodal(this)">Registrar Regimen Laboral</button>
            </div>

            <div id="requestFormggvsueldosadministrativosmodal">
                {!! Form::open(['url' => 'ggvsueldoadministrativomodal/actualizar', 'method' => 'post']) !!}
                    <table id="ggvsueldosadministrativosmodal" class="ggvsueldosadministrativosmodal-tabla table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Numero</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($regimenlaboralventas as $regimenlaboralventa)
                                <tr>
                                    <input hidden name="id[]" value="<?php echo $regimenlaboralventa->id ?>">
                                    <td><input type="text" class="form-control tamano-texto-cuerpo-lista" name="nombre[<?php echo $regimenlaboralventa->id ?>]" value="<?php echo $regimenlaboralventa->nombre ?>"></td>
                                    <td><input class="form-control familianumeroslista tamano-texto-cuerpo-lista" name="numero[<?php echo $regimenlaboralventa->id ?>]" value="<?php echo $regimenlaboralventa->numero ?>"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="submit" name="actualizarggvsueldosadministrativosmodal" value="Actualizar Regimenes Laborales" class="btn btn-warning tamano-texto-cuerpo-boton"/>
                {!! Form::close() !!}
            </div>

            <div style="display:none" id="memberFormggvsueldosadministrativosmodal">
                {!! Form::open(['url' => 'ggvsueldoadministrativomodal', 'method' => 'post']) !!}
                <table class="ggvsueldosadministrativosmodal-tabla table table-bordered" id="tabla">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Numero</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input required type="text" class="form-control tamano-texto-cuerpo-lista" name="nombre"></td>
                            <td><input required class="form-control tamano-texto-cuerpo-lista" name="numero"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="btn-der">
                    <input type="submit" name="insertarggvsueldosadministrativosmodal" value="Insertar Regimen Laboral" class="btn btn-info"/>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
      </div>
    </div>
  </div>
{{-- MODAL DE REGIMEN LABORAL SIN BENEFICIO --}}
