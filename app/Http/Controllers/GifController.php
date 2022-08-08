<?php

namespace App\Http\Controllers;

use App\Models\Gif;
use App\Models\Gifcategoriaempleados;
use App\Models\Gifempleados;
use App\Models\Gifempleadosconbeneficio;
use App\Models\Gifempleadossinbeneficio;
use App\Models\Gifhmsialistado;
use App\Models\Gifhmsiaparado;
use App\Models\Gifhmsiarmado;
use App\Models\Gifhmsicorte;
use App\Models\Gifhmsieppersonal;
use App\Models\Gifhmsilimpieza;
use App\Models\Gifhmsimodelajeseriado;
use App\Models\Gifrmaparado;
use App\Models\Gifrmarmado;
use App\Models\Listaunidaddemedida;
use App\Models\Regimenlaboral;
use App\Models\Regimenlaboralconbeneficio;
use App\Models\Rmcorte;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GifController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
        $gifs = Gif::all();
        $regimenlaborales = Regimenlaboral::all();
        $regimenlaboralesconbeneficios = Regimenlaboralconbeneficio::all();
        //Unidades de Medida
        $unidaddemedidas = Listaunidaddemedida::all();
        //Empleados con y sin beneficios
        $gifempleadosconbeneficios = Gifempleadosconbeneficio::all();
        $gifempleadossinbeneficios = Gifempleadossinbeneficio::all();
        //hmsief Modelaje y Seriado
        $hmsiefmodelajeseriados = Gifhmsimodelajeseriado::all();
        //hmsief Corte
        $hmsiefcortes = Gifhmsicorte::all();
        //hmsief Aparado
        $hmsiefaparados = Gifhmsiaparado::all();
        //hmsief Armado
        $hmsiefarmados = Gifhmsiarmado::all();
        //hmsief Alistado
        $hmsiefalistados = Gifhmsialistado::all();
        //hmsief Limpieza
        $hmsieflimpiezas = Gifhmsilimpieza::all();
        //hmsief Equipo de Proteccion Personal
        $hmsiefeppersonales = Gifhmsieppersonal::all();
        //rm Corte
        $rmcortes = Rmcorte::all();
        //rm Aparado
        $rmaparados = Gifrmaparado::all();
        //rm Armado
        $rmarmados = Gifrmarmado::all();
        return view('services.gif',compact('gifs','regimenlaborales','regimenlaboralesconbeneficios','gifempleadosconbeneficios','gifempleadossinbeneficios','unidaddemedidas','hmsiefmodelajeseriados','hmsiefcortes','hmsiefaparados','hmsiefarmados','hmsiefalistados','hmsieflimpiezas','hmsiefeppersonales','rmcortes','rmaparados','rmarmados'));
    }

    public function obtenervalorgif(Request $request){
        if(isset($request->texto)){
            DB::table('gifs')
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

    public function registrargifmanoobrasinbeneficios(Request $request){
        try {
            $mensaje = "";
            $nombre = $request->nombre;
            $sueldo = $request->sueldo;
            $ntrabajadores = $request->ntrabajadores;
            $regimenlaboral_id = $request->regimenlaboral_id;

            $costoDecimal = floatval($sueldo);

            if($costoDecimal == 0){
                throw new Exception("No puedes poner texto en el costo");
            }

            $gifempleadosconbeneficios = new Gifempleadossinbeneficio();
            $gifempleadosconbeneficios->nombre = $nombre;
            $sueldo = $gifempleadosconbeneficios->sueldo = $costoDecimal;
            $gifempleadosconbeneficios->ntrabajadores = $ntrabajadores;
            $gifempleadosconbeneficios->regimenlaboral_id = $regimenlaboral_id;
            $gifempleadosconbeneficios->save();

            $mensaje = "Mano de Obra Guardado Correctamente";
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function actualizargifmanoobrasinbeneficios(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->nombre[$ids] == "" && $request->sueldo[$ids] == "" && $request->ntrabajadores[$ids] == "" && $request->regimenlaboral_id[$ids] == ""){
                    $gifempleadossinbeneficios = Gifempleadossinbeneficio::find($ids);
                    $gifempleadossinbeneficios->delete();
                    $mensaje = "Mano de Obra Indirecta Eliminado Correctamente";
                } else {
                    $nombre = $request->nombre[$ids];
                    $sueldo = $request->sueldo[$ids];
                    $ntrabajadores = $request->ntrabajadores[$ids];
                    $regimenlaboral_id = $request->regimenlaboral_id[$ids];

                    if($nombre == ""){
                        throw new Exception("No puedes borrar el nombre");
                    }

                    if($sueldo == ""){
                        throw new Exception("No puedes borrar el sueldo");
                    }

                    $costoDecimal = floatval($sueldo);

                    if($costoDecimal == 0){
                        throw new Exception("No puedes poner texto en el costo");
                    }

                    if($ntrabajadores == ""){
                        throw new Exception("No puedes borrar la cantidad de trabajadores");
                    }
                    if($regimenlaboral_id == ""){
                        throw new Exception("No puedes borrar el regimen laboral");
                    }

                    $regimenlaboralID = DB::table('regimenlaborals')->where('numero', $regimenlaboral_id)->first();
                    $id = $regimenlaboralID->id;

                    DB::table('gifempleadossinbeneficios')
                        ->where('id',$ids)
                        ->update(['nombre'=>$nombre,'sueldo'=>$costoDecimal,'ntrabajadores'=>$ntrabajadores,'regimenlaboral_id'=>$id]);
                    $mensaje = "Mano de Obra Indirecta Actualizado Correctamente";
                }
            }
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function registrargifmanoobraconbeneficios(Request $request){
        try {
            $mensaje = "";
            $nombre = $request->nombre;
            $sueldo = $request->sueldo;
            $ntrabajadores = $request->ntrabajadores;
            $regimenlaboral_id = $request->regimenlaboral_id;

            $costoDecimal = floatval($sueldo);

            if($costoDecimal == 0){
                throw new Exception("No puedes poner texto en el costo");
            }

            $gifempleadosconbeneficios = new Gifempleadosconbeneficio();
            $gifempleadosconbeneficios->nombre = $nombre;
            $sueldo = $gifempleadosconbeneficios->sueldo = $costoDecimal;
            $gifempleadosconbeneficios->ntrabajadores = $ntrabajadores;
            $gifempleadosconbeneficios->regimenlaboral_id = $regimenlaboral_id;
            $gifempleadosconbeneficios->save();

            $mensaje = "Mano de Obra con Beneficios Guardado Correctamente";
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function actualizargifmanoobraconbeneficios(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->nombre[$ids] == "" && $request->sueldo[$ids] == "" && $request->ntrabajadores[$ids] == "" && $request->regimenlaboral_id[$ids] == ""){
                    $gifempleadossinbeneficios = Gifempleadosconbeneficio::find($ids);
                    $gifempleadossinbeneficios->delete();
                    $mensaje = "Mano de Obra Indirecta con Beneficios Eliminado Correctamente";
                } else {
                    $nombre = $request->nombre[$ids];
                    $sueldo = $request->sueldo[$ids];
                    $ntrabajadores = $request->ntrabajadores[$ids];
                    $regimenlaboral_id = $request->regimenlaboral_id[$ids];

                    if($nombre == ""){
                        throw new Exception("No puedes borrar el nombre");
                    }

                    if($sueldo == ""){
                        throw new Exception("No puedes borrar el sueldo");
                    }

                    $costoDecimal = floatval($sueldo);

                    if($costoDecimal == 0){
                        throw new Exception("No puedes poner texto en el costo");
                    }

                    if($ntrabajadores == ""){
                        throw new Exception("No puedes borrar la cantidad de trabajadores");
                    }
                    if($regimenlaboral_id == ""){
                        throw new Exception("No puedes borrar el regimen laboral");
                    }

                    $regimenlaboralID = DB::table('regimenlaboralconbeneficios')->where('numero', $regimenlaboral_id)->first();
                    $id = $regimenlaboralID->id;

                    DB::table('gifempleadosconbeneficios')
                        ->where('id',$ids)
                        ->update(['nombre'=>$nombre,'sueldo'=>$costoDecimal,'ntrabajadores'=>$ntrabajadores,'regimenlaboral_id'=>$id]);
                    $mensaje = "Mano de Obra Indirecta con Beneficios Actualizado Correctamente";
                }
            }
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    // GIF Costos Modelaje y Seriado

    public function registrargifhmsiefmodelajeseriado(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $listaunidadmedida_id = $request->listaunidadmedida_id;
            $valorunitario = $request->valorunitario;
            $consumo = $request->consumo;
            $cantidadmeses = $request->cantidadmeses;

            $valorunitarioDecimal = floatval($valorunitario);

            if($valorunitarioDecimal == 0){
                throw new Exception("No puedes poner texto en el valor unitario");
            }

            $gifhmsimodelajeseriado = new Gifhmsimodelajeseriado();
            $gifhmsimodelajeseriado->descripcion = $descripcion;
            $gifhmsimodelajeseriado->listaunidadmedida_id = $listaunidadmedida_id;
            $gifhmsimodelajeseriado->valorunitario = $valorunitarioDecimal;
            $gifhmsimodelajeseriado->consumo = $consumo;
            $gifhmsimodelajeseriado->cantidadmeses = $cantidadmeses;
            $gifhmsimodelajeseriado->save();

            $mensaje = "Modelaje y Seriado Guardado Correctamente";
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function actualizargifhmsiefmodelajeseriado(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->listaunidadmedida_id[$ids] == "" && $request->valorunitario[$ids] == "" && $request->consumo[$ids] == ""  && $request->cantidadmeses[$ids] == ""){
                    $gifhmsimodelajeseriado = Gifhmsimodelajeseriado::find($ids);
                    $gifhmsimodelajeseriado->delete();
                    $mensaje = "Modelaje y Seriado Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $listaunidadmedida_id = $request->listaunidadmedida_id[$ids];
                    $valorunitario = $request->valorunitario[$ids];
                    $consumo = $request->consumo[$ids];
                    $cantidadmeses = $request->cantidadmeses[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar la descripcion");
                    }

                    if($listaunidadmedida_id == ""){
                        throw new Exception("No puedes borrar la unidad de medida");
                    }

                    $valorunitarioDecimal = floatval($valorunitario);

                    if($valorunitarioDecimal == 0){
                        throw new Exception("No puedes poner texto en el valor unitario");
                    }

                    if($consumo == ""){
                        throw new Exception("No puedes borrar el consumo");
                    }
                    if($cantidadmeses == ""){
                        throw new Exception("No puedes borrar la cantidad de meses");
                    }

                    DB::table('gifhmsimodelajeseriados')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'listaunidadmedida_id'=>$listaunidadmedida_id,'valorunitario'=>$valorunitarioDecimal,'consumo'=>$consumo,'cantidadmeses'=>$cantidadmeses]);
                    $mensaje = "Modelaje y Seriado Actualizado Correctamente";
                }
            }
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    // GIF Costos Corte

    public function registrargifhmsiefcorte(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $listaunidadmedida_id = $request->listaunidadmedida_id;
            $valorunitario = $request->valorunitario;
            $consumo = $request->consumo;
            $cantidadmeses = $request->cantidadmeses;

            $valorunitarioDecimal = floatval($valorunitario);

            if($valorunitarioDecimal == 0){
                throw new Exception("No puedes poner texto en el valor unitario");
            }

            $gifhmsicorte = new Gifhmsicorte();
            $gifhmsicorte->descripcion = $descripcion;
            $gifhmsicorte->listaunidadmedida_id = $listaunidadmedida_id;
            $gifhmsicorte->valorunitario = $valorunitarioDecimal;
            $gifhmsicorte->consumo = $consumo;
            $gifhmsicorte->cantidadmeses = $cantidadmeses;
            $gifhmsicorte->save();

            $mensaje = "Corte Guardado Correctamente";
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function actualizargifhmsiefcorte(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->listaunidadmedida_id[$ids] == "" && $request->valorunitario[$ids] == "" && $request->consumo[$ids] == ""  && $request->cantidadmeses[$ids] == ""){
                    $gifhmsicorte = Gifhmsicorte::find($ids);
                    $gifhmsicorte->delete();
                    $mensaje = "Corte Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $listaunidadmedida_id = $request->listaunidadmedida_id[$ids];
                    $valorunitario = $request->valorunitario[$ids];
                    $consumo = $request->consumo[$ids];
                    $cantidadmeses = $request->cantidadmeses[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar la descripcion");
                    }

                    if($listaunidadmedida_id == ""){
                        throw new Exception("No puedes borrar la unidad de medida");
                    }

                    $valorunitarioDecimal = floatval($valorunitario);

                    if($valorunitarioDecimal == 0){
                        throw new Exception("No puedes poner texto en el valor unitario");
                    }

                    if($consumo == ""){
                        throw new Exception("No puedes borrar el consumo");
                    }
                    if($cantidadmeses == ""){
                        throw new Exception("No puedes borrar la cantidad de meses");
                    }

                    DB::table('gifhmsicortes')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'listaunidadmedida_id'=>$listaunidadmedida_id,'valorunitario'=>$valorunitarioDecimal,'consumo'=>$consumo,'cantidadmeses'=>$cantidadmeses]);
                    $mensaje = "Corte Actualizado Correctamente";
                }
            }
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function registrargifhmsiefaparado(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $listaunidadmedida_id = $request->listaunidadmedida_id;
            $valorunitario = $request->valorunitario;
            $consumo = $request->consumo;
            $cantidadmeses = $request->cantidadmeses;

            $valorunitarioDecimal = floatval($valorunitario);

            if($valorunitarioDecimal == 0){
                throw new Exception("No puedes poner texto en el valor unitario");
            }

            $gifhmsiaparado = new Gifhmsiaparado();
            $gifhmsiaparado->descripcion = $descripcion;
            $gifhmsiaparado->listaunidadmedida_id = $listaunidadmedida_id;
            $gifhmsiaparado->valorunitario = $valorunitarioDecimal;
            $gifhmsiaparado->consumo = $consumo;
            $gifhmsiaparado->cantidadmeses = $cantidadmeses;
            $gifhmsiaparado->save();

            $mensaje = "Aparado Guardado Correctamente";
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function actualizargifhmsiefaparado(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->listaunidadmedida_id[$ids] == "" && $request->valorunitario[$ids] == "" && $request->consumo[$ids] == ""  && $request->cantidadmeses[$ids] == ""){
                    $gifhmsiaparado = Gifhmsiaparado::find($ids);
                    $gifhmsiaparado->delete();
                    $mensaje = "Aparado Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $listaunidadmedida_id = $request->listaunidadmedida_id[$ids];
                    $valorunitario = $request->valorunitario[$ids];
                    $consumo = $request->consumo[$ids];
                    $cantidadmeses = $request->cantidadmeses[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar la descripcion");
                    }

                    if($listaunidadmedida_id == ""){
                        throw new Exception("No puedes borrar la unidad de medida");
                    }

                    $valorunitarioDecimal = floatval($valorunitario);

                    if($valorunitarioDecimal == 0){
                        throw new Exception("No puedes poner texto en el valor unitario");
                    }

                    if($consumo == ""){
                        throw new Exception("No puedes borrar el consumo");
                    }
                    if($cantidadmeses == ""){
                        throw new Exception("No puedes borrar la cantidad de meses");
                    }

                    DB::table('gifhmsiaparados')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'listaunidadmedida_id'=>$listaunidadmedida_id,'valorunitario'=>$valorunitarioDecimal,'consumo'=>$consumo,'cantidadmeses'=>$cantidadmeses]);
                    $mensaje = "Aparado Actualizado Correctamente";
                }
            }
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function registrargifhmsiefarmado(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $listaunidadmedida_id = $request->listaunidadmedida_id;
            $valorunitario = $request->valorunitario;
            $consumo = $request->consumo;
            $cantidadmeses = $request->cantidadmeses;

            $valorunitarioDecimal = floatval($valorunitario);

            if($valorunitarioDecimal == 0){
                throw new Exception("No puedes poner texto en el valor unitario");
            }

            $gifhmsiarmado = new Gifhmsiarmado();
            $gifhmsiarmado->descripcion = $descripcion;
            $gifhmsiarmado->listaunidadmedida_id = $listaunidadmedida_id;
            $gifhmsiarmado->valorunitario = $valorunitarioDecimal;
            $gifhmsiarmado->consumo = $consumo;
            $gifhmsiarmado->cantidadmeses = $cantidadmeses;
            $gifhmsiarmado->save();

            $mensaje = "Armado Guardado Correctamente";
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function actualizargifhmsiefarmado(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->listaunidadmedida_id[$ids] == "" && $request->valorunitario[$ids] == "" && $request->consumo[$ids] == ""  && $request->cantidadmeses[$ids] == ""){
                    $gifhmsiarmado = Gifhmsiarmado::find($ids);
                    $gifhmsiarmado->delete();
                    $mensaje = "Armado Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $listaunidadmedida_id = $request->listaunidadmedida_id[$ids];
                    $valorunitario = $request->valorunitario[$ids];
                    $consumo = $request->consumo[$ids];
                    $cantidadmeses = $request->cantidadmeses[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar la descripcion");
                    }

                    if($listaunidadmedida_id == ""){
                        throw new Exception("No puedes borrar la unidad de medida");
                    }

                    $valorunitarioDecimal = floatval($valorunitario);

                    if($valorunitarioDecimal == 0){
                        throw new Exception("No puedes poner texto en el valor unitario");
                    }

                    if($consumo == ""){
                        throw new Exception("No puedes borrar el consumo");
                    }
                    if($cantidadmeses == ""){
                        throw new Exception("No puedes borrar la cantidad de meses");
                    }

                    DB::table('gifhmsiarmados')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'listaunidadmedida_id'=>$listaunidadmedida_id,'valorunitario'=>$valorunitarioDecimal,'consumo'=>$consumo,'cantidadmeses'=>$cantidadmeses]);
                    $mensaje = "Armado Actualizado Correctamente";
                }
            }
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function registrargifhmsiefalistado(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $listaunidadmedida_id = $request->listaunidadmedida_id;
            $valorunitario = $request->valorunitario;
            $consumo = $request->consumo;
            $cantidadmeses = $request->cantidadmeses;

            $valorunitarioDecimal = floatval($valorunitario);

            if($valorunitarioDecimal == 0){
                throw new Exception("No puedes poner texto en el valor unitario");
            }

            $gifhmsialistado = new Gifhmsialistado();
            $gifhmsialistado->descripcion = $descripcion;
            $gifhmsialistado->listaunidadmedida_id = $listaunidadmedida_id;
            $gifhmsialistado->valorunitario = $valorunitarioDecimal;
            $gifhmsialistado->consumo = $consumo;
            $gifhmsialistado->cantidadmeses = $cantidadmeses;
            $gifhmsialistado->save();

            $mensaje = "Alistado Guardado Correctamente";
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function actualizargifhmsiefalistado(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->listaunidadmedida_id[$ids] == "" && $request->valorunitario[$ids] == "" && $request->consumo[$ids] == ""  && $request->cantidadmeses[$ids] == ""){
                    $gifhmsialistado = Gifhmsialistado::find($ids);
                    $gifhmsialistado->delete();
                    $mensaje = "Alistado Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $listaunidadmedida_id = $request->listaunidadmedida_id[$ids];
                    $valorunitario = $request->valorunitario[$ids];
                    $consumo = $request->consumo[$ids];
                    $cantidadmeses = $request->cantidadmeses[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar la descripcion");
                    }

                    if($listaunidadmedida_id == ""){
                        throw new Exception("No puedes borrar la unidad de medida");
                    }

                    $valorunitarioDecimal = floatval($valorunitario);

                    if($valorunitarioDecimal == 0){
                        throw new Exception("No puedes poner texto en el valor unitario");
                    }

                    if($consumo == ""){
                        throw new Exception("No puedes borrar el consumo");
                    }
                    if($cantidadmeses == ""){
                        throw new Exception("No puedes borrar la cantidad de meses");
                    }

                    DB::table('gifhmsialistados')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'listaunidadmedida_id'=>$listaunidadmedida_id,'valorunitario'=>$valorunitarioDecimal,'consumo'=>$consumo,'cantidadmeses'=>$cantidadmeses]);
                    $mensaje = "Alistado Actualizado Correctamente";
                }
            }
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function registrargifhmsieflimpieza(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $listaunidadmedida_id = $request->listaunidadmedida_id;
            $valorunitario = $request->valorunitario;
            $consumo = $request->consumo;
            $cantidadmeses = $request->cantidadmeses;

            $valorunitarioDecimal = floatval($valorunitario);

            if($valorunitarioDecimal == 0){
                throw new Exception("No puedes poner texto en el valor unitario");
            }

            $gifhmsilimpieza = new Gifhmsilimpieza();
            $gifhmsilimpieza->descripcion = $descripcion;
            $gifhmsilimpieza->listaunidadmedida_id = $listaunidadmedida_id;
            $gifhmsilimpieza->valorunitario = $valorunitarioDecimal;
            $gifhmsilimpieza->consumo = $consumo;
            $gifhmsilimpieza->cantidadmeses = $cantidadmeses;
            $gifhmsilimpieza->save();

            $mensaje = "Limpieza Guardado Correctamente";
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function actualizargifhmsieflimpieza(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->listaunidadmedida_id[$ids] == "" && $request->valorunitario[$ids] == "" && $request->consumo[$ids] == ""  && $request->cantidadmeses[$ids] == ""){
                    $gifhmsilimpieza = Gifhmsilimpieza::find($ids);
                    $gifhmsilimpieza->delete();
                    $mensaje = "Limpieza Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $listaunidadmedida_id = $request->listaunidadmedida_id[$ids];
                    $valorunitario = $request->valorunitario[$ids];
                    $consumo = $request->consumo[$ids];
                    $cantidadmeses = $request->cantidadmeses[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar la descripcion");
                    }

                    if($listaunidadmedida_id == ""){
                        throw new Exception("No puedes borrar la unidad de medida");
                    }

                    $valorunitarioDecimal = floatval($valorunitario);

                    if($valorunitarioDecimal == 0){
                        throw new Exception("No puedes poner texto en el valor unitario");
                    }

                    if($consumo == ""){
                        throw new Exception("No puedes borrar el consumo");
                    }
                    if($cantidadmeses == ""){
                        throw new Exception("No puedes borrar la cantidad de meses");
                    }

                    DB::table('gifhmsilimpiezas')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'listaunidadmedida_id'=>$listaunidadmedida_id,'valorunitario'=>$valorunitarioDecimal,'consumo'=>$consumo,'cantidadmeses'=>$cantidadmeses]);
                    $mensaje = "Limpieza Actualizado Correctamente";
                }
            }
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function registrargifhmsiefeppersonal(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $listaunidadmedida_id = $request->listaunidadmedida_id;
            $valorunitario = $request->valorunitario;
            $consumo = $request->consumo;
            $cantidadmeses = $request->cantidadmeses;

            $valorunitarioDecimal = floatval($valorunitario);

            if($valorunitarioDecimal == 0){
                throw new Exception("No puedes poner texto en el valor unitario");
            }

            $gifhmsieppersonal = new Gifhmsieppersonal();
            $gifhmsieppersonal->descripcion = $descripcion;
            $gifhmsieppersonal->listaunidadmedida_id = $listaunidadmedida_id;
            $gifhmsieppersonal->valorunitario = $valorunitarioDecimal;
            $gifhmsieppersonal->consumo = $consumo;
            $gifhmsieppersonal->cantidadmeses = $cantidadmeses;
            $gifhmsieppersonal->save();

            $mensaje = "Equipo de Proteccion Personal Guardado Correctamente";
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function actualizargifhmsiefeppersonal(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->listaunidadmedida_id[$ids] == "" && $request->valorunitario[$ids] == "" && $request->consumo[$ids] == ""  && $request->cantidadmeses[$ids] == ""){
                    $gifhmsieppersonal = Gifhmsieppersonal::find($ids);
                    $gifhmsieppersonal->delete();
                    $mensaje = "Equipo de Proteccion Personal Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $listaunidadmedida_id = $request->listaunidadmedida_id[$ids];
                    $valorunitario = $request->valorunitario[$ids];
                    $consumo = $request->consumo[$ids];
                    $cantidadmeses = $request->cantidadmeses[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar la descripcion");
                    }

                    if($listaunidadmedida_id == ""){
                        throw new Exception("No puedes borrar la unidad de medida");
                    }

                    $valorunitarioDecimal = floatval($valorunitario);

                    if($valorunitarioDecimal == 0){
                        throw new Exception("No puedes poner texto en el valor unitario");
                    }

                    if($consumo == ""){
                        throw new Exception("No puedes borrar el consumo");
                    }
                    if($cantidadmeses == ""){
                        throw new Exception("No puedes borrar la cantidad de meses");
                    }

                    DB::table('gifhmsieppersonals')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'listaunidadmedida_id'=>$listaunidadmedida_id,'valorunitario'=>$valorunitarioDecimal,'consumo'=>$consumo,'cantidadmeses'=>$cantidadmeses]);
                    $mensaje = "Equipo de Proteccion Personal Actualizado Correctamente";
                }
            }
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function registrargifrmcorte(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $listaunidadmedida_id = $request->listaunidadmedida_id;
            $cantidad = $request->cantidad;
            $gastomantenimiento = $request->gastomantenimiento;
            $frecuenciaanual = $request->frecuenciaanual;

            $gifrmcorte = new Rmcorte();
            $gifrmcorte->descripcion = $descripcion;
            $gifrmcorte->listaunidadmedida_id = $listaunidadmedida_id;
            $gifrmcorte->cantidad = $cantidad;
            $gifrmcorte->gastomantenimiento = $gastomantenimiento;
            $gifrmcorte->frecuenciaanual = $frecuenciaanual;
            $gifrmcorte->save();

            $mensaje = "RM Corte Guardado Correctamente";
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function actualizargifrmcorte(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->listaunidadmedida_id[$ids] == "" && $request->cantidad[$ids] == "" && $request->gastomantenimiento[$ids] == ""  && $request->frecuenciaanual[$ids] == ""){
                    $gifrmcorte = Rmcorte::find($ids);
                    $gifrmcorte->delete();
                    $mensaje = "RM Corte Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $listaunidadmedida_id = $request->listaunidadmedida_id[$ids];
                    $cantidad = $request->cantidad[$ids];
                    $gastomantenimiento = $request->gastomantenimiento[$ids];
                    $frecuenciaanual = $request->frecuenciaanual[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar la descripcion");
                    }

                    if($listaunidadmedida_id == ""){
                        throw new Exception("No puedes borrar la unidad de medida");
                    }

                    if($cantidad == ""){
                        throw new Exception("No puedes borrar la cantidad");
                    }
                    if($gastomantenimiento == ""){
                        throw new Exception("No puedes borrar el gasto por mantenimiento");
                    }

                    if($frecuenciaanual == ""){
                        throw new Exception("No puedes borrar la frecuencia anual");
                    }

                    DB::table('rmcortes')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'listaunidadmedida_id'=>$listaunidadmedida_id,'cantidad'=>$cantidad,'gastomantenimiento'=>$gastomantenimiento,'frecuenciaanual'=>$frecuenciaanual]);
                    $mensaje = "RM Corte Actualizado Correctamente";
                }
            }
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function registrargifrmaparado(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $listaunidadmedida_id = $request->listaunidadmedida_id;
            $cantidad = $request->cantidad;
            $gastomantenimiento = $request->gastomantenimiento;
            $frecuenciaanual = $request->frecuenciaanual;

            $gifrmaparado = new Gifrmaparado();
            $gifrmaparado->descripcion = $descripcion;
            $gifrmaparado->listaunidadmedida_id = $listaunidadmedida_id;
            $gifrmaparado->cantidad = $cantidad;
            $gifrmaparado->gastomantenimiento = $gastomantenimiento;
            $gifrmaparado->frecuenciaanual = $frecuenciaanual;
            $gifrmaparado->save();

            $mensaje = "RM Aparado Guardado Correctamente";
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function actualizargifrmaparado(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->listaunidadmedida_id[$ids] == "" && $request->cantidad[$ids] == "" && $request->gastomantenimiento[$ids] == ""  && $request->frecuenciaanual[$ids] == ""){
                    $gifrmaparado = Gifrmaparado::find($ids);
                    $gifrmaparado->delete();
                    $mensaje = "RM Aparado Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $listaunidadmedida_id = $request->listaunidadmedida_id[$ids];
                    $cantidad = $request->cantidad[$ids];
                    $gastomantenimiento = $request->gastomantenimiento[$ids];
                    $frecuenciaanual = $request->frecuenciaanual[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar la descripcion");
                    }

                    if($listaunidadmedida_id == ""){
                        throw new Exception("No puedes borrar la unidad de medida");
                    }

                    if($cantidad == ""){
                        throw new Exception("No puedes borrar la cantidad");
                    }
                    if($gastomantenimiento == ""){
                        throw new Exception("No puedes borrar el gasto por mantenimiento");
                    }

                    if($frecuenciaanual == ""){
                        throw new Exception("No puedes borrar la frecuencia anual");
                    }

                    DB::table('gifrmaparados')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'listaunidadmedida_id'=>$listaunidadmedida_id,'cantidad'=>$cantidad,'gastomantenimiento'=>$gastomantenimiento,'frecuenciaanual'=>$frecuenciaanual]);
                    $mensaje = "RM Aparado Actualizado Correctamente";
                }
            }
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function registrargifrmarmado(Request $request){
        try {
            $mensaje = "";
            $descripcion = $request->descripcion;
            $listaunidadmedida_id = $request->listaunidadmedida_id;
            $cantidad = $request->cantidad;
            $gastomantenimiento = $request->gastomantenimiento;
            $frecuenciaanual = $request->frecuenciaanual;

            $gifrmarmado = new Gifrmarmado();
            $gifrmarmado->descripcion = $descripcion;
            $gifrmarmado->listaunidadmedida_id = $listaunidadmedida_id;
            $gifrmarmado->cantidad = $cantidad;
            $gifrmarmado->gastomantenimiento = $gastomantenimiento;
            $gifrmarmado->frecuenciaanual = $frecuenciaanual;
            $gifrmarmado->save();

            $mensaje = "RM Armado Guardado Correctamente";
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }

    public function actualizargifrmarmado(Request $request){
        try {
            $mensaje = "";
            foreach ($request->id as $ids) {
                if ($request->descripcion[$ids] == "" && $request->listaunidadmedida_id[$ids] == "" && $request->cantidad[$ids] == "" && $request->gastomantenimiento[$ids] == ""  && $request->frecuenciaanual[$ids] == ""){
                    $gifrmarmado = Gifrmarmado::find($ids);
                    $gifrmarmado->delete();
                    $mensaje = "RM Armado Eliminado Correctamente";
                } else {
                    $descripcion = $request->descripcion[$ids];
                    $listaunidadmedida_id = $request->listaunidadmedida_id[$ids];
                    $cantidad = $request->cantidad[$ids];
                    $gastomantenimiento = $request->gastomantenimiento[$ids];
                    $frecuenciaanual = $request->frecuenciaanual[$ids];

                    if($descripcion == ""){
                        throw new Exception("No puedes borrar la descripcion");
                    }

                    if($listaunidadmedida_id == ""){
                        throw new Exception("No puedes borrar la unidad de medida");
                    }

                    if($cantidad == ""){
                        throw new Exception("No puedes borrar la cantidad");
                    }
                    if($gastomantenimiento == ""){
                        throw new Exception("No puedes borrar el gasto por mantenimiento");
                    }

                    if($frecuenciaanual == ""){
                        throw new Exception("No puedes borrar la frecuencia anual");
                    }

                    DB::table('gifrmarmados')
                        ->where('id',$ids)
                        ->update(['descripcion'=>$descripcion,'listaunidadmedida_id'=>$listaunidadmedida_id,'cantidad'=>$cantidad,'gastomantenimiento'=>$gastomantenimiento,'frecuenciaanual'=>$frecuenciaanual]);
                    $mensaje = "RM Armado Actualizado Correctamente";
                }
            }
            return redirect()->route('gif.inicio')->with('mensajegif',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('gif.inicio')->with('errorUser',$error);
        }
    }
}
