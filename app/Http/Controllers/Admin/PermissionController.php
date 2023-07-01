<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
        
    }

    public function create()
    {
        return view('admin.permissions.createOrUpdate');
    }

    public function store(Request $request)
    {
        // Valide os dados do formulário aqui
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Crie uma nova Role com base nos dados do formulário
        Permission::create([
            'name' => $request->name,
        ]);

        // Redirecione para a página desejada após a criação da Role
        return redirect()->route('admin.permissions.index')->with('message', 'Permissão criada com sucesso!');
    }

    public function show(Permission $permission)
    {
        return view('admin.permissions.show', compact('permission'));
    }

    public function edit(Permission $permission)
    {
        $roles = Role::all();
        return view('admin.permissions.createOrUpdate', compact('permission', 'roles'));
    }

    public function update(Request $request, Permission $permission)
    {
        // Valide os dados do formulário aqui
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Atualize a Role com base nos dados do formulário
        $permission->update([
            'name' => $request->name,
        ]);

        // Redirecione para a página desejada após a atualização da Role
        return redirect()->route('admin.permissions.index')->with('message', 'Permissão atualizada com sucesso!');
    }

    public function destroy(Permission $permission)
    {
        // Exclua a Role
        $permission->delete();

        // Redirecione para a página desejada após a exclusão da Role
        return redirect()->route('admin.permissions.index')->with('message', 'Permissão excluída com sucesso!');
    }

    public function assignRole(Request $request, Permission $permission)
    {   

        // Atribua a Role ao usuário
        $permission->assignRole($request->roles);

        // Redirecione para a página desejada após a atribuição da Role
        return back()->with('message', 'Permissão atribuída com sucesso!');
    }

    public function removeRole(Permission $permission, Role $role)
    {   
        // Remova a Role do usuário
        $permission->removeRole($role);

        // Redirecione para a página desejada após a remoção da Role
        return back()->with('message', 'Permissão removida com sucesso!');
    }
}
