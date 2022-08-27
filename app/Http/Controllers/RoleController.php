<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$roles = Role::all();
        $roles = Role::whereNotIn('name',['Admin'])->get(); 
        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mensaje = "";
        try{
            $request->validate([
                'name'=>'required'
            ]);

            $users = Role::where("name","=",$request->name)->get()->first();

            if($users){
                throw new Exception("El nombre del rol ya existe, intente con otro nombre");
            }

            $role = Role::create($request->all());
            $role->permissions()->sync($request->permissions);
            $mensaje = "El Rol fue registrado correctamente";
            return redirect()->route('admin.roles.edit',$role)->with('info',$mensaje);
        }catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('admin.roles.create')->with('errorRol',$error);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('admin.roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //$permissions = Permission::all();
        $permissions = Permission::whereNotIn('name',['admin.roles'])->get(); 
        return view('admin.roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $role->update($request->all());

        $role->permissions()->sync($request->permissions);
        
        return redirect()->route('admin.roles.edit',$role)->with('info','El rol fue actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try{
            $role->delete();
            return redirect()->route('admin.roles.index')->with('info','El rol '.$role->name.' fue eliminado correctamente');
        }catch (\Exception $e) {
            return redirect()->route('admin.roles.index')->with('errorRol','No se puede eliminar debido a que se esta utilizando en este momento');
        }
    }
}
