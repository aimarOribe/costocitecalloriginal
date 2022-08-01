<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Models\Familia;
use Exception;
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
            foreach ($request->id as $ids) {
                if($request->nombre[$ids] == "" & $request->capprosemdocenas[$ids] == "" & $request->capprodmensual[$ids] == ""){
                    $familia = Familia::find($ids);
                    $familia->delete();
                    $mensaje = "Familia Eliminada Correctamente";
                }elseif($request->nombre[$ids] == ""){
                    throw new Exception("Debes ingresar un texto en el campo Nombre");
                }else{
                    $nombre = $request->nombre[$ids];
                    $capprosemdocenas = $request->capprosemdocenas[$ids];
                    $capprodmensual = $request->capprodmensual[$ids];
                    DB::table('familias')
                        ->where('id',$ids)
                        ->update(['nombre'=>$nombre,'capprosemdocenas'=>$capprosemdocenas,'capprodmensual'=>$capprodmensual]);
                    $mensaje = "Familia Actualizada Correctamente";
                }   
            }
            return redirect()->route('familias.inicio')->with('mensajefamilia',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('familias.inicio')->with('errorUser',$error);
        }
    }
}
