<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use App\Models\Listaproceso;
use App\Models\Manoobra;
use App\Models\Modelofamilia;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManoObraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
        $manoobras = Manoobra::all();
        $familias = Familia::all();
        $modelos = Modelofamilia::all();
        $procesos = Listaproceso::all();
        return view('services.handwork',compact('manoobras','familias','modelos','procesos'));
    }

    public function obtenerModelos(Request $request){
        if(isset($request->texto)){
            $modelos = Modelofamilia::where('familia_id',$request->texto)->get();
            $manoobra = DB::table('manoobras')->where('familia_id',$request->texto)->get();

            return response()->json(
                [
                    'lista' => $modelos,
                    'manoobras' => $manoobra,
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

    public function registrarmanoobra(Request $request){
        try {
            $mensaje = "";
            $familia_id = $request->familia_id;
            $modelo_id = $request->modelo_id;
            $proceso_id = $request->proceso_id;
            $tiempohora = $request->tiempohora;
            $costo = $request->costo;

            if(floatval($costo)){
                $costo = floatval($costo);
            }else{
                $costo = 0.0;
            }

            $manoobra = new Manoobra();
            $manoobra->familia_id = $familia_id;
            $manoobra->modelo_id = $modelo_id;
            $manoobra->proceso_id = $proceso_id;
            $manoobra->tiempohoras = $tiempohora;
            $manoobra->costo = $costo;
            $manoobra->save();

            $mensaje = "Mano de Obra Agregada Correctamente";

            return redirect()->route('manoobra.inicio')->with('mensajemanoobra',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('manoobra.inicio')->with('errorUserHandWork',$error);
        }
    }

    public function actualizarmanoobra(Request $request){
        try {
            $mensaje = "";
            if(!$request->hasAny(['familia_id','modelo_id','proceso_id','tiempohoras','costo'])){
                $mensaje = "No se encontro registros a guardar";
            }else{
                foreach ($request->id as $ids) {
                    if($request->familia_id[$ids] == "" & $request->modelo_id[$ids] == "" & $request->proceso_id[$ids] == "" & $request->tiempohoras[$ids] == "" & $request->costo[$ids] == ""){
                        $manoobra = Manoobra::find($ids);
                        $manoobra->delete();
                        $mensaje = "Mano de Obra Eliminado(s) Correctamente";
                    }else{
                        $familia_id = $request->familia_id[$ids];
                        $modelo_id = $request->modelo_id[$ids];
                        $proceso_id = $request->proceso_id[$ids];
                        $tiempohoras = $request->tiempohoras[$ids];
                        $costo = $request->costo[$ids];

                        if($familia_id == ""){
                            throw new Exception("No puedes vaciar el campo de familia");
                        }

                        if($modelo_id == ""){
                            throw new Exception("No puedes vaciar el campo de modelo");
                        }
                        if($proceso_id == ""){
                            throw new Exception("No puedes vaciar el campo de proceso");
                        }

                        if($tiempohoras == ""){
                            throw new Exception("No puedes vaciar la hora");
                        }
                        if($costo == ""){
                            throw new Exception("No puedes vaciar el costo");
                        }

                        if(floatval($costo)){
                            $costo = floatval($costo);
                        }else{
                            $costo = 0.0;
                        }

                        DB::table('manoobras')
                            ->where('id',$ids)
                            ->update(['familia_id'=>$familia_id,'modelo_id'=>$modelo_id,'proceso_id'=>$proceso_id,'tiempohoras'=>$tiempohoras,'costo'=>$costo]);
                        $mensaje = "Mano de Obra Actualizado(s) Correctamente";
                    } 
                }
            }
            return redirect()->route('manoobra.inicio')->with('mensajemanoobra',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            if($error == "Trying to access array offset on value of type null"){
                $error = "Todos los campos deben ser mostrados, pasa el raton sobre las familias para obtener el modelo";
            }
            return redirect()->route('manoobra.inicio')->with('errorUserHandWork',$error);
        } 
    }
}
