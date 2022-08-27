<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $correos = array();

        $users = User::role('Admin')->get();

        foreach ($users as $user) {
            $correos[] = $user->email;
        }

        $users = User::whereNotIn('email',$correos)->get(); 
        return view('admin.users.index',compact('users'));
    }
    public function edit(User $user)
    {
        //$roles = Role::all();
        $roles = Role::whereNotIn('name',['Admin'])->get(); 
        return view('admin.users.edit', compact('user','roles'));
    }
    public function update(Request $request, User $user)
    {
        try {
            $user->roles()->sync($request->roles);
            return redirect()->route('admin.users.edit',$user)->with('info','Se asignó los roles correctamente');
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->route('admin.users.edit',$user)->with('errorRol',$error);
        }
    }
}
