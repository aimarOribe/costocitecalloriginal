<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConfigUserController extends Controller
{
    public function agregarConfigUsuario(Request $request){
        try {
            $mensaje = "";
            $name = $request->name;
            $email = $request->email;
            $password = $request->password;
            $confirpassword = $request->confirpassword;

            if($password == $confirpassword){
                $user = new User();
                $user->name = $name;
                $user->email = $email;
                $user->password = bcrypt($password);
                $user->save();
            }else{
                throw new Exception("Las contraseñas no son iguales");
            }

            $mensaje = "Empleado Guardado Correctamente";

            return redirect()->route('admin.users.index')->with('mensajeConfigUser',$mensaje);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('admin.users.index')->with('errorConfigUser',$error);
        }
    }

    public function verconfigUsuario(User $user)
    {
        $password = $user->password;
        return view('admin.users.configurarUser', compact('user'));
    }

    public function actualizarconfigUsuario(Request $request, User $user){
        try {
            $mensaje = "";
            $id = $user->id;
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
                    if($user->hasRole('Admin')){
                        $mensaje = "Administrador Actualizado Correctamente";
                    }else{
                        $mensaje = "Empleado Actualizado Correctamente";
                    }
                    return redirect()->route('configuser.verconfigUsuario',$user)->with('mensajeConfigUser',$mensaje);
                }else{
                    throw new Exception("Las contraseñas no son las mismas");
                }
            }else if($newpassword == "" && $confirnewpassword == ""){
                DB::table('users')
                        ->where('id',$id)
                        ->update(['name'=>$name,'email'=>$email,'password'=>$password]);
                    if($user->hasRole('Admin')){
                        $mensaje = "Administrador Actualizado Correctamente";
                    }else{
                        $mensaje = "Empleado Actualizado Correctamente";
                    }
                    return redirect()->route('configuser.verconfigUsuario',$user)->with('mensajeConfigUser',$mensaje);
            }
            return redirect()->route('configuser.verconfigUsuario',$user)->with('mensajeConfigUser',$mensaje);
            
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('configuser.verconfigUsuario',$user)->with('errorConfigUser',$error);
        }
    }

    public function eliminarconfigUsuario(User $user){
        try {
            $user = User::find($user->id);
            $nameUser = $user->name;
            $usereliminado = $user->delete();
            if($usereliminado == 1){
                $mensaje = "Empleado ".$nameUser." Eliminado Correctamente";
            }
            return redirect()->route('admin.users.index',$user)->with('mensajeConfigUser',$mensaje);
        }
        catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('configuser.verconfigUsuario',$user)->with('errorConfigUser',$error);
        }
    }
}
