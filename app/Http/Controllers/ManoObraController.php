<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use App\Models\Listaproceso;
use App\Models\Manoobra;
use App\Models\Modelofamilia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManoObraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
        $manoobras = Manoobra::all();
        $familias = Familia::all();
        $modelos = Modelofamilia::all();
        $procesos = Listaproceso::all();
        return view('services.handwork',compact('manoobras','familias','modelos','procesos'));
    }

    public function obtenerModelos($id){
        return Modelofamilia::where('familia_id',$id)->get();
    }

    public function registrarmanoobra(){

    }

    public function actualizarmanoobra(){
        
    }
}
