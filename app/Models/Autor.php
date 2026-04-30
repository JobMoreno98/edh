<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Autor extends Model
{
    use HasFactory, SoftDeletes;

    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'autores';

    // public $timestamps = false;  // al final si puse los timestaps

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'apellido',
        'estado',
    ];

    // Campos tratados como fechas
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Relación con libros (tabla pivote libro_autor)
     */
    public function libros()
    {
        return $this->belongsToMany(Libro::class, 'libro_autor')
                    ->withPivot('rol')
                    ->withTimestamps();
    }

    /**
     * Relación muchos a muchos con Capitulo
     */
    public function capitulos()
    {
        return $this->belongsToMany(Capitulo::class, 'capitulo_autor')
                    ->withTimestamps();
    }

    

}
