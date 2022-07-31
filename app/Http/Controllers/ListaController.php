<?php

namespace App\Http\Controllers;

use App\Models\Clasificacion;
use App\Models\Listafamiliademateriales;
use App\Models\Listaproceso;
use App\Models\Listaunidaddeconsumo;
use App\Models\Listaunidaddemedida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
        $listaUnidadDeMedidas = Listaunidaddemedida::all();
        $listaProcesos = Listaproceso::all();
        $listaClasificacions = Clasificacion::all();
        $listaUnidadConsumos = Listaunidaddeconsumo::all();
        $listaFamiliasMateriales = Listafamiliademateriales::all();
        return view('services.lists',compact('listaUnidadDeMedidas','listaProcesos','listaClasificacions','listaUnidadConsumos','listaFamiliasMateriales'));
    }

    public function registrarlistaUnidadMedidas(Request $request){
        $nombres = $request->nombre;
        while(true){
            $nombre = current($nombres);

            $listaUnidadDeMedida = new Listaunidaddemedida();
            $listaUnidadDeMedida->nombre = $nombre;
            $listaUnidadDeMedida->save();

            $nombre = next($nombres);

            if($nombre === false) break;
        }
        return redirect()->route('listas.inicio');
    }

    public function actualizarlistaUnidadMedidas(Request $request){
        foreach ($request->id as $ids) {
            if($request->nombre[$ids] == ""){
                $listaUnidadDeMedida = Listaunidaddemedida::find($ids);
                $listaUnidadDeMedida->delete();
            }else{
                $nombre = $request->nombre[$ids];
                DB::table('listaunidaddemedidas')
                    ->where('id',$ids)
                    ->update(['nombre'=>$nombre]);
            }
        }
        return redirect()->route('listas.inicio');
    }

    public function registrarlistaProcesos(Request $request){
        $nombres = $request->nombre;
        while(true){
            $nombre = current($nombres);

            $listaProceso = new Listaproceso();
            $listaProceso->nombre = $nombre;
            $listaProceso->save();

            $nombre = next($nombres);

            if($nombre === false) break;
        }
        return redirect()->route('listas.inicio');
    }

    public function actualizarlistaProcesos(Request $request){
        foreach ($request->id as $ids) {
            if($request->nombre[$ids] == ""){
                $listaProceso = Listaproceso::find($ids);
                $listaProceso->delete();
            }else{
                $nombre = $request->nombre[$ids];
                DB::table('listaprocesos')
                    ->where('id',$ids)
                    ->update(['nombre'=>$nombre]);
            }
        }
        return redirect()->route('listas.inicio');
    }

    public function registrarclasificacions(Request $request){
        $nombres = $request->nombre;
        while(true){
            $nombre = current($nombres);

            $listaClasificacion = new Clasificacion();
            $listaClasificacion->nombre = $nombre;
            $listaClasificacion->save();

            $nombre = next($nombres);

            if($nombre === false) break;
        }
        return redirect()->route('listas.inicio');
    }

    public function actualizarclasificacions(Request $request){
        foreach ($request->id as $ids) {
            if($request->nombre[$ids] == ""){
                $listaClasificacion = Clasificacion::find($ids);
                $listaClasificacion->delete();
            }else{
                $nombre = $request->nombre[$ids];
                DB::table('clasificacions')
                    ->where('id',$ids)
                    ->update(['nombre'=>$nombre]);
            }
        }
        return redirect()->route('listas.inicio');
    }

    public function registrarlistaUnidadConsumo(Request $request){
        $nombres = $request->nombre;
        while(true){
            $nombre = current($nombres);

            $listaUnidadConsumo = new Listaunidaddeconsumo();
            $listaUnidadConsumo->nombre = $nombre;
            $listaUnidadConsumo->save();

            $nombre = next($nombres);

            if($nombre === false) break;
        }
        return redirect()->route('listas.inicio');
    }

    public function actualizarlistaUnidadConsumo(Request $request){
        foreach ($request->id as $ids) {
            if($request->nombre[$ids] == ""){
                $listaUnidadConsumo = Listaunidaddeconsumo::find($ids);
                $listaUnidadConsumo->delete();
            }else{
                $nombre = $request->nombre[$ids];
                DB::table('listaunidaddeconsumos')
                    ->where('id',$ids)
                    ->update(['nombre'=>$nombre]);
            }
        }
        return redirect()->route('listas.inicio');
    }

    public function registrarlistaFamiliasMateriales(Request $request){
        $nombres = $request->nombre;
        while(true){
            $nombre = current($nombres);

            $listaFamiliasMateriales = new Listafamiliademateriales();
            $listaFamiliasMateriales->nombre = $nombre;
            $listaFamiliasMateriales->save();

            $nombre = next($nombres);

            if($nombre === false) break;
        }
        return redirect()->route('listas.inicio');
    }

    public function actualizarlistaFamiliasMateriales(Request $request){
        foreach ($request->id as $ids) {
            if($request->nombre[$ids] == ""){
                $listaFamiliasMateriales = Listafamiliademateriales::find($ids);
                $listaFamiliasMateriales->delete();
            }else{
                $nombre = $request->nombre[$ids];
                DB::table('listafamiliademateriales')
                    ->where('id',$ids)
                    ->update(['nombre'=>$nombre]);
            }
        }
        return redirect()->route('listas.inicio');
    }
}
