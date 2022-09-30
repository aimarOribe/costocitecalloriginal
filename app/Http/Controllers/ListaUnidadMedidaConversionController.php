<?php

namespace App\Http\Controllers;

use App\Models\Fmatematerial;
use App\Models\Listaunidaddemedida;
use App\Models\Listaunidadmedidaconversion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListaUnidadMedidaConversionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
        $unidadesmedidaconversiones = Listaunidadmedidaconversion::all();
        $fmmateriales = Fmatematerial::all();
        $unidadesmedidas = Listaunidaddemedida::all();
        return view('services.unitmeasureconversion',compact('unidadesmedidaconversiones','fmmateriales','unidadesmedidas'));
    }

    

    public function obtenerunidadesmedidaconversion(){
        $unidadesmedidaconversiones = Listaunidadmedidaconversion::all();
        $fmmateriales = Fmatematerial::all();
        $unidadesmedidas = Listaunidaddemedida::all();
        return response()->json(
            [
                'unidadesmedidaconversiones' => $unidadesmedidaconversiones,
                'fmmateriales' => $fmmateriales,
                'unidadesmedidas' => $unidadesmedidas
            ]
        );
    }

    public function registrarunidadesmedidaconversion(Request $request){
        try {
            $mensaje = "";
            $material_id = $request->material_id;
            $unidadesmedidas_id = $request->unidadesmedidas_id;
            $conversion = $request->conversion;
            
            if($material_id == ""){
                throw new Exception("Debes ingresar un material");
            }

            if($unidadesmedidas_id == ""){
                throw new Exception("Debes ingresar una unidad de medida");
            }

            if($conversion == ""){
                throw new Exception("Debes ingresar una conversion en numeros o decimales");
            }

            if(floatval($conversion)){
                $conversion = floatval($conversion);
            }else{
                $conversion = 0.0;
            }

            $listaunidadconversion = new Listaunidadmedidaconversion();
            $listaunidadconversion->listaunidadmedida_id = $unidadesmedidas_id;
            $listaunidadconversion->material_id = $material_id;
            $listaunidadconversion->conversion = $conversion;
            $listaunidadconversion->save();
            $mensaje = "Unidad de Conversion Registrado Correctamente";

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

    public function actualizarunidadesmedidaconversion(Request $request){
        try {
            $mensaje = "";
            if(!$request->hasAny(['material_id','unidadesmedidas_id','conversion'])){
                $mensaje = "No se encontro registros a guardar";
            }else{
                foreach ($request->id as $ids) {
                    if ($request->material_id[$ids] == "" & $request->unidadesmedidas_id[$ids] == "" & $request->conversion[$ids] == ""){
                        $listaunidadconversion = Listaunidadmedidaconversion::find($ids);
                        $listaunidadconversion->delete();
                        $mensaje = "Unidad(es) de Conversion Eliminada Correctamente";
                    } else {
                        $material_id = $request->material_id[$ids];
                        $unidadesmedidas_id = $request->unidadesmedidas_id[$ids];
                        $conversion = $request->conversion[$ids];

                        if($material_id == ""){
                            throw new Exception("No puedes borrar el material");
                        }
                        
                        if($unidadesmedidas_id == ""){
                            throw new Exception("No puedes borrar la unidad de medida");
                        }

                        if($conversion == ""){
                            throw new Exception("No puedes borrar la conversion");
                        }
                        
                        if(floatval($conversion)){
                            $conversion = floatval($conversion);
                        }else{
                            $conversion = 0.0;
                        }

                        DB::table('listaunidadmedidaconversions')
                            ->where('id',$ids)
                            ->update(['listaunidadmedida_id'=>$unidadesmedidas_id,'material_id'=>$material_id,'conversion'=>$conversion]);
                        $mensaje = "Unidad(es) de Conversion Actualizado Correctamente";
                    }
                }
            }
            return response()->json(
                [
                    'success' => true,
                    'mensaje' => $mensaje
                ]
            );
        }catch (\Exception $e) {
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
