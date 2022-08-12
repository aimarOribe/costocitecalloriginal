<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Models\Familia;
use Error;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

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
            $nombres = $request->nombre;
            $capprosemdocenass = $request->capprosemdocenas;
            $capprodmensuals = $request->capprodmensual;
            while(true){
                $nombre = current($nombres);
                $capprosemdocenas = current($capprosemdocenass);
                $capprodmensual = current($capprodmensuals);

                $familia = new Familia();
                $familia->nombre = $nombre;
                $familia->capprosemdocenas = $capprosemdocenas;
                $familia->capprodmensual = $capprodmensual;
                $familia->save();

                $mensaje = "Familia Guardada Correctamente";

                $nombre = next($nombres);
                $capprosemdocenas = next($capprosemdocenass);
                $capprodmensual = next($capprodmensuals);

                if($nombre === false && $capprosemdocenas === false && $capprodmensual === false) break;
            }
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
                        $familiaEliminada = $familia->delete();
                        if($familiaEliminada == 1){
                            $mensaje = "Familia Eliminada Correctamente";
                        }
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
