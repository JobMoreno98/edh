<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // CRUD Roles
    public function index()
    {
        $roles = Role::latest()->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name|max:255',
        ]);

        Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return redirect()->route('admin.roles.index')->with('success', 'Rol creado correctamente.');
    }

    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|max:255|unique:roles,name,' . $role->id,
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.roles.index')->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Rol eliminado correctamente.');
    }

    // ======================
    // Permisos por rol
    // ======================

    public function editPermissions(Role $role)
    {
        // Definir módulos y acciones
        $modules = [
    'Libros' => ['Crear','Editar','Eliminar'],
    'Administradores' => ['Crear','Editar','Eliminar'],
    'Autores' => ['Crear','Editar','Eliminar'],
    'Series' => ['Crear','Editar','Eliminar'],
    'Publicaciones' => ['Crear','Editar','Eliminar'],
    'Comite_Editorial' => ['Crear','Editar','Eliminar'],
    'Roles' => ['Crear','Editar','Eliminar'],
    'Permissions' => ['Crear','Editar','Eliminar'],
    // 'Colecciones' => ['Crear','Editar','Eliminar'],
    'Tipos' => ['Crear','Editar','Eliminar'],
    'Capitulos' => ['Crear','Editar','Eliminar'],
];

foreach($modules as $module => $actions){
    foreach($actions as $action){
        Permission::firstOrCreate(['name' => "$module $action", 'guard_name' => 'web']);
    }
}

        // Obtener permisos actuales del rol
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('admin.roles.permissions', compact('role', 'modules', 'rolePermissions'));
    }

    public function updatePermissions(Request $request, Role $role)
    {
        $modules = [
    'Libros' => ['Crear','Editar','Eliminar'],
    'Administradores' => ['Crear','Editar','Eliminar'],
    'Autores' => ['Crear','Editar','Eliminar'],
    'Series' => ['Crear','Editar','Eliminar'],
    'Publicaciones' => ['Crear','Editar','Eliminar'],
    'Comite_Editorial' => ['Crear','Editar','Eliminar'],
    'Roles' => ['Crear','Editar','Eliminar'],
    'Permissions' => ['Crear','Editar','Eliminar'],
    // 'Colecciones' => ['Crear','Editar','Eliminar'],
    'Tipos' => ['Crear','Editar','Eliminar'],
    'Capitulos' => ['Crear','Editar','Eliminar'],
];


        $selectedPermissions = [];

        foreach ($modules as $module => $actions) {
            foreach ($actions as $action) {
                // Checkbox name: "Libros_Crear", etc.
                if ($request->has("{$module}_{$action}")) {
                    $selectedPermissions[] = "{$module} {$action}";
                }
            }
        }

        // Crear permisos que no existan
        foreach ($selectedPermissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // Sincronizar permisos con el rol
        $role->syncPermissions($selectedPermissions);

        return redirect()->route('admin.roles.index')->with('success', 'Permisos actualizados correctamente.');
    }
}
