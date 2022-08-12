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

            return redirect()->route('dep.inicio')->with('mensajeped',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('dep.inicio')->with('errorUser',$error);
        }
    }

    public function actualizardeps(Request $request){
        try {
            $mensaje = "";
            if(!$request->hasAny(['activo','fecha','costodolar','cambiodolarfechacompra','costosoles','unidades','costototal','aniosadepreciar','valorresidual','depreciacionanual'])){
                $mensaje = "No se encontro registros a guardar";
            }else{
                foreach ($request->id as $ids) {
                    if($request->activo[$ids] == "" & $request->fecha[$ids] == "" & $request->costodolar[$ids] == "" & $request->cambiodolarfechacompra[$ids] == "" & $request->costosoles[$ids] == "" & $request->unidades[$ids] == "" & $request->costototal[$ids] == "" & $request->aniosadepreciar[$ids] == "" & $request->valorresidual[$ids] == "" & $request->depreciacionanual[$ids] == ""){
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
                            throw new Exception("Tiene que introducir un activo");
                        }
                        if($fecha == ""){
                            throw new Exception("Tiene que introducir una fecha");
                        }
                        if($costodolar == ""){
                            throw new Exception("Tiene que introducir un costo en dolares");
                        }
                        if($cambiodolarfechacompra == ""){
                            throw new Exception("Tiene que introducir un cambio de dolar en la fecha de compra");
                        }
                        if($costosoles == ""){
                            throw new Exception("Tiene que introducir un costo en soles");
                        }
                        if($unidades == ""){
                            throw new Exception("Tiene que introducir unidades");
                        }
                        if($aniosadepreciar == ""){
                            throw new Exception("Tiene que introducir los años a depreciar");
                        }
                        if($valorresidual == ""){
                            throw new Exception("Tiene que introducir el valor residual");
                        }                
                        DB::table('deps')
                            ->where('id',$ids)
                            ->update(['activo'=>$activo,'fecha'=>$fecha,'costodolar'=>$costodolar,'cambiodolarfechacompra'=>$cambiodolarfechacompra,'costosoles'=>$costosoles,'unidades'=>$unidades,'costototal'=>$costototal,'aniosadepreciar'=>$aniosadepreciar,'valorresidual'=>$valorresidual,'depreciacionanual'=>$depreciacionanual]);
                        $mensaje = "Dep Actualizado(s) Correctamente";
                    }   
                }
            }
            return redirect()->route('dep.inicio')->with('mensajeped',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('dep.inicio')->with('errorUser',$error);
        }
    }
}
