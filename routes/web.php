<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\FlujoCajaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\ManoObraController;
use App\Http\Controllers\ModeloInsumo;
use App\Http\Controllers\ModeloInsumoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Manoobralivewire;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

//Home
Route::get('/home',[HomeController::class,'inicio'])->middleware('auth')->name('home.inicio');

//Users
Route::resource('/users', UserController::class)->only(['index','edit','update'])->middleware('can:admin.personal')->names('admin.users');

//Roles
Route::resource('/roles', RoleController::class)->names('admin.roles');

//Familias
Route::get('/familias',[FamiliaController::class,'inicio'])->middleware('auth')->name('familias.inicio');
Route::post('/familias',[FamiliaController::class,'registrar'])->name('familias.registrar');
Route::post('/familias/actualizar',[FamiliaController::class,'actualizar'])->name('familias.actualizar');

//Flujo de Cajas
Route::get('/flujodecajas',[FlujoCajaController::class,'inicio'])->middleware('auth')->name('flujodecajas.inicio');
Route::post('/flujodecajas',[FlujoCajaController::class,'registrar'])->name('flujodecajas.registrar');
Route::post('/flujodecajas/actualizar',[FlujoCajaController::class,'actualizar'])->name('flujodecajas.actualizar');

//Listas
Route::get('/listas',[ListaController::class,'inicio'])->middleware('auth')->name('listas.inicio');
//Unidad de Medidas
Route::post('/listaUnidadMedidas',[ListaController::class,'registrarlistaUnidadMedidas'])->name('listas.registrarlistaUnidadMedidas');
Route::post('/listaUnidadMedidas/actualizar',[ListaController::class,'actualizarlistaUnidadMedidas'])->name('listas.actualizarlistaUnidadMedidas');
//Procesos
Route::post('/listaProcesos',[ListaController::class,'registrarlistaProcesos'])->name('listas.registrarlistaProcesos');
Route::post('/listaProcesos/actualizar',[ListaController::class,'actualizarlistaProcesos'])->name('listas.actualizarlistaProcesos');
//Clasificacion
Route::post('/listaClasificacions',[ListaController::class,'registrarclasificacions'])->name('listas.registrarclasificacions');
Route::post('/listaClasificacions/actualizar',[ListaController::class,'actualizarclasificacions'])->name('listas.actualizarclasificacions');
//Unidad de Consumo
Route::post('/listaUnidadConsumo',[ListaController::class,'registrarlistaUnidadConsumo'])->name('listas.registrarlistaUnidadConsumo');
Route::post('/listaUnidadConsumo/actualizar',[ListaController::class,'actualizarlistaUnidadConsumo'])->name('listas.actualizarlistaUnidadConsumo');
//Familias de Materiales
Route::post('/listaFamiliasMateriales',[ListaController::class,'registrarlistaFamiliasMateriales'])->name('listas.registrarlistaFamiliasMateriales');
Route::post('/listaFamiliasMateriales/actualizar',[ListaController::class,'actualizarlistaFamiliasMateriales'])->name('listas.actualizarlistaFamiliasMateriales');

//Modelos E Insumos
Route::get('/modeloseinsumos',[ModeloInsumoController::class,'inicio'])->middleware('auth')->name('modeloseinsumos.inicio');
//Modelos E Insumos -> Modelos
Route::post('/modeloseinsumosmodelos',[ModeloInsumoController::class,'registrarmodeloseinsumosmodelos'])->name('modeloseinsumos.registrarmodeloseinsumosmodelos');
Route::post('/modeloseinsumosmodelos/actualizar',[ModeloInsumoController::class,'actualizarmodeloseinsumosmodelos'])->name('modeloseinsumos.actualizarmodeloseinsumosmodelos');
//Modelos E Insumos -> Insumos
Route::post('/modeloseinsumosinsumos',[ModeloInsumoController::class,'registrarmodeloseinsumosinsumos'])->name('modeloseinsumos.registrarmodeloseinsumosinsumos');
Route::post('/modeloseinsumosinsumos/actualizar',[ModeloInsumoController::class,'actualizarmodeloseinsumosinsumos'])->name('modeloseinsumos.actualizarmodeloseinsumosinsumos');



// Mano de Obra
Route::get('/manoobra',[ManoObraController::class,'inicio'])->middleware('auth')->name('manoobra.inicio');
Route::post('/manoobra',[ManoObraController::class,'registrarmanoobra'])->name('manoobra.registrarmanoobra');
Route::post('/manoobra/actualizar',[ManoObraController::class,'actualizarmanoobra'])->name('manoobra.actualizarmanoobra');


require __DIR__.'/auth.php';
