<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use App\Models\Insumofamilia;
use App\Models\Listaunidaddemedida;
use App\Models\Modelofamilia;
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
        return view('services.modelsupplies',compact('familias','modelofamilias','insumofamilias','unidaddemendidas'));
    }

    public function registrarmodeloseinsumosmodelos(Request $request){
        $familia_ids = $request->familia_id;
        $modelos = $request->modelo;
        while(true){
            $familia_id = current($familia_ids);
            $modelo = current($modelos);

            $modelofamilia = new Modelofamilia();
            $modelofamilia->familia_id = $familia_id;
            $modelofamilia->modelo = $modelo;
            $modelofamilia->save();

            $familia_id = next($familia_ids);
            $modelo = next($modelos);

            if($familia_id === false && $modelo === false) break;
        }
        return redirect()->route('modeloseinsumos.inicio');
    }

    public function actualizarmodeloseinsumosmodelos(Request $request){
        foreach ($request->id as $ids) {
            if($request->familia_id[$ids] == "" & $request->modelo[$ids] == ""){
                $modeloFamilia = Modelofamilia::find($ids);
                $modeloFamilia->delete();
            }else{
                $familia_id = $request->familia_id[$ids];
                $modelo = $request->modelo[$ids];
                DB::table('modelofamilias')
                    ->where('id',$ids)
                    ->update(['familia_id'=>$familia_id,'modelo'=>$modelo]);
            }
        }
        return redirect()->route('modeloseinsumos.inicio');
    }

    public function registrarmodeloseinsumosinsumos(Request $request){
        $familia_ids = $request->familia_id;
        $insumos = $request->insumo;
        $listaunidadmedida_ids = $request->listaunidadmedida_id;
        while(true){
            $familia_id = current($familia_ids);
            $insumo = current($insumos);
            $listaunidadmedida_id = current($listaunidadmedida_ids);

            $insumofamilia = new Insumofamilia();
            $insumofamilia->familia_id = $familia_id;
            $insumofamilia->insumo = $insumo;
            $insumofamilia->listaunidadmedida_id = $listaunidadmedida_id;
            $insumofamilia->save();

            $familia_id = next($familia_ids);
            $insumo = next($insumos);
            $listaunidadmedida_id = next($listaunidadmedida_ids);

            if($familia_id === false && $insumo === false && $listaunidadmedida_id === false) break;
        }
        return redirect()->route('modeloseinsumos.inicio');
    }

    public function actualizarmodeloseinsumosinsumos(Request $request){
        foreach ($request->id as $ids) {
            if($request->familia_id[$ids] == "" & $request->insumo[$ids] == "" & $request->listaunidadmedida_id[$ids] == ""){
                $insumoFamilia = Insumofamilia::find($ids);
                $insumoFamilia->delete();
            }else{
                $familia_id = $request->familia_id[$ids];
                $insumo = $request->insumo[$ids];
                $listaunidadmedida_id = $request->listaunidadmedida_id[$ids];
                DB::table('insumofamilias')
                    ->where('id',$ids)
                    ->update(['familia_id'=>$familia_id,'insumo'=>$insumo,'listaunidadmedida_id'=>$listaunidadmedida_id]);
            }
        }
        return redirect()->route('modeloseinsumos.inicio');
    }
}
