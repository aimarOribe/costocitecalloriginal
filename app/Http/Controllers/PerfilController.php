<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    public function edit(User $perfil)
    {
        return view('perfil.edit',compact('perfil'));
    }

    public function update(Request $request, User $perfil)
    {
        try {
            $mensaje = "";
            $id = $perfil->id;
            $name = $request->name;
            $email = $request->email;
            $password = $request->password;
            $newpassword = $request->newpassword;
            $confirnewpassword = $request->confirnewpassword;

            if($name == ""){
                throw new Exception("No puedes borrar el nombre");
            }

            if($email == ""){
                throw new Exception("No puedes borrar el email");
            }

            if(($newpassword == "" && $confirnewpassword != "") || ($newpassword != "" && $confirnewpassword == "")){
                throw new Exception("Debes ingresar una nueva contraseña o confirmar la contraseña");
            }

            if($newpassword != "" && $confirnewpassword != ""){
                if($newpassword == $confirnewpassword){
                    DB::table('users')
                        ->where('id',$id)
                        ->update(['name'=>$name,'email'=>$email,'password'=>bcrypt($newpassword)]);
                    if($perfil->hasRole('Admin')){
                        $mensaje = "Administrador Actualizado Correctamente";
                    }else{
                        $mensaje = "Empleado Actualizado Correctamente";
                    }
                    return redirect()->route('admin.perfil.edit',$perfil)->with('mensajePerfil',$mensaje);
                }else{
                    throw new Exception("Las contraseñas no son las mismas");
                }
            }else if($newpassword == "" && $confirnewpassword == ""){
                DB::table('users')
                        ->where('id',$id)
                        ->update(['name'=>$name,'email'=>$email,'password'=>$password]);
                    if($perfil->hasRole('Admin')){
                        $mensaje = "Administrador Actualizado Correctamente";
                    }else{
                        $mensaje = "Empleado Actualizado Correctamente";
                    }
                    return redirect()->route('admin.perfil.edit',$perfil)->with('mensajePerfil',$mensaje);
            }
            return redirect()->route('admin.perfil.edit',$perfil)->with('mensajePerfil',$mensaje);
            
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('admin.perfil.edit',$perfil)->with('errorPerfil',$error);
        }
    }
}
