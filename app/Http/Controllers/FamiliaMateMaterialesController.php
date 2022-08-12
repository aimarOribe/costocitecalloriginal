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
        $fmmateriales = Fmatematerial::all();
        $familiasmateriales = Listafamiliademateriales::all();
        $unidadesmedidas = Listaunidaddemedida::all();
        return view('services.materialfamilymaterials',compact('fmmateriales','familiasmateriales','unidadesmedidas'));
    }

    public function registrarfamiliamaterialesmateriales(Request $request){
        try {
            $mensaje = "";
            $familiamateriales_ids = $request->familiamateriales_id;
            $nombres = $request->nombre;
            $unidadesmedidas_ids = $request->unidadesmedidas_id;
            $presentaciones = $request->presentacion;
            while(true){
                $familiamateriales_id = current($familiamateriales_ids);
                $nombre = current($nombres);
                $unidadesmedidas_id = current($unidadesmedidas_ids);
                $presentacion = current($presentaciones);

                $fmmateriales = new Fmatematerial();
                $fmmateriales->familiamateriales_id = $familiamateriales_id;
                $fmmateriales->nombre = $nombre;
                $fmmateriales->listaunidadmedida_id = $unidadesmedidas_id;
                $fmmateriales->presentacion = $presentacion;
                $fmmateriales->stock = 0;
                $fmmateriales->costopromedio = 0.00;
                $fmmateriales->costoreal = 0.00;
                $fmmateriales->save();
                $mensaje = "Material(es) Registrado(s) Correctamente";

                $familiamateriales_id = next($familiamateriales_ids);
                $nombre = next($nombres);
                $unidadesmedidas_id = next($unidadesmedidas_ids);
                $presentacion = next($presentaciones);

                if($familiamateriales_id === false && $nombre === false && $unidadesmedidas_id === false && $presentacion === false) break;
            }
            return redirect()->route('familiamaterialesmateriales.inicio')->with('mensajemateriales',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('familiamaterialesmateriales.inicio')->with('errorUserMateriales',$error);
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
            return redirect()->route('familiamaterialesmateriales.inicio')->with('mensajemateriales',$mensaje);
        } catch (\Illuminate\Database\QueryException $e) {
            $error = "No se puede eliminar este registro debido a que lo estas utilizando en tus demas procesos";
            return redirect()->route('familiamaterialesmateriales.inicio')->with('errorUserMateriales',$error);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('familiamaterialesmateriales.inicio')->with('errorUserMateriales',$error);
        }
    }
}
