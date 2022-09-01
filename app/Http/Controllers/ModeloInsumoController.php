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
        $familias = Familia::all();
        $familiasMateriales = Listafamiliademateriales::all();
        return view('services.modelsupplies',compact('familias','familiasMateriales'));
    }

    public function obtenerModelosInsumosModelos(){
        $modelofamilias = Modelofamilia::all();
        $familias = Familia::all();
        return response()->json(
            [
                'modeloinsumomodelo' => $modelofamilias,
                'familias' => $familias
            ]
        );
    }

    public function registrarmodeloseinsumosmodelos(Request $request){
        try {
            $mensaje = "";
            $familia_id = $request->familia_id;
            $modelo = $request->modelo;

            if($familia_id == ""){
                throw new Exception("El campo familia no puede estar vacio");
            }

            if($modelo == ""){
                throw new Exception("El campo modelo no puede estar vacio");
            }

            $modelofamilia = new Modelofamilia();
            $modelofamilia->familia_id = $familia_id;
            $modelofamilia->modelo = $modelo;
            $modelofamilia->save();
            $mensaje = "Modelo(s) Registrados Correctamente";

            //return redirect()->route('modeloseinsumos.inicio')->with('mensajemodelos',$mensaje);
            return response()->json(
                [
                    'success' => true,
                    'mensaje' => $mensaje
                ]
            );
        } catch (\Exception $e) {
            $error = $e->getMessage();
            //return redirect()->route('modeloseinsumos.inicio')->with('errorUserModelos',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        } 
    }

    public function actualizarmodeloseinsumosmodelos(Request $request){
        try {
            $mensaje = "";
            if(!$request->hasAny(['familia_id','modelo'])){
                $mensaje = "No se encontro registros a guardar";
            }else{
                foreach ($request->id as $ids) {
                    if ($request->familia_id[$ids] == "" & $request->modelo[$ids] == ""){
                        $modeloFamilia = Modelofamilia::find($ids);
                        $modeloFamilia->delete();
                        $mensaje = "Modelo(s) Eliminado(s) Correctamente";
                    } else {
                        $familia_id = $request->familia_id[$ids];
                        $modelo = $request->modelo[$ids];

                        if($familia_id == ""){
                            throw new Exception("No puedes borrar la familia");
                        }

                        if($modelo == ""){
                            throw new Exception("No puedes borrar el modelo");
                        }

                        DB::table('modelofamilias')
                            ->where('id',$ids)
                            ->update(['familia_id'=>$familia_id,'modelo'=>$modelo]);
                        $mensaje = "Modelo(s) Actualizado(s) Correctamente";
                    }
                }
            }
            //return redirect()->route('modeloseinsumos.inicio')->with('mensajemodelos',$mensaje);
            return response()->json(
                [
                    'success' => true,
                    'mensaje' => $mensaje
                ]
            );
        }catch (\Illuminate\Database\QueryException $e) {
            $error = "No se puede eliminar este registro debido a que lo estas utilizando en tus demas procesos";
            //return redirect()->route('modeloseinsumos.inicio')->with('errorUserModelos',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        }catch (\Exception $e) {
            $error = $e->getMessage();
            //return redirect()->route('modeloseinsumos.inicio')->with('errorUserModelos',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        }
    }

    public function obtenerModelosInsumosInsumos(){
        $insumofamilias = Insumofamilia::all();
        $familias = Familia::all();
        $familiasMateriales = Listafamiliademateriales::all();
        return response()->json(
            [
                'insumofamilias' => $insumofamilias,
                'familias' => $familias,
                'familiasMateriales' => $familiasMateriales
            ]
        );
    }

    public function registrarmodeloseinsumosinsumos(Request $request){
        try {
            $mensaje = "";
            $familia_id = $request->familia_id;
            $listafamiliamateriales_id = $request->listafamiliamateriales_id;

            if($familia_id == ""){
                throw new Exception("El campo familia no puede estar vacio");
            }

            if($listafamiliamateriales_id == ""){
                throw new Exception("El campo familia de materiales no puede estar vacio");
            }

            $insumofamilia = new Insumofamilia();
            $insumofamilia->familia_id = $familia_id;
            $insumofamilia->listafamiliamateriales_id = $listafamiliamateriales_id;
            $insumofamilia->save();
            $mensaje = "Insumo(s) Registrados Correctamente";

            //return redirect()->route('modeloseinsumos.inicio')->with('mensajeinsumos',$mensaje);
            return response()->json(
                [
                    'success' => true,
                    'mensaje' => $mensaje
                ]
            );
        } catch (\Exception $e) {
            $error = $e->getMessage();
            //return redirect()->route('modeloseinsumos.inicio')->with('errorUserInsumos',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        }  
    }

    public function actualizarmodeloseinsumosinsumos(Request $request){
        try {
            $mensaje = "";
            if(!$request->hasAny(['familia_id','listafamiliamateriales_id',])){
                $mensaje = "No se encontro registros a guardar";
            }else{
                foreach ($request->id as $ids) {
                    if ($request->familia_id[$ids] == "" & $request->listafamiliamateriales_id[$ids] == ""){
                        $insumoFamilia = Insumofamilia::find($ids);
                        $insumoFamilia->delete();
                        $mensaje = "Insumo(s) Eliminado(s) Correctamente";
                    } else{
                        $familia_id = $request->familia_id[$ids];
                        $listafamiliamateriales_id = $request->listafamiliamateriales_id[$ids];

                        if($familia_id == ""){
                            throw new Exception("No puedes vaciar el campo de familia");
                        }

                        if($listafamiliamateriales_id == ""){
                            throw new Exception("No puedes vaciar el campo de familia de materiales");
                        }

                        DB::table('insumofamilias')
                            ->where('id',$ids)
                            ->update(['familia_id'=>$familia_id,'listafamiliamateriales_id'=>$listafamiliamateriales_id]);
                        $mensaje = "Insumo(s) Actualizado(s) Correctamente";
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
