<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Relacion extends Model
{
    use Searchable;

    protected $table = 'relaciones';

    public $timestamps = false; // Las vistas NO tienen timestamps

    protected $primaryKey = 'id';

    // Campos que Scout debe buscar
    public $searchable = [
        'titulo',
        'volumen',
        'anio',
        'resumen',
        'cita',
        'isbn',
        'isbn_coleccion',
        'palabras_clave',
        'resena',
        'doi',
        'nombre',   //: nombre del autor
        'apellido'   //: apellido del autor
    ];
}
