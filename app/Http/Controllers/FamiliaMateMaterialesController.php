<?php

namespace App\Http\Controllers;

use App\Models\Familia;
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
            while(true){
                $familiamateriales_id = current($familiamateriales_ids);
                $nombre = current($nombres);
                $unidadesmedidas_id = current($unidadesmedidas_ids);

                if($familiamateriales_id == "--"){
                    throw new Exception("Debes ingresar una familia de materiales");
                }

                if($nombre == "--"){
                    throw new Exception("Debes ingresar un nombre");
                }

                if($unidadesmedidas_id == "--"){
                    throw new Exception("Debes ingresar una unidad de medida");
                }

                $fmmateriales = new Fmatematerial();
                $fmmateriales->familiamateriales_id = $familiamateriales_id;
                $fmmateriales->nombre = $nombre;
                $fmmateriales->listaunidadmedida_id = $unidadesmedidas_id;
                $fmmateriales->save();
                $mensaje = "Material(es) Registrados Correctamente";

                $familiamateriales_id = next($familiamateriales_ids);
                $nombre = next($nombres);
                $unidadesmedidas_id = next($unidadesmedidas_ids);

                if($familiamateriales_id === false && $nombre === false && $unidadesmedidas_id === false) break;
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
            foreach ($request->id as $ids) {
                if($request->familiamateriales_id[$ids] == "--"){
                    throw new Exception("Debes ingresar un familia de materiales");
                }
                if($request->nombre[$ids] == ""){
                    throw new Exception("Debes ingresar un nombre al material");
                }
                if($request->unidadesmedidas_id[$ids] == "--"){
                    throw new Exception("Debes ingresar una unidad de medida");
                }
                if ($request->familiamateriales_id[$ids] == "--" & $request->nombre[$ids] == "" & $request->unidadesmedidas_id[$ids] == "--"){
                    $fmmateriales = Fmatematerial::find($ids);
                    $fmmateriales->delete();
                    $mensaje = "Material Eliminado Correctamente";
                } else {
                    $familiamateriales_id = $request->familiamateriales_id[$ids];
                    $nombre = $request->nombre[$ids];
                    $unidadesmedidas_id = $request->unidadesmedidas_id[$ids];
                    DB::table('fmatematerials')
                        ->where('id',$ids)
                        ->update(['familiamateriales_id'=>$familiamateriales_id,'nombre'=>$nombre,'listaunidadmedida_id'=>$unidadesmedidas_id]);
                    $mensaje = "Material Actualizado Correctamente";
                }
            }
            return redirect()->route('familiamaterialesmateriales.inicio')->with('mensajemateriales',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('familiamaterialesmateriales.inicio')->with('errorUserMateriales',$error);
        }
    }
}
