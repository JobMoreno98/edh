<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserStoreRequest;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all(); // Traer todos los roles
    return view('admin.users.create', compact('roles'));
        // return view('admin.users.create');
    }

    public function store(UserStoreRequest $request)
{

    //  dd('llegó al store', $request->all());


    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        // 'role_id' => $request->role_id, 
        'estado' => $request->estado,
    ]);

    if ($request->filled('role_id')) {
            $user->syncRoles([$request->role_id]);
        }
    // $user->syncRoles($request->role_id); //arreglo de los nombres aca sólo da uno? borrar el rol_id del la tala de users en la base de datos ($request->role_id)
    // $user->update();

    return redirect()->route('admin.users.index')
        ->with('success', 'Administrador creado correctamente.');
}

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        // Traer los roles por nombre (no por id)
        $roles = Role::all()->pluck('name', 'id');

        return view('admin.users.edit', compact('user', 'roles'));
    }
    

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->only(['name', 'email', 'estado']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Actualizar usuario
        $user->update($data);

        // Sincronizar roles
        if ($request->filled('role_id')) {
            $user->syncRoles([$request->role_id]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Administrador actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Administrador eliminado correctamente.');
    }
}
