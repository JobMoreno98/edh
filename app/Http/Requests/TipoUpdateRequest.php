<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cambia si necesitas control de permisos
    }

    public function rules(): array
    {
        return [
        'nombre' => 'required|max:255|unique:series,nombre,', // $this->serie->id,
        'descripcion' => 'nullable',
        'estado' => 'required|boolean',
    ];
    }
}
