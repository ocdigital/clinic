<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;


class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    //criar um novo
    public function create()
    {
        $roles = Role::all();
        return view('users.createOrUpdate', compact('roles'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));

    }

    public function update(Request $request, User $user)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->roles()->sync([$request->role]); 
        $user->save();

        return redirect('/users')->with('success', 'Perfil atualizado com sucesso.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users')->with('success', 'Perfil excluído com sucesso.');
    }
}
