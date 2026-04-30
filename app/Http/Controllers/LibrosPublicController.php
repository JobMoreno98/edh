<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class LibrosPublicController extends Controller
{

    public function index($tipo)
{
    // Buscar el tipo por id del tipo (colección)
    $tipoSeleccionado = \App\Models\Tipo::findOrFail($tipo);

    // Filtrar libros de ese tipo y activos
    $libros = \App\Models\Libro::where('tipos_id', $tipoSeleccionado->id)
                                ->where('estado', 1) // solo activos
                                ->get();

    return view('general.coleccion', compact('libros', 'tipoSeleccionado'));
}



public function show($id)
{
    // Cargar el libro con sus relaciones, aplicando el filtro
    // de estado a cada relación que deba ser filtrada.
    $libro = Libro::where('estado', 1)
                  ->with(['autores' => function ($query) {
                      $query->where('estado', 1);
                  }, 'serie', 'tipo', 'capitulos' => function ($query) {
                      $query->where('estado', 1)
                            ->with(['autores' => function ($query) {
                                $query->where('estado', 1);
                            }]);
                  }])
                  ->findOrFail($id);

    return view('general.detalle', compact('libro'));
}


}
