<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Listaproceso;
use App\Models\Manoobra;
use App\Models\Modelofamilia;
use App\Models\Familia;
use Illuminate\Support\Facades\DB;

class Manoobralivewire extends Component
{

    public $familiaSeleccionada = null, $modeloSeleccionado = null;
    public $productos = null;

    public function render(){
        return view('livewire.manoobralivewire',[
            'manoobras'=> Manoobra::all(),
            'familias' => Familia::all(),
            'procesos' => Listaproceso::all(),
        ]);
    }

    public function updatedfamiliaSeleccionada($familiaid){
        $this->productos = Modelofamilia::where('familia_id',$familiaid)->get();
    }

    public function registrarmanoobra(){

    }

    public function actualizarmanoobra(){
        
    }
}
