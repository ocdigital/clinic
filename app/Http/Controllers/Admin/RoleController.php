<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public function index()
    {
        // $roles = Role::whereNotIn('name', ['admin'])->get();
        $roles = Role::all();
        // dd($roles);
        return view('admin.roles.index', compact('roles'));


    }

    public function create()
    {
        return view('admin.roles.createOrUpdate');
    }

    public function store(Request $request)
    {
        // Valide os dados do formulário aqui
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Crie uma nova Role com base nos dados do formulário
        Role::create([
            'name' => $request->name,
        ]);

        // Redirecione para a página desejada após a criação da Role
        return redirect()->route('admin.roles.index')->with('message', 'Role criada com sucesso!');
    }

    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.createOrUpdate', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        // Valide os dados do formulário aqui
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Atualize a Role com base nos dados do formulário
        $role->update([
            'name' => $request->name,
        ]);

        // Redirecione para a página desejada após a atualização da Role
        return redirect()->route('admin.roles.index')->with('message', 'Role atualizada com sucesso!');
    }

    public function destroy(Role $role)
    {
        // Exclua a Role
        $role->delete();

        // Redirecione para a página desejada após a exclusão da Role
        return redirect()->route('admin.roles.index')->with('message', 'Role excluída com sucesso!');
    }

    public function givePermission(Request $request, Role $role){

        $role->givePermissionTo($request->permissions);
        return redirect()->back()->with('message', 'Permissão atribuída com sucesso!');

    //

    }

    public function revokePermission(Role $role, Permission $permission){

        $role->revokePermissionTo($permission);
        return redirect()->back()->with('message', 'Permissão removida com sucesso!');
    }

}
