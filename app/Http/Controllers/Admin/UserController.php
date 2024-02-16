<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    //create
    public function create()
    {
        return view('admin.users.createOrUpdate');
    }

    //edit
    public function edit(User $user)
    {
        return view('admin.users.createOrUpdate', compact('user'));
    }

    //store
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'email|unique:users,email'
        ]);

        try {
            $user = new User();
            $user->fill($request->all());
            $user->password = Hash::make('3221#Edu');
            $user->save();
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => $e->getMessage()]);
        }
    }

    //update
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|unique:users,email,' . $user->id
        ]);

        try {
            $user->update($request->all());
            $user->save();
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => $e->getMessage()]);
        }
    }


    public function show(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.users.role', compact('user', 'roles', 'permissions'));
    }



    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            return back()->with('message', 'Role exists.');
        }

        $user->assignRole($request->role);
        return back();
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('message', 'Role removed.');
        }

        return back()->with('message', 'Role not exists.');
    }

    public function givePermission(Request $request, User $user)
    {
        if ($user->hasPermissionTo($request->permission)) {
            return back()->with('message', 'Permission exists.');
        }
        $user->givePermissionTo($request->permission);
        return back();
    }

    public function revokePermission(User $user, Permission $permission)
    {
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
        return back()->with('message', 'Permission does not exists.');
    }

    public function destroy(User $user)
    {
        if ($user->hasRole('admin')) {
            return back()->with('message', 'you are admin.');
        }
        $user->delete();

        return back();
    }

}
