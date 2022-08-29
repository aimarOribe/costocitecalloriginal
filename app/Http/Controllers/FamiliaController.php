<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamiliaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
        $familias = Familia::all();
        return view('services.family',compact('familias'));
    }

    public function registrar(Request $request){

        try {
            $mensaje = "";
            $nombre = $request->nombre;
            $capprosemdocenas = $request->capprosemdocenas;
            $capprodmensual = $request->capprodmensual;

            $familia = new Familia();
            $familia->nombre = $nombre;
            $familia->capprosemdocenas = $capprosemdocenas;
            $familia->capprodmensual = $capprodmensual;
            $familia->save();

            $mensaje = "Familia Guardada Correctamente";

            return redirect()->route('familias.inicio')->with('mensajefamilia',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('familias.inicio')->with('errorUser',$error);
        }
    }

    public function actualizar(Request $request){
        try {
            $mensaje = "";
            if(!$request->hasAny(['nombre','capprosemdocenas','capprodmensual'])){
                $mensaje = "No se encontro registros a guardar";
            }else{
                foreach ($request->id as $ids) {
                    if($request->nombre[$ids] == "" & $request->capprosemdocenas[$ids] == "" & $request->capprodmensual[$ids] == ""){
                        $familia = Familia::find($ids);
                        $familia->delete();
                        $mensaje = "Familia Eliminada Correctamente";
                    }else{
                        $nombre = $request->nombre[$ids];
                        $capprosemdocenas = $request->capprosemdocenas[$ids];
                        $capprodmensual = $request->capprodmensual[$ids];

                        if($nombre == ""){
                            throw new Exception("No puedes borrar el nombre");
                        }

                        DB::table('familias')
                            ->where('id',$ids)
                            ->update(['nombre'=>$nombre,'capprosemdocenas'=>$capprosemdocenas,'capprodmensual'=>$capprodmensual]);
                        $mensaje = "Familia(s) Actualizada(s) Correctamente";
                    }   
                }
            }
            return redirect()->route('familias.inicio')->with('mensajefamilia',$mensaje);
        }catch (\Illuminate\Database\QueryException $e) {
            $error = "No se puede eliminar este registro debido a que lo estas utilizando en tus demas procesos";
            return redirect()->route('familias.inicio')->with('errorUser',$error);
        }catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('familias.inicio')->with('errorUser',$error);
        } 
    }
}
