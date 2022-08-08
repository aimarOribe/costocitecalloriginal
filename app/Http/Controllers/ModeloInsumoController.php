<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use App\Models\Insumofamilia;
use App\Models\Listafamiliademateriales;
use App\Models\Listaunidaddemedida;
use App\Models\Modelofamilia;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModeloInsumoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
        $modelofamilias = Modelofamilia::all();
        $insumofamilias = Insumofamilia::all();
        $familias = Familia::all();
        $unidaddemendidas = Listaunidaddemedida::all();
        $familiasMateriales = Listafamiliademateriales::all();
        return view('services.modelsupplies',compact('familias','modelofamilias','insumofamilias','unidaddemendidas','familiasMateriales'));
    }

    public function registrarmodeloseinsumosmodelos(Request $request){
        try {
            $mensaje = "";
            $familia_ids = $request->familia_id;
            $modelos = $request->modelo;
            while(true){
                $familia_id = current($familia_ids);
                $modelo = current($modelos);

                if($familia_id == "--"){
                    throw new Exception("Debes ingresar una familia");
                }

                $modelofamilia = new Modelofamilia();
                $modelofamilia->familia_id = $familia_id;
                $modelofamilia->modelo = $modelo;
                $modelofamilia->save();
                $mensaje = "Modelo(s) Registrados Correctamente";

                $familia_id = next($familia_ids);
                $modelo = next($modelos);

                if($familia_id === false && $modelo === false) break;
            }
            return redirect()->route('modeloseinsumos.inicio')->with('mensajemodelos',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('modeloseinsumos.inicio')->with('errorUserModelos',$error);
        } 
    }

    public function actualizarmodeloseinsumosmodelos(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->familia_id[$ids] == "--" & $request->modelo[$ids] == ""){
                    $modeloFamilia = Modelofamilia::find($ids);
                    $modeloFamilia->delete();
                    $mensaje = "Modelo Eliminado Correctamente";
                } else {
                    $familia_id = $request->familia_id[$ids];
                    $modelo = $request->modelo[$ids];
                    DB::table('modelofamilias')
                        ->where('id',$ids)
                        ->update(['familia_id'=>$familia_id,'modelo'=>$modelo]);
                    $mensaje = "Modelo Actualizado Correctamente";
                }
            }
            return redirect()->route('modeloseinsumos.inicio')->with('mensajemodelos',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('modeloseinsumos.inicio')->with('errorUserModelos','Debe elegir una familia o ingresar un modelo, si quiere borrar el registro vacie los dos campos');
        }
    }

    public function registrarmodeloseinsumosinsumos(Request $request){
        try {
            $mensaje = "";
            $familia_ids = $request->familia_id;
            $listafamiliamateriales_ids = $request->listafamiliamateriales_id;
            while(true){
                $familia_id = current($familia_ids);
                $listafamiliamateriales_id = current($listafamiliamateriales_ids);

                if($familia_id == "--"){
                    throw new Exception("Debes ingresar una familia");
                }

                if($listafamiliamateriales_id == "--"){
                    throw new Exception("Debes ingresar una familia de materiales");
                }

                $insumofamilia = new Insumofamilia();
                $insumofamilia->familia_id = $familia_id;
                $insumofamilia->listafamiliamateriales_id = $listafamiliamateriales_id;
                $insumofamilia->save();
                $mensaje = "Insumo(s) Registrados Correctamente";

                $familia_id = next($familia_ids);
                $listafamiliamateriales_id = next($listafamiliamateriales_ids);

                if($familia_id === false && $listafamiliamateriales_id === false) break;
            }
            return redirect()->route('modeloseinsumos.inicio')->with('mensajeinsumos',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('modeloseinsumos.inicio')->with('errorUserInsumos',$error);
        }  
    }

    public function actualizarmodeloseinsumosinsumos(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->familia_id[$ids] == "" & $request->listafamiliamateriales_id[$ids] == ""){
                    $insumoFamilia = Insumofamilia::find($ids);
                    $insumoFamilia->delete();
                    $mensaje = "Insumo Eliminado Correctamente";
                } else{
                    $familia_id = $request->familia_id[$ids];
                    $listafamiliamateriales_id = $request->listafamiliamateriales_id[$ids];

                    if($familia_id == "" && $listafamiliamateriales_id == ""){
                        throw new Exception("No puedes vaciar el campo de familia Y familia de materiales");
                    }

                    if($familia_id == ""){
                        throw new Exception("No puedes vaciar el campo de familia");
                    }

                    if($listafamiliamateriales_id == ""){
                        throw new Exception("No puedes vaciar el campo de familia de materiales");
                    }

                    DB::table('insumofamilias')
                        ->where('id',$ids)
                        ->update(['familia_id'=>$familia_id,'listafamiliamateriales_id'=>$listafamiliamateriales_id]);
                    $mensaje = "Insumo Actualizado Correctamente";
                }
            }
            return redirect()->route('modeloseinsumos.inicio')->with('mensajeinsumos',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('modeloseinsumos.inicio')->with('errorUserInsumos',$error);
        }   
    }
}
