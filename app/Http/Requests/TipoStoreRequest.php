<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cambia si necesitas control de permisos
    }

    public function rules(): array
    {
        return [
        'nombre' => 'required|max:255|unique:series,nombre',
        'descripcion' => 'nullable',
        'estado' => 'required|boolean',
    ];
    }
}
