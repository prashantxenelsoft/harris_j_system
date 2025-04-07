<?php
namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $menus = DB::table('menus')
            ->where('status', 1)
            ->where('show_in_roles', 1)
            ->orderBy('heading', 'asc')
            ->get();
            //echo "<pre>";print_r($menus);die;
        return view('roles.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        // Save permissions
        if ($request->has('permissions')) {
            foreach ($request->permissions as $menu_id => $permission) {
                RolePermission::create([
                    'role_id' => $role->id,
                    'menu_id' => $menu_id,
                    'can_view' => isset($permission['view']) ? 1 : 0,
                    'can_edit' => isset($permission['edit']) ? 1 : 0,
                ]);
            }
        }

        return redirect()->route('roles.index')->with('success', 'Role created with permissions.');
    }
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $menus = DB::table('menus')
            ->where('status', 1)
            ->where('show_in_roles', 1)
          //  ->orderBy('order', 'asc')
            ->get();

        $permissions = RolePermission::where('role_id', $id)->get();

        return view('roles.edit', compact('role', 'menus', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        // Update role name
        $role->name = $request->name;
        $role->save();

        // Delete existing permissions
        DB::table('role_permissions')->where('role_id', $role->id)->delete();

        // Insert updated permissions
        if ($request->has('permissions')) {
            foreach ($request->permissions as $menu_id => $permission) {
                DB::table('role_permissions')->insert([
                    'role_id'   => $role->id,
                    'menu_id'   => $menu_id,
                    'can_view'  => isset($permission['view']) ? 1 : 0,
                    'can_edit'  => isset($permission['edit']) ? 1 : 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('roles.index')->with('success', 'Role updated successfully with permissions.');
    }


    public function destroy(Role $role)
    {
        \App\Models\User::where('role_id', $role->id)->update(['role_id' => null]);

        DB::table('role_permissions')->where('role_id', $role->id)->delete();
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
