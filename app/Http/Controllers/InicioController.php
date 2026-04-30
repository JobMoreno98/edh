<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\ComiteEditorial;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Tipo;
use App\Models\Relacion;
use Illuminate\Support\Facades\Schema;




class InicioController extends Controller
{
    public function index()
    {
        // Comité editorial activo
        $comite = ComiteEditorial::where('estado', 1)->get();

        $publicaciones = Publicacion::where('estado', 1)
            ->latest('fecha')
            ->get(); 

        // Traer los tipos para el navbar, las colecciones.
        $tipos = Tipo::orderBy('id')->get();

        return view('general.Inicio', compact('comite', 'publicaciones', 'tipos'));
    }

    public function publicacionDetalle($id)
    {
        // Obtener la publicación y asegurarse que sea una convocatoria activa
        $publicacion = Publicacion::where('estado', 1)
            ->findOrFail($id);

        return view('general.publicacion_detalle', compact('publicacion'));
    }


    public function buscar(Request $request)
    {
        $q = $request->input('q');

        if (!$q) {
            return view('general.resultados', [
                'resultados' => collect(),
                'q' => ''
            ]);
        }

        $resultados = DB::table('vista_busqueda')
            ->where(function ($query) use ($q) {
                $query->where('titulo', 'like', "%{$q}%")
                    ->orWhere('descripcion', 'like', "%{$q}%")
                    ->orWhere('nombre_autor', 'like', "%{$q}%");
            })
            ->get();

        // Ordenar resultados
        $resultados = $resultados->sortBy(function ($item) use ($q) {
            $qLower = strtolower($q);
            $tituloLower = strtolower($item->titulo ?? '');

            if ($tituloLower === $qLower) return 1;
            if (str_starts_with($tituloLower, $qLower)) return 2;
            if (str_contains($tituloLower, $qLower)) return 3;

            return 4;
        });

        return view('general.resultados', [
            'resultados' => $resultados,
            'q' => $q
        ]);
    }





    




}
