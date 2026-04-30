<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CapituloStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [
            'libro_id'      => 'required|exists:libros,id',
            'nombre'        => 'required|max:255',
            'descripcion'   => 'nullable',
            'autores'       => 'nullable|array',
            'autores.*'     => 'exists:autores,id',
            'cita_articulo' => 'nullable',
            'estado'        => 'required|boolean',
        ];
    }
}
