<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

// class Post extends Model
// {
//     use Searchable;
// }

class Libro extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'libros';

    //protected $appends = ['autores'];

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'titulo',
        'slug',
        'volumen',
        'anio',
        'resumen',
        'cita',
        'isbn',
        'isbn_coleccion',
        'palabras_clave',
        'resena',
        'doi',
        'pdf',
        'imagen',
        'estado',
        'series_id',
        'tipos_id',
        
    ];

    /**
     * Campos que se indexarán en Meilisearch.
     */
    public function toSearchableArray()
    {
        
        return [
            'titulo' => $this->titulo,
            'volumen' => $this->volumen,
            'anio' => $this->anio,
            'resumen' => $this->resumen,
            'cita' => $this->cita,
            'isbn' => $this->isbn,
            'isbn_coleccion' => $this->isbn_coleccion,
            'palabras_clave' => $this->palabras_clave,
            // Aquí indexamos todos los nombres de autores
            'autores' => $this->autores->pluck('nombre')->toArray(),
            // 'autor' => $this->autor,
            'doi' => $this->doi,
        ];
    }

    // Campos tratados como fechas
    protected $dates = [
        'anio',        // si quieres manejar el año como fecha
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Relación con autores (muchos a muchos)
     */
    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'libro_autor')
                    ->withPivot('rol')
                    ->withTimestamps();
    }

    

    /**
     * Relación con series (muchos a uno)
     */
    public function serie()
    {
        return $this->belongsTo(Serie::class, 'series_id');
    }

    public function capitulos()
    {
        return $this->hasMany(Capitulo::class, 'libro_id');
    }

    public function tipo()
{
    return $this->belongsTo(Tipo::class, 'tipos_id'); 
    // 'tipos_id' es la columna en libros que referencia a tipos.id
}




    
}
