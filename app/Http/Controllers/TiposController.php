<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;
use App\Http\Requests\TipoStoreRequest;
use App\Http\Requests\TipoUpdateRequest;
use Illuminate\Foundation\Console\PolicyMakeCommand;
use phpDocumentor\Reflection\Types\This;

class TiposController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:Tipos Crear')->only(['create', 'store']);
        $this->middleware('permission:Tipos Editar')->only(['edit', 'update']);
        $this->middleware('permission:Tipos Eliminar')->only(['destroy']);
    }
    /**
     * Mostrar todos los tipos.
     */
    public function index()
    {
        $tipos = Tipo::latest()->paginate(10);
        return view('admin.tipos.index', compact('tipos'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        
        return view('admin.tipos.create');
    }

    /**
     * Guardar un tipo nuevo.
     */
    public function store(TipoStoreRequest $request)
    {
        Tipo::create($request->validated());

        return redirect()->route('admin.tipos.index')->with('success', 'Tipo creado correctamente.');
    }

    /**
     * Mostrar un tipo.
     */
    public function show(Tipo $tipo)
    {
        return view('admin.tipos.show', compact('tipo'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Tipo $tipo)
    {
        return view('admin.tipos.edit', compact('tipo'));
    }

    /**
     * Actualizar un tipo.
     */
    public function update(TipoUpdateRequest $request, Tipo $tipo)
    {
        $tipo->update($request->validated());

        return redirect()->route('admin.tipos.index')->with('success', 'Tipo actualizado correctamente.');
    }

    /**
     * Eliminar (soft delete) un tipo.
     */
    public function destroy(Tipo $tipo)
    {
        $tipo->delete();
        return redirect()->route('admin.tipos.index')->with('success', 'Tipo eliminado correctamente.');
    }
}
