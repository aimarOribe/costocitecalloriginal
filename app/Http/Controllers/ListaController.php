<?php

namespace App\Http\Controllers;

use App\Models\Clasificacion;
use App\Models\Listafamiliademateriales;
use App\Models\Listaproceso;
use App\Models\Listaunidaddeconsumo;
use App\Models\Listaunidaddemedida;
use Exception;
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

    public function listasUnidadMedida(){
        $listaUnidadDeMedidas = Listaunidaddemedida::all();
        return response()->json(
            [
                'listaUnidadDeMedidas' => $listaUnidadDeMedidas
            ]
        );
    }

    public function registrarlistaUnidadMedidas(Request $request){
        try {
            $mensaje = "";
            $nombre = $request->nombre;

            if($nombre == ""){
                throw new Exception("Debes ingresar un nombre");
            }
            
            $listaUnidadDeMedida = new Listaunidaddemedida();
            $listaUnidadDeMedida->nombre = $nombre;
            $listaUnidadDeMedida->save();
  
            $mensaje = "Unidad de Medida Agregada Correctamente";
            //return redirect()->route('listas.inicio')->with('mensajelistas',$mensaje);
            return response()->json(
                [
                    'success' => true,
                    'mensaje' => $mensaje
                ]
            );
        } catch (\Exception $e) {
            $error = $e->getMessage();
            //return redirect()->route('listas.inicio')->with('errorServidorlistas',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
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
            //return redirect()->route('listas.inicio')->with('mensajelistas',$mensaje);
            return response()->json(
                [
                    'success' => true,
                    'mensaje' => $mensaje
                ]
            );
        }catch (\Illuminate\Database\QueryException $e) {
            $error = "No se puede eliminar este registro debido a que lo estas utilizando en tus demas procesos";
            //return redirect()->route('listas.inicio')->with('errorServidorlistas',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        } catch (\Exception $e) {
            $error = $e->getMessage();
            //return redirect()->route('listas.inicio')->with('errorServidorlistas',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        } 
    }

    public function listasProcesos(){
        $listaProcesos = Listaproceso::all();
        return response()->json(
            [
                'listaProcesos' => $listaProcesos
            ]
        );
    }

    public function registrarlistaProcesos(Request $request){
        try {
            $mensaje = "";
            $nombre = $request->nombre;

            if($nombre == ""){
                throw new Exception("Debes ingresar un nombre");
            }

            $listaProceso = new Listaproceso();
            $listaProceso->nombre = $nombre;
            $listaProceso->save();

            $mensaje = "Proceso Agregado Correctamente";
            //return redirect()->route('listas.inicio')->with('mensajelistas',$mensaje);
            return response()->json(
                [
                    'success' => true,
                    'mensaje' => $mensaje
                ]
            );
        } catch (\Exception $e) {
            $error = $e->getMessage();
            //return redirect()->route('listas.inicio')->with('errorServidorlistas',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        }
    }

    public function actualizarlistaProcesos(Request $request){
        try {
            $mensaje = "";
            if(!$request->has('nombre')){
                $mensaje = "No hay nada que guardar";
            }else{
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
                        $mensaje = "Proceso Actualizado Correctamente";
                    }
                }
            }
            //return redirect()->route('listas.inicio')->with('mensajelistas',$mensaje);
            return response()->json(
                [
                    'success' => true,
                    'mensaje' => $mensaje
                ]
            );
        }catch (\Illuminate\Database\QueryException $e) {
            $error = "No se puede eliminar este registro debido a que lo estas utilizando en tus demas procesos";
            //return redirect()->route('listas.inicio')->with('errorServidorlistas',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        } catch (\Exception $e) {
            $error = $e->getMessage();
            //return redirect()->route('listas.inicio')->with('errorServidorlistas',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        }
    }

    public function listasClasificacion(){
        $listaClasificacions = Clasificacion::all();
        return response()->json(
            [
                'listaClasificacions' => $listaClasificacions
            ]
        );
    }

    public function registrarclasificacions(Request $request){
        try {
            $mensaje = "";
            $nombre = $request->nombre;

            if($nombre == ""){
                throw new Exception("Debes ingresar un nombre");
            }
            
            $listaClasificacion = new Clasificacion();
            $listaClasificacion->nombre = $nombre;
            $listaClasificacion->save();

            $mensaje = "Clasificacion Agregada Correctamente";
            //return redirect()->route('listas.inicio')->with('mensajelistas',$mensaje);
            return response()->json(
                [
                    'success' => true,
                    'mensaje' => $mensaje
                ]
            );
        } catch (\Exception $e) {
            $error = $e->getMessage();
            //return redirect()->route('listas.inicio')->with('errorServidorlistas',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        }  
    }

    public function actualizarclasificacions(Request $request){
        try {
            $mensaje = "";
            if(!$request->has('nombre')){
                $mensaje = "No hay nada que guardar";
            }else{
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
            }
            //return redirect()->route('listas.inicio')->with('mensajelistas',$mensaje);
            return response()->json(
                [
                    'success' => true,
                    'mensaje' => $mensaje
                ]
            );
        } catch (\Illuminate\Database\QueryException $e) {
            $error = "No se puede eliminar este registro debido a que lo estas utilizando en tus demas procesos";
            //return redirect()->route('listas.inicio')->with('errorServidorlistas',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        } catch (\Exception $e) {
            $error = $e->getMessage();
            //return redirect()->route('listas.inicio')->with('errorServidorlistas',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        } 
    }

    public function listasUnidadConsumo(){
        $listaUnidadConsumos = Listaunidaddeconsumo::all();
        return response()->json(
            [
                'listaUnidadConsumos' => $listaUnidadConsumos
            ]
        );
    }

    public function registrarlistaUnidadConsumo(Request $request){
        try {
            $mensaje = "";
            $nombre = $request->nombre;

            if($nombre == ""){
                throw new Exception("Debes ingresar un nombre");
            }

            $listaUnidadConsumo = new Listaunidaddeconsumo();
            $listaUnidadConsumo->nombre = $nombre;
            $listaUnidadConsumo->save();

            $mensaje = "Unidad de Consumo Agregada Correctamente";
            //return redirect()->route('listas.inicio')->with('mensajelistas',$mensaje);
            return response()->json(
                [
                    'success' => true,
                    'mensaje' => $mensaje
                ]
            );
        } catch (\Exception $e) {
            $error = $e->getMessage();
            //return redirect()->route('listas.inicio')->with('errorServidorlistas',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        }  
    }

    public function actualizarlistaUnidadConsumo(Request $request){
        try {
            $mensaje = "";
            if(!$request->has('nombre')){
                $mensaje = "No hay nada que guardar";
            }else{
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
            }
            //return redirect()->route('listas.inicio')->with('mensajelistas',$mensaje);
            return response()->json(
                [
                    'success' => true,
                    'mensaje' => $mensaje
                ]
            );
        } catch (\Illuminate\Database\QueryException $e) {
            $error = "No se puede eliminar este registro debido a que lo estas utilizando en tus demas procesos";
            //return redirect()->route('listas.inicio')->with('errorServidorlistas',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        } catch (\Exception $e) {
            $error = $e->getMessage();
            //return redirect()->route('listas.inicio')->with('errorServidorlistas',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        } 
    }

    public function listasFamiliasMateriales(){
        $listaFamiliasMateriales = Listafamiliademateriales::all();
        return response()->json(
            [
                'listaFamiliasMateriales' => $listaFamiliasMateriales
            ]
        );
    }

    public function registrarlistaFamiliasMateriales(Request $request){
        try {
            $mensaje = "";
            $nombre = $request->nombre;

            if($nombre == ""){
                throw new Exception("Debes ingresar un nombre");
            }

            $listaFamiliasMateriales = new Listafamiliademateriales();
            $listaFamiliasMateriales->nombre = $nombre;
            $listaFamiliasMateriales->save();

            $mensaje = "Familia de Materiales Agregada Correctamente";
            //return redirect()->route('listas.inicio')->with('mensajelistas',$mensaje);
            return response()->json(
                [
                    'success' => true,
                    'mensaje' => $mensaje
                ]
            );
        } catch (\Exception $e) {
            $error = $e->getMessage();
            //return redirect()->route('listas.inicio')->with('errorServidorlistas',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        }    
    }

    public function actualizarlistaFamiliasMateriales(Request $request){
        try {
            $mensaje = "";
            if(!$request->has('nombre')){
                $mensaje = "No hay nada que guardar";
            }else{
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
            }
            //return redirect()->route('listas.inicio')->with('mensajelistas',$mensaje);
            return response()->json(
                [
                    'success' => true,
                    'mensaje' => $mensaje
                ]
            );
        } catch (\Illuminate\Database\QueryException $e) {
            $error = "No se puede eliminar este registro debido a que lo estas utilizando en tus demas procesos";
            //return redirect()->route('listas.inicio')->with('errorServidorlistas',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        } catch (\Exception $e) {
            $error = $e->getMessage();
            //return redirect()->route('listas.inicio')->with('errorServidorlistas',$error);
            return response()->json(
                [
                    'success' => false,
                    'mensaje' => $error
                ]
            );
        }
    }
}
