<div class="gif-subtituloempleados">
    <div>
        <p>4.1</p>
    </div>
    <div>
        <p style="text-align: center">GASTOS ADMINISTRATIVOS</p>
    </div>
    <div>
        <input style="background-color: #2f5496" disabled class="form-control costoggga" type="text">
    </div>
</div>

<br>

<div class="margenes-botones">
    <div class="container row">
        <div class="form-check form-switch col-4">
            <input class="form-check-input" type="checkbox" role="switch" id="displayFormgggasueldosadministrativos">
            <label class="form-check-label" for="displayFormgggasueldosadministrativos">Ver/Registrar Sueldos Administrativos</label>
        </div>
        <div class="col-8">
           <button type="button" class="btn btn-secondary btn-sm tamano-texto-cuerpo-boton" data-bs-toggle="modal" data-bs-target="#gggastaticBackdrop">
                Regimen Laboral
            </button> 
        </div>
        
    </div>
</div>

<div id="requestFormgggasueldosadministrativos">
    {!! Form::open(['url' => 'ggsueldoadministrativo/actualizar', 'method' => 'post']) !!}
    <table id="gggasueldosadministrativos" class="gggasueldosadministrativos-tabla table table-bordered">
        <thead>
            <tr style="background-color: #ececec">
                <th scope="col">Sueldos Administrativos</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Sueldo  Mensual en Planilla</th>
                <th scope="col">Sueldo sin planilla</th>
                <th scope="col">Regimen Laboral</th>
                <th scope="col">Total Gasto Mensual</th>
            </tr>
        </thead>
        <tbody class="cuerpopadregggasueldosadministrativos">
            <?php $i = 0; ?>
            @foreach ($gasueldosadministrativos as $gasueldosadministrativo)
                <?php $i++; ?>
                <tr>
                    <input hidden name="id[]" value="<?php echo $gasueldosadministrativo->id ?>">
                    <td><input hidden type="text"></td>
                    <td><input type="text" class="gggadescripcion-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="descripcion[<?php echo $gasueldosadministrativo->id ?>]" value="<?php echo $gasueldosadministrativo->descripcion ?>"></td>
                    <td><input class="gggasueldomensualplanilla-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="sueldomensualplanilla[<?php echo $gasueldosadministrativo->id ?>]" value="<?php echo $gasueldosadministrativo->sueldomensualplanilla ?>"></td>
                    <td><input class="gggasueldosinplanilla-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="sueldosinplanilla[<?php echo $gasueldosadministrativo->id ?>]" value="<?php echo $gasueldosadministrativo->sueldosinplanilla ?>"></td>
                    <td>
                        <select class="gggaregimenlaboral-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" name="regimenlaboral_id[<?php echo $gasueldosadministrativo->id ?>]">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($regimenlaboralgas as $regimenlaboralga)
                                <option class="tamano-texto-cuerpo-lista" value="{{$regimenlaboralga->numero}}" @if($regimenlaboralga->id===$gasueldosadministrativo->regimenlaboral_id) selected='selected' @endif>
                                    {{$regimenlaboralga->nombre}} -> {{$regimenlaboralga->numero}}%
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input readonly class="gggatotalgastomensual-<?php echo $i ?> form-control tamano-texto-cuerpo-lista" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @can('gg.actualizar')
        <input type="submit" name="actualizargggasueldosadministrativos" value="Guardar Sueldos Administrativos" class="btn btn-success tamano-texto-cuerpo-boton"/>
    @endcan
    
    {!! Form::close() !!}
</div>

<div style="display:none" id="memberFormgggasueldosadministrativos">
    <form action="{{route('ggsueldoadministrativo.registrarggsueldoadministrativo')}}" method="POST">
        @csrf
        <table class="gggasueldosadministrativos-tabla table table-bordered" id="tabla">
            <thead>
                <tr style="background-color: #ececec">
                    <th scope="col">Sueldos Administrativos</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Sueldo  Mensual en Planilla</th>
                    <th scope="col">Sueldo sin planilla</th>
                    <th scope="col">Regimen Laboral</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input hidden type="text"></td>
                    <td><input required type="text" class="form-control tamano-texto-cuerpo-lista" name="descripcion"></td>
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="sueldomensualplanilla"></td>
                    <td><input required class="form-control tamano-texto-cuerpo-lista" name="sueldosinplanilla"></td>
                    <td>
                        <select required class="form-control tamano-texto-cuerpo-lista" name="regimenlaboral_id">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            @foreach ($regimenlaboralgas as $regimenlaboralga)
                                <option class="tamano-texto-cuerpo-lista" value="{{$regimenlaboralga->id}}">
                                    {{$regimenlaboralga->nombre}} -> {{$regimenlaboralga->numero}}%
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="btn-der">
            @can('gg.registrar')
                <input type="submit" name="insertargggasueldosadministrativos" value="Insertar Sueldo Administrativo" class="btn btn-primary"/>
            @endcan
        </div>
    </form>
</div>

{{-- MODAL DE REGIMEN LABORAL SIN BENEFICIO --}}
<div class="modal fade" id="gggastaticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="EjemploModalLabel">Regimen Laboral</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="displayFormgggasueldosadministrativosmodal">
                <label class="form-check-label" for="displayFormgggasueldosadministrativosmodal">Ver/Registrar Regimenes Laborales</label>
            </div>

            <div id="requestFormgggasueldosadministrativosmodal">
                {!! Form::open(['url' => 'ggsueldoadministrativosmodal/actualizar', 'method' => 'post']) !!}
                    <table id="gggasueldosadministrativosmodal" class="gggasueldosadministrativosmodal-tabla table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Numero</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($regimenlaboralgas as $regimenlaboralga)
                                <tr>
                                    <input hidden name="id[]" value="<?php echo $regimenlaboralga->id ?>">
                                    <td><input type="text" class="form-control tamano-texto-cuerpo-lista" name="nombre[<?php echo $regimenlaboralga->id ?>]" value="<?php echo $regimenlaboralga->nombre ?>"></td>
                                    <td><input class="form-control tamano-texto-cuerpo-lista" name="numero[<?php echo $regimenlaboralga->id ?>]" value="<?php echo $regimenlaboralga->numero ?>"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="submit" name="actualizargggasueldosadministrativosmodal" value="Guardar Regimenes Laborales" class="btn btn-success tamano-texto-cuerpo-boton"/>
                {!! Form::close() !!}
            </div>

            <div style="display:none" id="memberFormgggasueldosadministrativosmodal">
                {!! Form::open(['url' => 'ggsueldoadministrativosmodal', 'method' => 'post']) !!}
                <table class="gggasueldosadministrativosmodal-tabla table table-bordered" id="tabla">
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
                    <input type="submit" name="insertargggasueldosadministrativosmodal" value="Insertar Regimen Laboral" class="btn btn-primary"/>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
      </div>
    </div>
  </div>
{{-- MODAL DE REGIMEN LABORAL SIN BENEFICIO --}}
