<?php

namespace App\Http\Controllers;

use App\Models\Familia;
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

            $nombre = next($nombres);
            $capprosemdocenas = next($capprosemdocenass);
            $capprodmensual = next($capprodmensuals);

            if($nombre === false && $capprosemdocenas === false && $capprodmensual === false) break;
        }
        return redirect()->route('familias.inicio');
    }

    public function actualizar(Request $request){
        foreach ($request->id as $ids) {
            if($request->nombre[$ids] == "" & $request->capprosemdocenas[$ids] == "" & $request->capprodmensual[$ids] == ""){
                $familia = Familia::find($ids);
                $familia->delete();
            }else{
                $nombre = $request->nombre[$ids];
                $capprosemdocenas = $request->capprosemdocenas[$ids];
                $capprodmensual = $request->capprodmensual[$ids];
                DB::table('familias')
                    ->where('id',$ids)
                    ->update(['nombre'=>$nombre,'capprosemdocenas'=>$capprosemdocenas,'capprodmensual'=>$capprodmensual]);
            }
        }
        return redirect()->route('familias.inicio');
    }
}
