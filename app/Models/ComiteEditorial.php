<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComiteEditorial extends Model
{
    use HasFactory, SoftDeletes;

    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'comite_editorial';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'apellido',
        'dependencia',
        'pais',
        'estado',
    ];

    // Campos tratados como fechas
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
