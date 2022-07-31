<?php

namespace App\Http\Controllers;

use App\Models\Clasificacion;
use App\Models\Flujocaja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlujoCajaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
        $flujocajas = Flujocaja::all();
        $clasificaciones = Clasificacion::all();
        return view('services.cashflow',compact('flujocajas','clasificaciones'));
    }

    public function registrar(Request $request){
        $meses = $request->mes;
        $fechas = $request->fecha;
        $clasificaciones = $request->clasificacion_id;
        $detalles = $request->detalle;
        $responsables = $request->responsable;
        $ingresos = $request->ingreso;
        $egresos = $request->egreso;
        $documentos = $request->documento;
        while(true){
            $mes = current($meses);
            $fecha = current($fechas);
            $clasificacion_id = current($clasificaciones);
            $detalle = current($detalles);
            $responsable = current($responsables);
            $ingreso = current($ingresos);
            $egreso = current($egresos);
            $documento = current($documentos);

            $flujocaja = new Flujocaja();
            $flujocaja->mes = $mes;
            $flujocaja->fecha = $fecha;
            $flujocaja->clasificacion_id = $clasificacion_id;
            $flujocaja->detalle = $detalle;
            $flujocaja->responsable = $responsable;
            $flujocaja->ingreso = $ingreso;
            $flujocaja->egreso = $egreso;
            $flujocaja->documento = $documento;
            $flujocaja->save();

            $mes = next($meses);
            $fecha = next($fechas);
            $clasificacion_id = next($clasificaciones);
            $detalle = next($detalles);
            $responsable = next($responsables);
            $ingreso = next($ingresos);
            $egreso = next($egresos);
            $documento = next($documentos);

            if($mes === false && $fecha === false && $clasificacion_id === false && $detalle === false && $responsable === false && $ingreso === false && $egreso === false && $documento === false) break;
        }
        return redirect()->route('flujodecajas.inicio');
    }

    public function actualizar(Request $request){
        foreach ($request->id as $ids) {
            if($request->mes[$ids] == "" & $request->fecha[$ids] == "" & $request->clasificacion_id[$ids] == "" & $request->detalle[$ids] == "" & $request->responsable[$ids] == "" & $request->ingreso[$ids] == "" & $request->egreso[$ids] == "" & $request->documento[$ids] == ""){
                $flujocaja = Flujocaja::find($ids);
                $flujocaja->delete();
            }else{
                $mes = $request->mes[$ids];
                $fecha = $request->fecha[$ids];
                $clasificacion_id = $request->clasificacion_id[$ids];
                $detalle = $request->detalle[$ids];
                $responsable = $request->responsable[$ids];
                $ingreso = $request->ingreso[$ids];
                $egreso = $request->egreso[$ids];
                $documento = $request->documento[$ids];
                DB::table('flujocajas')
                    ->where('id',$ids)
                    ->update(['mes'=>$mes,'fecha'=>$fecha,'clasificacion_id'=>$clasificacion_id,'detalle'=>$detalle,'responsable'=>$responsable,'ingreso'=>$ingreso,'egreso'=>$egreso,'documento'=>$documento]);
            }
        }
        return redirect()->route('flujodecajas.inicio');
    }
}
