@extends('layouts.template')

@section('title','Familia')

@section('css')
    <link rel="stylesheet" href="{{asset('css/familia.css')}}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css"> --}}
@endsection

@section('content')
    @if (auth()->user()->can('familias.inicio'))
        <div class="margen-principal">
            <div class="card">
                <div class="card-body">
                    <div class="margenes-botones">
                        <input class="form-check-input" value="1" type="radio" name="formselector" onClick="displayForm(this)" id="checkAactualizar" checked>
                        <label class="form-check-label" for="checkActualizar">
                            Update
                        </label>  
                        
                        <input class="form-check-input" value="2" type="radio" name="formselector" onClick="displayForm(this)" id="checkRegistrar">
                        <label class="form-check-label" for="checkRegistrar">
                            Register
                        </label>
                    </div>

                    <div id="requestForm">
                        {!! Form::open(['url' => 'familias/actualizar', 'method' => 'post']) !!}
                        <table id="familias" class="familia-tabla table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">FAMILIA</th>
                                    <th scope="col">CAP. PROD SEM (DOCENAS)</th>
                                    <th scope="col">CAP PROD MENSUAL</th>
                                </tr>
                            </thead>
                            <tbody style="border-color: #ed7d31">
                                @foreach ($familias as $familia)
                                    <tr>
                                        <input hidden name="id[]" value="<?php echo $familia->id ?>">
                                        <td><input class="form-control tamano-texto-cuerpo-lista" name="nombre[<?php echo $familia->id ?>]" value="<?php echo $familia->nombre ?>"></td>
                                        <td><input class="form-control familianumeroslista tamano-texto-cuerpo-lista" name="capprosemdocenas[<?php echo $familia->id ?>]" value="<?php echo $familia->capprosemdocenas ?>"></td>
                                        <td><input class="form-control familianumeroslista tamano-texto-cuerpo-lista" name="capprodmensual[<?php echo $familia->id ?>]" value="<?php echo $familia->capprodmensual ?>"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @can('familias.actualizar')
                            <input type="submit" name="actualizar" value="Update Families" class="btn btn-warning tamano-texto-cuerpo-boton"/>
                        @endcan
                        {!! Form::close() !!}
                    </div>
                    
                    <div style="display:none" id="memberForm">
                        <form action="{{route('familias.registrar')}}" method="POST">
                            @csrf
                            <table class="familia-tabla table table-bordered" id="tabla">
                                <tr class="fila-fija">
                                    <td><input required name="nombre[]" placeholder="Name" class="form-control tamano-texto-cuerpo-lista"/></td>
                                    <td><input required name="capprosemdocenas[]" placeholder="CAP. PROD SEM (DOCENAS)" class="form-control tamano-texto-cuerpo-lista"/></td>
                                    <td><input required name="capprodmensual[]" placeholder="CAP PROD MENSUAL" class="form-control tamano-texto-cuerpo-lista"/></td>
                                </tr>
                            </table>
                            <div class="btn-der">
                                @can('familias.registrar')
                                    <input type="submit" name="insertar" value="Insert Families" class="btn btn-info"/>
                                @endcan
                                <button id="adicional" name="adicional" type="button" class="btn btn-warning"> More + </button>
                                <button id="eliminar" name="eliminar" type="button" class="btn btn-danger"> Less - </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="centrar-texto">
            <img src="https://cdn-icons-png.flaticon.com/512/2622/2622112.png" height="400px" width="400px" alt="Persona Triste">
            <div>
                <form action="{{route('home.inicio')}}" method="GET">
                    <p>Ya no tiene esta hoja Asignada</p>
                    <div>
                        <button type="submit" class="btn btn-success tamano-texto">
                            Regresar al Inicio
                        </button>
                    </div>
                </form>
            </div>
            
        </div>
    @endif
    
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/familia.js')}}"></script>
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $('#familias').DataTable({
            searching: false,
            responsive: true,
            autoWidth: false
        });
    </script> --}}
@endsection