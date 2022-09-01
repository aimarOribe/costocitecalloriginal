<?php

namespace App\Http\Controllers;

use App\Models\Fmatematerial;
use App\Models\Listafamiliademateriales;
use App\Models\Listaunidaddemedida;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamiliaMateMaterialesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
        $familiasmateriales = Listafamiliademateriales::all();
        $unidadesmedidas = Listaunidaddemedida::all();
        return view('services.materialfamilymaterials',compact('familiasmateriales','unidadesmedidas'));
    }

    public function obtenerfamiliamaterialesmateriales(){
        $fmmateriales = Fmatematerial::all();
        $familiasmateriales = Listafamiliademateriales::all();
        $unidadesmedidas = Listaunidaddemedida::all();
        return response()->json(
            [
                'fmmateriales' => $fmmateriales,
                'familiasmateriales' => $familiasmateriales,
                'unidadesmedidas' => $unidadesmedidas
            ]
        );
    }

    public function registrarfamiliamaterialesmateriales(Request $request){
        try {
            $mensaje = "";
            $familiamateriales_id = $request->familiamateriales_id;
            $nombre = $request->nombre;
            $unidadesmedidas_id = $request->unidadesmedidas_id;
            $presentacion = $request->presentacion;

            if($familiamateriales_id == ""){
                throw new Exception("Debes ingresar una familia de materiales");
            }
            if($nombre == ""){
                throw new Exception("Debes ingresar un nombre");
            }
            if($unidadesmedidas_id == ""){
                throw new Exception("Debes ingresar una unidad de medida");
            }
            if($presentacion == ""){
                throw new Exception("Debes ingresar una presentacion");
            }

            $fmmateriales = new Fmatematerial();
            $fmmateriales->familiamateriales_id = $familiamateriales_id;
            $fmmateriales->nombre = $nombre;
            $fmmateriales->listaunidadmedida_id = $unidadesmedidas_id;
            $fmmateriales->presentacion = $presentacion;
            $fmmateriales->stock = 0;
            $fmmateriales->costopromedio = 0.00;
            $fmmateriales->costoreal = 0.00;
            $fmmateriales->save();
            $mensaje = "Material Registrado Correctamente";

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

    public function actualizarfamiliamaterialesmateriales(Request $request){
        try {
            $mensaje = "";
            if(!$request->hasAny(['familiamateriales_id','nombre','unidadesmedidas_id','presentacion'])){
                $mensaje = "No se encontro registros a guardar";
            }else{
                foreach ($request->id as $ids) {
                    if ($request->familiamateriales_id[$ids] == "" & $request->nombre[$ids] == "" & $request->unidadesmedidas_id[$ids] == "" & $request->presentacion[$ids] == ""){
                        $fmmateriales = Fmatematerial::find($ids);
                        $fmmateriales->delete();
                        $mensaje = "Material Eliminado Correctamente";
                    } else {
                        $familiamateriales_id = $request->familiamateriales_id[$ids];
                        $nombre = $request->nombre[$ids];
                        $unidadesmedidas_id = $request->unidadesmedidas_id[$ids];
                        $presentacion = $request->presentacion[$ids];

                        if($familiamateriales_id == ""){
                            throw new Exception("No puedes borrar la familia de materiales");
                        }
                        if($nombre == ""){
                            throw new Exception("No puedes borrar el nombre al material");
                        }
                        if($unidadesmedidas_id == ""){
                            throw new Exception("No puedes borrar la unidad de medida");
                        }
                        if($presentacion == ""){
                            throw new Exception("No puedes borrar la presentacion");
                        }
                        DB::table('fmatematerials')
                            ->where('id',$ids)
                            ->update(['familiamateriales_id'=>$familiamateriales_id,'nombre'=>$nombre,'listaunidadmedida_id'=>$unidadesmedidas_id,'presentacion'=>$presentacion]);
                        $mensaje = "Material Actualizado Correctamente";
                    }
                }
            }
            return response()->json(
                [
                    'success' => true,
                    'mensaje' => $mensaje
                ]
            );
        } catch (\Illuminate\Database\QueryException $e) {
            $error = "No se puede eliminar este registro debido a que lo estas utilizando en tus demas procesos";
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
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
