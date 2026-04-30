<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Serie;
use App\Models\Autor;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\LibroStoreRequest;
use App\Http\Requests\LibroUpdateRequest;
use Illuminate\Support\Facades\Storage;

class LibrosController extends Controller
{


    public function __construct()
    {
        $this->middleware('permission:Libros Crear')->only(['create', 'store']);
        $this->middleware('permission:Libros Editar')->only(['edit', 'update']);
        $this->middleware('permission:Libros Eliminar')->only(['destroy']);
    }

    /**
     * Mostrar todos los libros
     */
    public function index()
    {
        $libros = Libro::with('serie')->latest()->paginate(10);
        return view('admin.libros.index', compact('libros'));
    }

    /**
     * Mostrar formulario de creación
     */
    

        public function create()
    {
        $series = Serie::where('estado', 1)
            ->orderBy('nombre', 'asc')
            ->get();

        $autores = Autor::where('estado', 1)
            ->orderBy('nombre', 'asc')
            ->get();

        $tipos = Tipo::where('estado', 1)
            ->orderBy('nombre', 'asc')
            ->get();
        
        return view('admin.libros.create', compact('series', 'autores', 'tipos'));
    }


    /**
     * Guardar un libro nuevo
     */

    public function store(LibroStoreRequest $request)
    {

    
    $data = $request->except('roles');
    $data['slug'] = Str::slug($request->titulo);

    $tipoId = (int) ($data['tipos_id'] ?? 0);

    $tipoCarpeta = match($tipoId) {
        3 => 'estudios_humanidad',
        2 => 'estudios_del_hombre',
        1 => 'revista_estudios_del_hombre',
        default => 'otros',
    };

    // Guardar imagen (ya lo tenías)
    if ($request->hasFile('imagen')) {
        $data['imagen'] = $request->file('imagen')->store("libros/$tipoCarpeta", 'public');
    }

    // NUEVO: guardar PDF si se sube
    if ($request->hasFile('pdf')) {
        $data['pdf'] = $request->file('pdf')->store("libros/$tipoCarpeta/pdf", 'public');
    }

    $libro = Libro::create($data);

    // Asociar autores y roles (sin cambios)
    if ($request->filled('roles')) {
        $attachData = [];
        foreach ($request->roles as $r) {
            $autorId = $r['autor_id'];
            if (!$autorId) continue;
            foreach ($r['roles'] as $rol) {
                $attachData[] = [
                    'autor_id' => $autorId,
                    'rol' => $rol,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        $libro->autores()->detach();
        $libro->autores()->attach($attachData);
    }

    return redirect()->route('admin.libros.index')
        ->with('success', 'Libro creado correctamente.');
    }


    /**
     * Mostrar un libro
     */
    public function show(Libro $libro)
    {
        return view('admin.libros.show', compact('libro'));
    }
    

    public function edit(Libro $libro)
    {
    $series = Serie::where('estado', 1)
        ->orderBy('nombre', 'asc')
        ->get();

    $autores = Autor::where('estado', 1)
        ->orderBy('nombre', 'asc')
        ->get();

    $tipos = Tipo::where('estado', 1)
        ->orderBy('nombre', 'asc')
        ->get();

    $libro->load('autores'); // cargar relación

    return view('admin.libros.edit', compact('libro', 'series', 'autores', 'tipos'));
    }


    /**
     * Actualizar un libro
     */
    

    public function update(LibroUpdateRequest $request, Libro $libro)
    {
    $data = $request->except('roles');
    $data['slug'] = Str::slug($request->titulo);

    // Carpeta según tipo
    $tipoCarpeta = match($data['tipos_id'] ?? null) {
        3 => 'estudios_humanidad',
        2 => 'estudios_del_hombre',
        1 => 'revista_estudios_del_hombre',
        default => 'otros',
    };

    if ($request->hasFile('imagen')) {
        // Borrar imagen anterior si existe
        if ($libro->imagen && Storage::disk('public')->exists($libro->imagen)) {
            Storage::disk('public')->delete($libro->imagen);
        }

        $data['imagen'] = $request->file('imagen')->store("libros/$tipoCarpeta", 'public');
    }

    // 📘 NUEVO: manejo del PDF
    if ($request->hasFile('pdf')) {
        // Eliminar PDF anterior si existe
        if ($libro->pdf && Storage::disk('public')->exists($libro->pdf)) {
            Storage::disk('public')->delete($libro->pdf);
        }

        $data['pdf'] = $request->file('pdf')->store("libros/$tipoCarpeta/pdf", 'public');
    }

    $libro->update($data);

    // Actualizar autores y roles
    // $libro->autores()->detach();
    // if ($request->filled('roles')) {
    //     foreach ($request->roles as $r) {
    //         $autorId = $r['autor_id'];
    //         if (!$autorId) continue;
    //         foreach ($r['roles'] as $rol) {
    //             $libro->autores()->syncWithoutDetaching([
    //                 $autorId => ['rol' => $rol, 'created_at' => now(), 'updated_at' => now()]
    //             ]);
    //         }
    //     }
    // }

    // Actualizar autores y roles
    $libro->autores()->detach();

    if ($request->filled('roles')) {
        $attachData = [];

        foreach ($request->roles as $r) {
            $autorId = $r['autor_id'];
            if (!$autorId) continue;

            foreach ($r['roles'] as $rol) {
                $attachData[$autorId . '-' . $rol] = [
                    'autor_id' => $autorId,
                    'rol' => $rol,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Attach MULTIPLE combinaciones autor–rol
        $libro->autores()->attach($attachData);
    }

    return redirect()->route('admin.libros.index')
        ->with('success', 'Libro actualizado correctamente.');
    }


    /**
     * Eliminar (soft delete) un libro
     */
    public function destroy(Libro $libro)
    {
        // Borrar imagen al eliminar
        if($libro->imagen && Storage::disk('public')->exists($libro->imagen)){
            Storage::disk('public')->delete($libro->imagen);
        }

        $libro->delete();
        return redirect()->route('admin.libros.index')
            ->with('success', 'Libro eliminado correctamente.');
    }
}
