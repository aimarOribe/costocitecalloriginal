<?php

namespace App\Http\Controllers;

use App\Models\Dep;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
        $deps = Dep::all();
        return view('services.dep',compact('deps'));
    }

    public function obtenervalordep(Request $request){
        $costo = $request->texto;
        $costoMensual = $costo/12;
        if(isset($costoMensual)){
            DB::table('depreciacionmensuals')
                    ->where('id', 1)
                    ->update(['total'=>$costoMensual]);
            return response()->json(
                [
                    'success' => true
                ]
            );
        }else{
            return response()->json(
                [
                    'success' => false
                ]
            );
        }
    }

    public function obtenerDeps(){
        $deps = Dep::all();
        return response()->json(
            [
                'deps' => $deps
            ]
        );
    }

    public function registrardeps(Request $request){
        try {
            $mensaje = "";
            $activo = $request->activo;
            $fecha = $request->fecha;
            $costodolar = $request->costodolar;
            $cambiodolarfechacompra = $request->cambiodolarfechacompra;
            $costosoles = $request->costosoles;
            $unidades = $request->unidades;
            $costototal = $request->costototal;
            $aniosadepreciar = $request->aniosadepreciar;
            $valorresidual = $request->valorresidual;
            $depreciacionanual = $request->depreciacionanual;
            
            if($activo == ""){
                throw new Exception("Debe ingresar un Activo");
            }
            if($fecha == ""){
                throw new Exception("Debe ingresar un Fecha");
            }
            if($costodolar == 0){
                $costodolar = 0.00;
            }
            if($cambiodolarfechacompra == 0){
                $cambiodolarfechacompra = 0.00;
            }
            if($costosoles == 0){
                $costosoles = 0.00;
            }
            if($unidades == 0){
                $unidades = 0.00;
            }
            if($costototal == 0 || $costototal == ""){
                throw new Exception("El Costo Total no puede quedar en cero");
            }
            if($aniosadepreciar == 0){
                throw new Exception("Debe ingresar los años a depreciar");
            }
            if($valorresidual == 0){
                throw new Exception("Debe ingresar un valor residual");
            }
            if($depreciacionanual == 0 || $depreciacionanual == ""){
                throw new Exception("La Depreciacion Anual no puede quedar en cero");
            }

            $dep = new Dep();
            $dep->activo = $activo;
            $dep->fecha = $fecha;
            $dep->costodolar = $costodolar;
            $dep->cambiodolarfechacompra = $cambiodolarfechacompra;
            $dep->costosoles = $costosoles;
            $dep->unidades = $unidades;
            $dep->costototal = $costototal;
            $dep->aniosadepreciar = $aniosadepreciar;
            $dep->valorresidual = $valorresidual;
            $dep->depreciacionanual = $depreciacionanual;
            $dep->save();

            $mensaje = "Dep Guardado Correctamente";
            return response()->json(
                [
                    'success' => true,
                    'mensaje' => $mensaje
                ]
            );
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        }
    }

    public function actualizardeps(Request $request){
        try {
            $mensaje = "";
            if(!$request->hasAny(['activo','fecha','costodolar','cambiodolarfechacompra','costosoles','unidades','costototal','aniosadepreciar','valorresidual','depreciacionanual'])){
                $mensaje = "No se encontro registros a guardar";
            }else{
                foreach ($request->id as $ids) {
                    if($request->activo[$ids] == "" & $request->fecha[$ids] == "" & $request->costodolar[$ids] == "" & $request->cambiodolarfechacompra[$ids] == "" & $request->costosoles[$ids] == "" & $request->unidades[$ids] == "" & $request->aniosadepreciar[$ids] == "" & $request->valorresidual[$ids] == ""){
                        $dep = Dep::find($ids);
                        $dep->delete();
                        $mensaje = "Dep Eliminado(s) Correctamente";
                    }else{
                        $activo = $request->activo[$ids];
                        $fecha = $request->fecha[$ids];
                        $costodolar = $request->costodolar[$ids];
                        $cambiodolarfechacompra = $request->cambiodolarfechacompra[$ids];
                        $costosoles = $request->costosoles[$ids];
                        $unidades = $request->unidades[$ids];
                        $costototal = $request->costototal[$ids];
                        $aniosadepreciar = $request->aniosadepreciar[$ids];
                        $valorresidual = $request->valorresidual[$ids];
                        $depreciacionanual = $request->depreciacionanual[$ids];

                        if($activo == ""){
                            throw new Exception("No puedes borrar el activo");
                        }
                        if($fecha == ""){
                            throw new Exception("No puede borrar la fecha");
                        }
                        if($costodolar == ""){
                            throw new Exception("Tiene que introducir un costo en dolares");
                        }
                        if(floatval($costodolar)){
                            $costodolar = floatval($costodolar);
                        }else{
                            $costodolar = 0.0;
                        }
                        if($cambiodolarfechacompra == ""){
                            throw new Exception("Tiene que introducir un cambio de dolar en la fecha de compra");
                        }
                        if(floatval($cambiodolarfechacompra)){
                            $cambiodolarfechacompra = floatval($cambiodolarfechacompra);
                        }else{
                            $cambiodolarfechacompra = 0.0;
                        }
                        if($costosoles == ""){
                            throw new Exception("Tiene que introducir un costo en soles");
                        }
                        if(floatval($costosoles)){
                            $costosoles = floatval($costosoles);
                        }else{
                            $costosoles = 0.0;
                        }
                        if($unidades == ""){
                            throw new Exception("Tiene que introducir unidades");
                        }

                        if($aniosadepreciar == ""){
                            throw new Exception("No pude borrar el año a depreciar");
                        }
                        if(floatval($aniosadepreciar)){
                            $aniosadepreciar = floatval($aniosadepreciar);
                        }else{
                            $aniosadepreciar = 0.0;
                        }
                        if($valorresidual == ""){
                            throw new Exception("No puede borrar el valor residual");
                        }
                        if(floatval($valorresidual)){
                            $valorresidual = floatval($valorresidual);
                        }else{
                            $valorresidual = 0.0;
                        }
                        
                        if($costototal == "NaN"){
                            throw new Exception("No puede borrar el Costo Total");
                        }
                        if($depreciacionanual == "NaN"){
                            throw new Exception("No puede borrar el la Depreciacion Anual");
                        }
                        DB::table('deps')
                            ->where('id',$ids)
                            ->update(['activo'=>$activo,'fecha'=>$fecha,'costodolar'=>$costodolar,'cambiodolarfechacompra'=>$cambiodolarfechacompra,'costosoles'=>$costosoles,'unidades'=>$unidades,'costototal'=>$costototal,'aniosadepreciar'=>$aniosadepreciar,'valorresidual'=>$valorresidual,'depreciacionanual'=>$depreciacionanual]);
                        $mensaje = "Dep Actualizado(s) Correctamente";
                    }   
                }
            }
            return response()->json(
                [
                    'success' => true,
                    'mensaje' => $mensaje
                ]
            );
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        }
    }
}
