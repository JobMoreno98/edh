<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipo extends Model
{
    use HasFactory, SoftDeletes;

    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'tipos';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    // Campos tratados como fechas
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Relación con libros (una serie tiene muchos libros)
     */
    public function libros()
    {
        return $this->hasMany(Libro::class, 'tipos_id');
    }
}
