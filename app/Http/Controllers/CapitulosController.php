<?php

namespace App\Http\Controllers;

use App\Models\Capitulo;
use App\Models\Libro;
use App\Models\Autor;
use Illuminate\Http\Request;
use App\Http\Requests\CapituloStoreRequest;
use App\Http\Requests\CapituloUpdateRequest;

class CapitulosController extends Controller
{
    public function index()
    {
        $capitulos = Capitulo::with(['libro','autores'])->latest()->paginate(10);
        return view('admin.capitulos.index', compact('capitulos'));
    }

    public function create()
    {
        $libros = Libro::where('estado',1)
                    ->orderBy('id', 'desc') // el último añadido primero
                    ->get();
        $autores = Autor::where('estado',1)
                    ->orderBy('nombre', 'asc') // alfabético
                    ->get();

        return view('admin.capitulos.create', compact('libros','autores'));
    }


    public function store(CapituloStoreRequest $request)
    {
        $capitulo = Capitulo::create($request->only('libro_id','nombre','descripcion','cita_articulo','estado'));

        if ($request->filled('autores')) {
            $capitulo->autores()->sync($request->autores);
        }

        return redirect()->route('admin.capitulos.index')
            ->with('success','Capítulo creado correctamente.');
    }

    public function show(Capitulo $capitulo)
    {
        $capitulo->load(['libro','autores']);
        return view('admin.capitulos.show', compact('capitulo'));
    }

    public function edit(Capitulo $capitulo)
    {
        $libros = Libro::where('estado',1)
                    ->orderBy('id', 'desc') // el último añadido primero
                    ->get();
        
        $autores = Autor::where('estado',1)
                    ->orderBy('nombre', 'asc') // alfabético
                    ->get();
        $capitulo->load('autores');
        return view('admin.capitulos.edit', compact('capitulo','libros','autores'));
    }

    public function update(CapituloUpdateRequest $request, Capitulo $capitulo)
    {
        $capitulo->update($request->only('libro_id','nombre','descripcion','cita_articulo','estado'));

        if ($request->filled('autores')) {
            $capitulo->autores()->sync($request->autores);
        } else {
            $capitulo->autores()->sync([]);
        }

        return redirect()->route('admin.capitulos.index')
            ->with('success','Capítulo actualizado correctamente.');
    }

    public function destroy(Capitulo $capitulo)
    {
        $capitulo->delete();
        return redirect()->route('admin.capitulos.index')->with('success','Capítulo eliminado correctamente.');
    }
}
