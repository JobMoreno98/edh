<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PublicacionStoreRequest;
use App\Http\Requests\PublicacionUpdateRequest;

class PublicacionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:Publicaciones Crear')->only(['create', 'store']);
        $this->middleware('permission:Publicaciones Editar')->only(['edit', 'update']);
        $this->middleware('permission:Publicaciones Eliminar')->only(['destroy']);
    }

    /**
     * Mostrar todas las publicaciones.
     */
    public function index()
    {
        $publicaciones = Publicacion::latest()->paginate(10);
        return view('admin.publicaciones.index', compact('publicaciones'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        return view('admin.publicaciones.create');
    }

    /**
     * Guardar una publicación nueva.
     */
    public function store(PublicacionStoreRequest $request)
    {
        $data = $request->validated();

        // Definir carpeta según tipo
        $tipoCarpeta = match($data['tipo'] ?? null) {
            'convocatoria' => 'convocatoria',
            'evento' => 'evento',
            'noticia' => 'noticia',
            default => 'otros',
        };

        // Manejo de imagen
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store("publicaciones/$tipoCarpeta", 'public');
        }

        Publicacion::create($data);

        return redirect()->route('admin.publicaciones.index')
            ->with('success', 'Publicación creada correctamente.');
    }

    /**
     * Mostrar una publicación.
     */
    public function show(Publicacion $publicacione)
    {
        return view('admin.publicaciones.show', compact('publicacione'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Publicacion $publicacione)
    {
        return view('admin.publicaciones.edit', compact('publicacione'));
    }

    /**
     * Actualizar una publicación.
     */



public function update(PublicacionUpdateRequest $request, Publicacion $publicacione)
{
    $data = $request->validated();

    // Carpeta según tipo
    $tipoCarpeta = match($data['tipo'] ?? null) {
        'convocatoria' => 'convocatoria',
        'evento' => 'evento',
        'noticia' => 'noticia',
        default => 'otros',
    };

    // Borrar imagen si marcó eliminar
    if ($request->has('eliminar_imagen') && $publicacione->imagen && Storage::disk('public')->exists($publicacione->imagen)) {
        Storage::disk('public')->delete($publicacione->imagen);
        $data['imagen'] = null;
    }

    // Borrar fecha si marcó eliminar
    if ($request->has('eliminar_fecha')) {
        $data['fecha'] = null;
    }

    // Manejo de imagen (reemplazo si se sube nueva)
    if ($request->hasFile('imagen')) {
        if ($publicacione->imagen && Storage::disk('public')->exists($publicacione->imagen)) {
            Storage::disk('public')->delete($publicacione->imagen);
        }
        $data['imagen'] = $request->file('imagen')->store("publicaciones/$tipoCarpeta", 'public');
    }

    $publicacione->update($data);

    return redirect()->route('admin.publicaciones.index')
        ->with('success', 'Publicación actualizada correctamente.');
}


    /**
     * Eliminar (soft delete) una publicación.
     */
    public function destroy(Publicacion $publicacione)
    {
        // Borrar imagen al eliminar
        if ($publicacione->imagen && Storage::disk('public')->exists($publicacione->imagen)) {
            Storage::disk('public')->delete($publicacione->imagen);
        }

        $publicacione->delete();

        return redirect()->route('admin.publicaciones.index')
            ->with('success', 'Publicación eliminada correctamente.');
    }
}
