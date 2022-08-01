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
        try {
            $mensaje = "";
            $nombres = $request->nombre;
            while(true){
                $nombre = current($nombres);
                $listaUnidadDeMedida = new Listaunidaddemedida();
                $listaUnidadDeMedida->nombre = $nombre;
                $listaUnidadDeMedida->save();
                $nombre = next($nombres);
                if($nombre === false) break;
            }
            $mensaje = "Unidad de Medida Agregada Correctamente";
            return redirect()->route('listas.inicio')->with('mensajeunidadmedida',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('listas.inicio')->with('errorServidorUnidadesMedidas',$error);
        }
    }

    public function actualizarlistaUnidadMedidas(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if($request->nombre[$ids] == ""){
                    $listaUnidadDeMedida = Listaunidaddemedida::find($ids);
                    $listaUnidadDeMedida->delete();
                    $mensaje = "Unidad de Medida Eliminada Correctamente";
                }else{
                    $nombre = $request->nombre[$ids];
                    DB::table('listaunidaddemedidas')
                        ->where('id',$ids)
                        ->update(['nombre'=>$nombre]);
                    $mensaje = "Unidad de Medida Actualizada Correctamente";
                }
            }
            return redirect()->route('listas.inicio')->with('mensajeunidadmedida',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('listas.inicio')->with('errorServidorUnidadesMedidas',$error);
        } 
    }

    public function registrarlistaProcesos(Request $request){
        try {
            $mensaje = "";
            $nombres = $request->nombre;
            while(true){
                $nombre = current($nombres);

                $listaProceso = new Listaproceso();
                $listaProceso->nombre = $nombre;
                $listaProceso->save();

                $nombre = next($nombres);

                if($nombre === false) break;
            }
            $mensaje = "Proceso Agregado Correctamente";
            return redirect()->route('listas.inicio')->with('mensajeprocesos',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('listas.inicio')->with('errorServidorlistaprocesos',$error);
        }
    }

    public function actualizarlistaProcesos(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if($request->nombre[$ids] == ""){
                    $listaProceso = Listaproceso::find($ids);
                    $listaProceso->delete();
                    $mensaje = "Proceso Eliminado Correctamente";
                }else{
                    $nombre = $request->nombre[$ids];
                    DB::table('listaprocesos')
                        ->where('id',$ids)
                        ->update(['nombre'=>$nombre]);
                    $mensaje = "Proceso Actializado Correctamente";
                }
            }
            return redirect()->route('listas.inicio')->with('mensajeprocesos',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('listas.inicio')->with('errorServidorlistaprocesos',$error);
        }
    }

    public function registrarclasificacions(Request $request){
        try {
            $mensaje = "";
            $nombres = $request->nombre;
            while(true){
                $nombre = current($nombres);

                $listaClasificacion = new Clasificacion();
                $listaClasificacion->nombre = $nombre;
                $listaClasificacion->save();

                $nombre = next($nombres);

                if($nombre === false) break;
            }
            $mensaje = "Clasificacion Agregada Correctamente";
            return redirect()->route('listas.inicio')->with('mensajeclasificacion',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('listas.inicio')->with('errorServidorclasificacion',$error);
        }  
    }

    public function actualizarclasificacions(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if($request->nombre[$ids] == ""){
                    $listaClasificacion = Clasificacion::find($ids);
                    $listaClasificacion->delete();
                    $mensaje = "Clasificacion Eliminado Correctamente";
                }else{
                    $nombre = $request->nombre[$ids];
                    DB::table('clasificacions')
                        ->where('id',$ids)
                        ->update(['nombre'=>$nombre]);
                    $mensaje = "Clasificacion Actualizado Correctamente";
                }
            }
            return redirect()->route('listas.inicio')->with('mensajeclasificacion',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('listas.inicio')->with('errorServidorclasificacion',$error);
        } 
    }

    public function registrarlistaUnidadConsumo(Request $request){
        try {
            $mensaje = "";
            $nombres = $request->nombre;
            while(true){
                $nombre = current($nombres);

                $listaUnidadConsumo = new Listaunidaddeconsumo();
                $listaUnidadConsumo->nombre = $nombre;
                $listaUnidadConsumo->save();

                $nombre = next($nombres);

                if($nombre === false) break;
            }
            $mensaje = "Unidad de Consumo Agregada Correctamente";
            return redirect()->route('listas.inicio')->with('mensajeunidadconsumo',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('listas.inicio')->with('errorServidorunidadconsumo',$error);
        }  
    }

    public function actualizarlistaUnidadConsumo(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if($request->nombre[$ids] == ""){
                    $listaUnidadConsumo = Listaunidaddeconsumo::find($ids);
                    $listaUnidadConsumo->delete();
                    $mensaje = "Unidad de Consumo Eliminada Correctamente";
                }else{
                    $nombre = $request->nombre[$ids];
                    DB::table('listaunidaddeconsumos')
                        ->where('id',$ids)
                        ->update(['nombre'=>$nombre]);
                    $mensaje = "Unidad de Consumo Actualizada Correctamente";
                }
            }
            return redirect()->route('listas.inicio')->with('mensajeunidadconsumo',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('listas.inicio')->with('errorServidorunidadconsumo',$error);
        } 
    }

    public function registrarlistaFamiliasMateriales(Request $request){
        try {
            $mensaje = "";
            $nombres = $request->nombre;
            while(true){
                $nombre = current($nombres);

                $listaFamiliasMateriales = new Listafamiliademateriales();
                $listaFamiliasMateriales->nombre = $nombre;
                $listaFamiliasMateriales->save();

                $nombre = next($nombres);

                if($nombre === false) break;
            }
            $mensaje = "Familia de Materiales Agregada Correctamente";
            return redirect()->route('listas.inicio')->with('mensajefamiliamateriales',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('listas.inicio')->with('errorServidorfamiliamateriales',$error);
        }    
    }

    public function actualizarlistaFamiliasMateriales(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if($request->nombre[$ids] == ""){
                    $listaFamiliasMateriales = Listafamiliademateriales::find($ids);
                    $listaFamiliasMateriales->delete();
                    $mensaje = "Familia de Materiales Eliminada Correctamente";
                }else{
                    $nombre = $request->nombre[$ids];
                    DB::table('listafamiliademateriales')
                        ->where('id',$ids)
                        ->update(['nombre'=>$nombre]);
                    $mensaje = "Familia de Materiales Actualizada Correctamente";
                }
            }
            return redirect()->route('listas.inicio')->with('mensajefamiliamateriales',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('listas.inicio')->with('errorServidorfamiliamateriales',$error);
        }
    }
}
