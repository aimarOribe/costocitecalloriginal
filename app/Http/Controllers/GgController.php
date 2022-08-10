<?php

namespace App\Http\Controllers;

use App\Models\Ggeventoanualpersonal;
use App\Models\Ggserviciobasico;
use App\Models\Ggsueldoadministrativo;
use App\Models\Ggtmantenimientoauto;
use App\Models\Ggtpasajecombustible;
use App\Models\Ggutilesescritorio;
use App\Models\Ggvalmuerzoejecutivo;
use App\Models\Ggvotrogastoventa;
use App\Models\Ggvsueldoadministrativo;
use App\Models\Regimenlaboralgastoadministrativo;
use App\Models\Regimenlaboralventa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GgController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
        $gasueldosadministrativos = Ggsueldoadministrativo::all();
        $regimenlaboralgas = Regimenlaboralgastoadministrativo::all();
        $gggautilesescritorios = Ggutilesescritorio::all();
        $gggaeventosanuales = Ggeventoanualpersonal::all();
        $ggvsueldosadministrativos = Ggvsueldoadministrativo::all();
        $regimenlaboralventas = Regimenlaboralventa::all();
        $ggvalmuerzoejecutivos = Ggvalmuerzoejecutivo::all();
        $ggvotrogastoventas = Ggvotrogastoventa::all();
        $ggtpasajecombustibles = Ggtpasajecombustible::all();
        $ggtmantenimientoautos = Ggtmantenimientoauto::all();
        $ggserviciosbasicos = Ggserviciobasico::all();
        return view('services.gg',compact('gasueldosadministrativos','regimenlaboralgas','gggautilesescritorios','gggaeventosanuales','ggvsueldosadministrativos','regimenlaboralventas','ggvalmuerzoejecutivos','ggvotrogastoventas','ggtpasajecombustibles','ggtmantenimientoautos','ggserviciosbasicos'));
    }

    public function obtenervalorgg(Request $request){
        if(isset($request->texto)){
            DB::table('ggs')
                    ->where('id', 1)
                    ->update(['costototal'=>$request->texto]);
            return response()->json(
                [
                    'success' => true
                ]
            );
        }else{
            return response()->json(
                [
                    'success' => false
                ]
            );
        }
    }

    public function registrarggsueldoadministrativo(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $sueldomensualplanilla = $request->sueldomensualplanilla;
            $sueldosinplanilla = $request->sueldosinplanilla;
            $regimenlaboral_id = $request->regimenlaboral_id;

            $sueldoconplanillaDecimal = floatval($sueldomensualplanilla);
            $sueldosinplanillaDecimal = floatval($sueldosinplanilla);
            
            $ggsueldoadministrativo = new Ggsueldoadministrativo();
            $ggsueldoadministrativo->descripcion = $descripcion;
            $ggsueldoadministrativo->sueldomensualplanilla = $sueldoconplanillaDecimal;
            $ggsueldoadministrativo->sueldosinplanilla = $sueldosinplanillaDecimal;
            $ggsueldoadministrativo->regimenlaboral_id = $regimenlaboral_id;
            $ggsueldoadministrativo->save();

            $mensaje = "Sueldo Administrativo Guardado Correctamente";
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function actualizarggsueldoadministrativo(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->sueldomensualplanilla[$ids] == "" && $request->sueldosinplanilla[$ids] == "" && $request->regimenlaboral_id[$ids] == ""){
                    $ggsueldoadministrativo = Ggsueldoadministrativo::find($ids);
                    $ggsueldoadministrativo->delete();
                    $mensaje = "Sueldo Administrativo Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $sueldomensualplanilla = $request->sueldomensualplanilla[$ids];
                    $sueldosinplanilla = $request->sueldosinplanilla[$ids];
                    $regimenlaboral_id = $request->regimenlaboral_id[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar el nombre");
                    }

                    if($sueldomensualplanilla == ""){
                        throw new Exception("No puedes borrar el sueldo mensual en planilla");
                    }

                    if($sueldosinplanilla == ""){
                        throw new Exception("No puedes borrar el sueldo sin planilla");
                    }

                    $sueldoconplanillaDecimal = floatval($sueldomensualplanilla);
                    $sueldosinplanillaDecimal = floatval($sueldosinplanilla);

                    if($regimenlaboral_id == ""){
                        throw new Exception("No puedes borrar el regimen laboral");
                    }

                    $regimenlaboralID = DB::table('regimenlaboralgastoadministrativos')->where('numero', $regimenlaboral_id)->first();
                    $id = $regimenlaboralID->id;

                    DB::table('ggsueldoadministrativos')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'sueldomensualplanilla'=>$sueldoconplanillaDecimal,'sueldosinplanilla'=>$sueldosinplanillaDecimal,'regimenlaboral_id'=>$id]);
                    $mensaje = "Sueldo Administrativo Actualizado Correctamente";
                }
            }
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function registrarggsueldoadministrativosmodal(Request $request){
        try {
            $mensaje = "";
            $nombre = $request->nombre;
            $numero = $request->numero;

            $numeroDecimal = floatval($numero);
            

            $regimenlaboral = new Regimenlaboralgastoadministrativo();
            $regimenlaboral->nombre = $nombre;
            $regimenlaboral->numero = $numeroDecimal;
            $regimenlaboral->save();

            $mensaje = "Regimen Laboral Guardado Correctamente";
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function actualizarggsueldoadministrativosmodal(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->nombre[$ids] == "" && $request->numero[$ids] == ""){
                    $regimenlaboral = Regimenlaboralgastoadministrativo::find($ids);
                    $regimenlaboral->delete();
                    $mensaje = "Regimen Laboral Eliminado Correctamente";
                } else {
                    $nombre = $request->nombre[$ids];
                    $numero = $request->numero[$ids];

                    if($nombre == ""){
                        throw new Exception("No puedes borrar el nombre");
                    }

                    if($numero == ""){
                        throw new Exception("No puedes borrar el numero");
                    }

                    $numeroDecimal = floatval($numero);

                    DB::table('regimenlaboralgastoadministrativos')
                        ->where('id',$ids)
                        ->update(['nombre'=>$nombre,'numero'=>$numeroDecimal]);
                    $mensaje = "Regimen Laboral Actualizado Correctamente";
                }
            }
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function registrargggautilesescritorio(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $gasto = $request->gasto;
            $cantidad = $request->cantidad;
            $periodoanual = $request->periodoanual;

            $gastoDecimal = floatval($gasto);
            
            $ggutilesescritorio = new Ggutilesescritorio();
            $ggutilesescritorio->descripcion = $descripcion;
            $ggutilesescritorio->gasto = $gastoDecimal;
            $ggutilesescritorio->cantidad = $cantidad;
            $ggutilesescritorio->periodoanual = $periodoanual;
            $ggutilesescritorio->save();

            $mensaje = "Utiles de Escritorio Guardado Correctamente";
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function actualizargggautilesescritorio(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->gasto[$ids] == "" && $request->cantidad[$ids] == "" && $request->periodoanual[$ids] == ""){
                    $ggutilesescritorio = Ggutilesescritorio::find($ids);
                    $ggutilesescritorio->delete();
                    $mensaje = "Utiles de Escritorio Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $gasto = $request->gasto[$ids];
                    $cantidad = $request->cantidad[$ids];
                    $periodoanual = $request->periodoanual[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar la descripcion");
                    }

                    if($gasto == ""){
                        throw new Exception("No puedes borrar el gasto");
                    }

                    if($cantidad == ""){
                        throw new Exception("No puedes borrar la cantidad");
                    }

                    $gastoDecimal = floatval($gasto);

                    if($periodoanual == ""){
                        throw new Exception("No puedes borrar el periodo anual");
                    }

                    DB::table('ggutilesescritorios')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'gasto'=>$gastoDecimal,'cantidad'=>$cantidad,'periodoanual'=>$periodoanual]);
                    $mensaje = "Utiles de Escritorio Actualizado Correctamente";
                }
            }
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function registrargggaeventosanuales(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $gasto = $request->gasto;
            $periodoanual = $request->periodoanual;

            $gastoDecimal = floatval($gasto);
            
            $ggeventoanualpersonal = new Ggeventoanualpersonal();
            $ggeventoanualpersonal->descripcion = $descripcion;
            $ggeventoanualpersonal->gasto = $gastoDecimal;
            $ggeventoanualpersonal->periodoanual = $periodoanual;
            $ggeventoanualpersonal->save();

            $mensaje = "Evento Anual para el Personal Guardado Correctamente";
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function actualizargggaeventosanuales(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->gasto[$ids] == "" && $request->periodoanual[$ids] == ""){
                    $ggeventoanualpersonal = Ggeventoanualpersonal::find($ids);
                    $ggeventoanualpersonal->delete();
                    $mensaje = "Evento Anual para el Personal Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $gasto = $request->gasto[$ids];
                    $periodoanual = $request->periodoanual[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar la descripcion");
                    }

                    if($gasto == ""){
                        throw new Exception("No puedes borrar el gasto");
                    }

                    $gastoDecimal = floatval($gasto);

                    if($periodoanual == ""){
                        throw new Exception("No puedes borrar el periodo anual");
                    }

                    DB::table('ggeventoanualpersonals')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'gasto'=>$gastoDecimal,'periodoanual'=>$periodoanual]);
                    $mensaje = "Evento Anual para el Personal Actualizado Correctamente";
                }
            }
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function registrarggvsueldoadministrativo(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $sueldomensualplanilla = $request->sueldomensualplanilla;
            $honoratiosmensuales = $request->honoratiosmensuales;
            $regimenlaboral_id = $request->regimenlaboral_id;

            $sueldoconplanillaDecimal = floatval($sueldomensualplanilla);
            $honoratiosmensualesDecimal = floatval($honoratiosmensuales);
            
            $ggvsueldoadministrativo = new Ggvsueldoadministrativo();
            $ggvsueldoadministrativo->descripcion = $descripcion;
            $ggvsueldoadministrativo->sueldomensualplanilla = $sueldoconplanillaDecimal;
            $ggvsueldoadministrativo->honoratiosmensuales = $honoratiosmensualesDecimal;
            $ggvsueldoadministrativo->regimenlaboral_id = $regimenlaboral_id;
            $ggvsueldoadministrativo->save();

            $mensaje = "Sueldo Administrativo Guardado Correctamente";
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function actualizarggvsueldoadministrativo(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->sueldomensualplanilla[$ids] == "" && $request->honoratiosmensuales[$ids] == "" && $request->regimenlaboral_id[$ids] == ""){
                    $ggvsueldoadministrativo = Ggvsueldoadministrativo::find($ids);
                    $ggvsueldoadministrativo->delete();
                    $mensaje = "Sueldo Administrativo Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $sueldomensualplanilla = $request->sueldomensualplanilla[$ids];
                    $honoratiosmensuales = $request->honoratiosmensuales[$ids];
                    $regimenlaboral_id = $request->regimenlaboral_id[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar el nombre");
                    }

                    if($sueldomensualplanilla == ""){
                        throw new Exception("No puedes borrar el sueldo mensual en planilla");
                    }

                    if($honoratiosmensuales == ""){
                        throw new Exception("No puedes borrar el sueldo sin planilla");
                    }

                    $sueldoconplanillaDecimal = floatval($sueldomensualplanilla);
                    $honoratiosmensualesDecimal = floatval($honoratiosmensuales);

                    if($regimenlaboral_id == ""){
                        throw new Exception("No puedes borrar el regimen laboral");
                    }

                    $regimenlaboralID = DB::table('regimenlaboralventas')->where('numero', $regimenlaboral_id)->first();
                    $id = $regimenlaboralID->id;

                    DB::table('ggvsueldoadministrativos')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'sueldomensualplanilla'=>$sueldoconplanillaDecimal,'honoratiosmensuales'=>$honoratiosmensualesDecimal,'regimenlaboral_id'=>$id]);
                    $mensaje = "Sueldo Administrativo Actualizado Correctamente";
                }
            }
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function registrarggvsueldoadministrativomodal(Request $request){
        try {
            $mensaje = "";
            $nombre = $request->nombre;
            $numero = $request->numero;

            $numeroDecimal = floatval($numero);
            

            $regimenlaboral = new Regimenlaboralventa();
            $regimenlaboral->nombre = $nombre;
            $regimenlaboral->numero = $numeroDecimal;
            $regimenlaboral->save();

            $mensaje = "Regimen Laboral Guardado Correctamente";
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function actualizarggvsueldoadministrativomodal(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->nombre[$ids] == "" && $request->numero[$ids] == ""){
                    $regimenlaboral = Regimenlaboralventa::find($ids);
                    $regimenlaboral->delete();
                    $mensaje = "Regimen Laboral Eliminado Correctamente";
                } else {
                    $nombre = $request->nombre[$ids];
                    $numero = $request->numero[$ids];

                    if($nombre == ""){
                        throw new Exception("No puedes borrar el nombre");
                    }

                    if($numero == ""){
                        throw new Exception("No puedes borrar el numero");
                    }

                    $numeroDecimal = floatval($numero);

                    DB::table('regimenlaboralventas')
                        ->where('id',$ids)
                        ->update(['nombre'=>$nombre,'numero'=>$numeroDecimal]);
                    $mensaje = "Regimen Laboral Actualizado Correctamente";
                }
            }
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function registrarggvalmuerzoejecutivo(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $gasto = $request->gasto;
            $periodoanual = $request->periodoanual;

            $gastoDecimal = floatval($gasto);
            
            $ggvalmuerzoejecutivo = new Ggvalmuerzoejecutivo();
            $ggvalmuerzoejecutivo->descripcion = $descripcion;
            $ggvalmuerzoejecutivo->gasto = $gastoDecimal;
            $ggvalmuerzoejecutivo->periodoanual = $periodoanual;
            $ggvalmuerzoejecutivo->save();

            $mensaje = "Almuerzo Ejecutivo Guardado Correctamente";
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function actualizarggvalmuerzoejecutivo(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->gasto[$ids] == "" && $request->periodoanual[$ids] == ""){
                    $ggvalmuerzoejecutivo = Ggvalmuerzoejecutivo::find($ids);
                    $ggvalmuerzoejecutivo->delete();
                    $mensaje = "Almuerzo Ejecutivo Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $gasto = $request->gasto[$ids];
                    $periodoanual = $request->periodoanual[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar la descripcion");
                    }

                    if($gasto == ""){
                        throw new Exception("No puedes borrar el gasto");
                    }

                    $gastoDecimal = floatval($gasto);

                    if($periodoanual == ""){
                        throw new Exception("No puedes borrar el periodo anual");
                    }

                    DB::table('ggvalmuerzoejecutivos')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'gasto'=>$gastoDecimal,'periodoanual'=>$periodoanual]);
                    $mensaje = "Almuerzo Ejecutivo Actualizado Correctamente";
                }
            }
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function registrarggvotrogastoventa(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $gasto = $request->gasto;
            $periodoanual = $request->periodoanual;

            $gastoDecimal = floatval($gasto);
            
            $ggvotrogastoventa = new Ggvotrogastoventa();
            $ggvotrogastoventa->descripcion = $descripcion;
            $ggvotrogastoventa->gasto = $gastoDecimal;
            $ggvotrogastoventa->periodoanual = $periodoanual;
            $ggvotrogastoventa->save();

            $mensaje = "Otro Gasto Venta Guardado Correctamente";
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function actualizarggvotrogastoventa(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->gasto[$ids] == "" && $request->periodoanual[$ids] == ""){
                    $ggvotrogastoventa = Ggvotrogastoventa::find($ids);
                    $ggvotrogastoventa->delete();
                    $mensaje = "Otro Gasto Venta Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $gasto = $request->gasto[$ids];
                    $periodoanual = $request->periodoanual[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar la descripcion");
                    }

                    if($gasto == ""){
                        throw new Exception("No puedes borrar el gasto");
                    }

                    $gastoDecimal = floatval($gasto);

                    if($periodoanual == ""){
                        throw new Exception("No puedes borrar el periodo anual");
                    }

                    DB::table('ggvotrogastoventas')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'gasto'=>$gastoDecimal,'periodoanual'=>$periodoanual]);
                    $mensaje = "Otro Gasto Venta Actualizado Correctamente";
                }
            }
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function registrarggtpasajecombustible(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $gasto = $request->gasto;
            $periodoanual = $request->periodoanual;

            $gastoDecimal = floatval($gasto);
            
            $ggtpasajecombustible = new Ggtpasajecombustible();
            $ggtpasajecombustible->descripcion = $descripcion;
            $ggtpasajecombustible->gasto = $gastoDecimal;
            $ggtpasajecombustible->periodoanual = $periodoanual;
            $ggtpasajecombustible->save();

            $mensaje = "Pasajes y Combustible Guardado Correctamente";
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function actualizarggtpasajecombustible(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->gasto[$ids] == "" && $request->periodoanual[$ids] == ""){
                    $ggtpasajecombustible = Ggtpasajecombustible::find($ids);
                    $ggtpasajecombustible->delete();
                    $mensaje = "Pasajes y Combustible Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $gasto = $request->gasto[$ids];
                    $periodoanual = $request->periodoanual[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar la descripcion");
                    }

                    if($gasto == ""){
                        throw new Exception("No puedes borrar el gasto");
                    }

                    $gastoDecimal = floatval($gasto);

                    if($periodoanual == ""){
                        throw new Exception("No puedes borrar el periodo anual");
                    }

                    DB::table('ggtpasajecombustibles')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'gasto'=>$gastoDecimal,'periodoanual'=>$periodoanual]);
                    $mensaje = "Pasajes y Combustible Actualizado Correctamente";
                }
            }
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function registrarggtmantenimientoauto(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $gasto = $request->gasto;
            $periodoanual = $request->periodoanual;
            $porcentajeuso = $request->porcentajeuso;

            $gastoDecimal = floatval($gasto);
            
            $ggtmantenimientoauto = new Ggtmantenimientoauto();
            $ggtmantenimientoauto->descripcion = $descripcion;
            $ggtmantenimientoauto->gasto = $gastoDecimal;
            $ggtmantenimientoauto->periodoanual = $periodoanual;
            $ggtmantenimientoauto->porcentajeuso = $porcentajeuso;
            $ggtmantenimientoauto->save();

            $mensaje = "Mantenimiento de Auto Guardado Correctamente";
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function actualizarggtmantenimientoauto(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->gasto[$ids] == "" && $request->periodoanual[$ids] == "" && $request->porcentajeuso[$ids] == ""){
                    $ggtmantenimientoauto = Ggtmantenimientoauto::find($ids);
                    $ggtmantenimientoauto->delete();
                    $mensaje = "Mantenimiento de Auto Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $gasto = $request->gasto[$ids];
                    $periodoanual = $request->periodoanual[$ids];
                    $porcentajeuso = $request->porcentajeuso[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar la descripcion");
                    }

                    if($gasto == ""){
                        throw new Exception("No puedes borrar el gasto");
                    }

                    $gastoDecimal = floatval($gasto);

                    if($periodoanual == ""){
                        throw new Exception("No puedes borrar el periodo anual");
                    }

                    $porcentajeusoDecimal = floatval($porcentajeuso);

                    DB::table('ggtmantenimientoautos')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'gasto'=>$gastoDecimal,'periodoanual'=>$periodoanual,'porcentajeuso'=>$porcentajeusoDecimal]);
                    $mensaje = "Mantenimiento de Auto Actualizado Correctamente";
                }
            }
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function registrarggserviciosbasicos(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $costoservicio = $request->costoservicio;
            $porcentajeuso = $request->porcentajeuso;

            $costoservicioDecimal = floatval($costoservicio);
            $porcentajeusoDecimal = floatval($porcentajeuso);
            
            $ggserviciosbasico = new Ggserviciobasico();
            $ggserviciosbasico->descripcion = $descripcion;
            $ggserviciosbasico->costoservicio = $costoservicioDecimal;
            $ggserviciosbasico->porcentajeuso = $porcentajeusoDecimal;
            $ggserviciosbasico->save();

            $mensaje = "Servicio Basico Guardado Correctamente";
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }

    public function actualizarggserviciosbasicos(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->costoservicio[$ids] == "" && $request->porcentajeuso[$ids] == ""){
                    $ggserviciosbasico = Ggserviciobasico::find($ids);
                    $ggserviciosbasico->delete();
                    $mensaje = "Servicio Basico Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $costoservicio = $request->costoservicio[$ids];
                    $porcentajeuso = $request->porcentajeuso[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar la descripcion");
                    }

                    if($costoservicio == ""){
                        throw new Exception("No puedes borrar el gasto");
                    }

                    $costoservicioDecimal = floatval($costoservicio);

                    $porcentajeusoDecimal = floatval($porcentajeuso);

                    DB::table('ggserviciobasicos')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'costoservicio'=>$costoservicioDecimal,'porcentajeuso'=>$porcentajeusoDecimal]);
                    $mensaje = "Servicio Basico Actualizado Correctamente";
                }
            }
            return redirect()->route('gg.inicio')->with('mensajegg',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gg.inicio')->with('errorUser',$error);
        }
    }
}
