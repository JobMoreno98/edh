<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LibroAutor extends Pivot
{
    // Nombre de la tabla pivote
    protected $table = 'libro_autor';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'libro_id',
        'autor_id',
        'rol',
    ];

    /**
     * Relación con Libro
     */
    public function libros()
    {
        return $this->belongsTo(Libro::class, 'libro_id');
    }

    /**
     * Relación con Autor
     */
    public function autores()
    {
        return $this->belongsTo(Autor::class, 'autor_id');
    }
}
