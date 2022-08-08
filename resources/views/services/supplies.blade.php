@extends('layouts.template')

@section('title','Familia')

@section('css')
    <link rel="stylesheet" href="{{asset('css/insumo.css')}}">
@endsection

@section('content')
    <div class="margen-principal">
        <div class="card">
            <div class="card-body">
                <div style="text-align: center">
                    <button class="btn btn-success m-2" id="botonrdc">Ocultar/Mostrar Registrar Detalle de Compra</button>
                    <button class="btn btn-success m-2" id="botonrcpuc">Ocultar/Mostrar Registrar Contenido por Unidad de Compra</button>
                    <button class="btn btn-success m-2" id="botonreeudc">Ocultar/Mostrar Registrar Equivalencia en Unidad de Consumo</button>
                </div>
                <table class="tablaInsumos table table-bordered">
                    <thead>
                        <tr class="tamano-texto-cabeza-lista">
                            <th class="pprincipalfondocolor color-blanco-texto alinear-texto-centro" rowspan="5" colspan="2">FORMATO DE IDENTIFICACION DE UNIDAD DE MEDIDA Y COMPRA DE MATERIALES</th>
                            <th class="rdc pprincipalfondocolor" colspan="4"></th>
                            <th class="rcpuc pprincipalfondocolor" colspan="5"></th>
                            <th class="reeudc alinear-texto-centro mensajefondocolor" rowspan="4" colspan="4">Si la unidad de consumo es la misma unidad de contenido se registra la misma información (cantenido o total de área, y la misma unidad de medida); caso contrario registrar el indice de equivalencia por unidad de medida de contenido</th>
                            <th class="alinear-texto-centro pprincipalfondocolor" rowspan="6">COSTO POR UNIDAD DE CONSUMO</th>
                        </tr> 
                        <tr>
                            <th class="rdc pprincipalfondocolor" colspan="4"></th>
                            <th class="rcpuc pprincipalfondocolor" colspan="5"></th>
                        </tr> 
                        <tr>
                            <th class="rdc pprincipalfondocolor" colspan="4"></th>
                            <th class="rcpuc pprincipalfondocolor" colspan="5"></th>
                        </tr> 
                        <tr class="tamano-texto-cabeza-lista">
                            <th class="rdc pprincipalfondocolor" colspan="4"></th>
                            <th class="rcpuc alinear-texto-centro pniveldosfondocolor color-blanco-texto" colspan="5">REGISTRAR CONTENIDO POR UNIDAD DE COMPRA</th>
                        </tr> 
                        <tr class="tamano-texto-cabeza-lista">
                            <th class="rdc alinear-texto-centro pnivelunofondocolor color-blanco-texto" colspan="4">REGISTRAR DETALLE DE COMPRA</th>
                            <th class="rcpuc alinear-texto-centro pniveldosfondocolordos color-blanco-texto" colspan="5">Medidas cuando es área</th>
                            <th class="reeudc alinear-texto-centro pniveltresfondocolor color-blanco-texto" colspan="4">REGISTRAR EQUIVALENCIA EN UNIDAD DE CONSUMO</th>
                        </tr> 
                        <tr class="alinear-texto-centro tamano-texto-cabeza-lista">
                            <th class="pprincipalfondocoloritems">FAMILIA</th>
                            <th class="pprincipalfondocoloritems">DESCRIPCION</th>
                            <th class="rdc pnivelunofondocoloritems">PRESENTACION</th>
                            <th class="rdc pnivelunofondocoloritems">UNIDAD DE MEDIDA DE PRESENTACION</th>
                            <th class="rdc pnivelunofondocoloritems">CON IGV</th>
                            <th class="rdc pnivelunofondocoloritems">COSTO (S/.) SIN IGV</th>
                            <th class="rcpuc pniveldosfondocoloritems">CONTENIDO</th>
                            <th class="rcpuc pniveldosfondocoloritems">LARGO (CTM)</th>
                            <th class="rcpuc pniveldosfondocoloritems">ALTO (CTM)</th>
                            <th class="rcpuc pniveldosfondocoloritems">TOTAL AREA (CM2)</th>
                            <th class="rcpuc pniveldosfondocoloritems">UNIDAD DE MEDIDA DE CONTENIDO</th>
                            <th class="reeudc pniveltresfondocoloritems">INDICE DE EQUIVALENCIA</th>
                            <th class="reeudc pniveltresfondocoloritems">UNIDAD DE MEDIDA </th>
                            <th class="reeudc pniveltresfondocoloritems">% MERMA</th>
                            <th class="reeudc pniveltresfondocoloritems">CONTENIDO, EN UNIDAD DE CONSUMO</th>
                            {{-- <th class="pprincipalfondocoloritems">COSTO POR UNIDAD DE CONSUMO</th> --}}
                        </tr> 
                    </thead>
                    <tbody style="border-color: #5b9bd5">
                        <tr class="tamano-texto-cuerpo-lista">
                            <td><input type="text" class="form-control" value="asdasdas"></td>
                            <td>Maria Anders</td>
                            <td>Germany</td>
                            <td>Alfreds Futterkiste</td>
                            <td>Maria Anders</td>
                            <td>Germany</td>
                            <td>Maria Anders</td>
                            <td>Germany</td>
                            <td>Alfreds Futterkiste</td>
                            <td>Maria Anders</td>
                            <td>Germany</td>
                            <td>Germany</td>
                            <td>Alfreds Futterkiste</td>
                            <td>Maria Anders</td>
                            <td>Germany</td>
                            <td>1500</td>
                        </tr>
                        <tr>
                            <td>Centro comercial Moctezuma</td>
                            <td>Francisco Chang</td>
                            <td>Mexico</td>
                            <td>Centro comercial Moctezuma</td>
                            <td>Francisco Chang</td>
                            <td>Mexico</td>
                            <td>Francisco Chang</td>
                            <td>Mexico</td>
                            <td>Centro comercial Moctezuma</td>
                            <td>Francisco Chang</td>
                            <td>Mexico</td>
                            <td>Mexico</td>
                            <td>Centro comercial Moctezuma</td>
                            <td>Francisco Chang</td>
                            <td>Mexico</td>
                            <td>1500</td>
                        </tr>
                        <tr>
                            <td>Ernst Handel</td>
                            <td>Hola</td>
                            <td>holaaa</td>
                            <td>Ernst Handel</td>
                            <td>Hola</td>
                            <td>holaaa</td>
                            <td>Hola</td>
                            <td>holaaa</td>
                            <td>Ernst Handel</td>
                            <td>Hola</td>
                            <td>holaaa</td>
                            <td>holaaa</td>
                            <td>Ernst Handel</td>
                            <td>Hola</td>
                            <td>holaaa</td>
                            <td>1500</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer" style="text-align: center">
                <img src="{{asset('img/tablaindiceconversion.png')}}" alt="Tabla Indice de Conversion" width="500px" class="m-2">
                <img src="{{asset('img/tablamermapormaterial.png')}}" alt="Tabla Merma Por Material" width="500px"class="m-2">
                <img src="{{asset('img/tablaindiceconversionhilos.png')}}" alt="Tabla Indice Conversion Hilos" width="500px" class="m-2">
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/insumo.js')}}"></script>
@endsection