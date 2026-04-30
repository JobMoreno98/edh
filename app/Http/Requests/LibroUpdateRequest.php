<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LibroUpdateRequest extends FormRequest
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
    // public function rules(): array
    // {
    //     // El id del libro actual se pasa en la ruta gracias al Route Model Binding
    //     $libroId = $this->route('libro')->id ?? null;

    //     return [
    //         'titulo'          => 'required|max:255|unique:libros,titulo,' . $libroId,
    //         'volumen'         => 'nullable|max:50',
    //         'anio'            => 'nullable|digits:4|integer',
    //         'resumen'         => 'nullable',
    //         'cita'            => 'nullable',
    //         'isbn'            => 'nullable|max:20',
    //         'isbn_coleccion'  => 'nullable|max:20',
    //         'palabras_clave'  => 'nullable',
    //         'resena'          => 'nullable',
    //         'documento'       => 'nullable',
    //         'pdf'             => 'nullable',
    //         'estado'          => 'required|boolean',
    //         'series_id'       => 'nullable|exists:series,id',
    //         'tipos_id'         => 'required|in:7,8,9',
    //         'imagen'          => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
    //         'roles'           => 'nullable|array',
    //     ];
    // }
    

    public function rules(): array
{
    $libroId = $this->route('libro')->id ?? null; // null si es store

    return [
        'titulo' => [
            'required',
            'max:255',
            Rule::unique('libros')
                ->where(fn($query) => $query->whereNull('deleted_at'))
                ->ignore($libroId),
        ],
         'slug' => [
             
             'max:255',
             Rule::unique('libros')
                 ->where(fn($query) => $query->whereNull('deleted_at'))
                 ->ignore($libroId),
         ],
        // ... el resto de campos
        'volumen'         => 'nullable|max:50',
        'anio'            => 'nullable|digits:4|integer',
        'resumen'         => 'nullable',
        'cita'            => 'nullable',
        'isbn'            => 'nullable|max:20',
        'isbn_coleccion'  => 'nullable|max:20',
        'palabras_clave'  => 'nullable',
        'doi'             => 'nullable',
        'resena'          => 'nullable',
        'documento'       => 'nullable',
        'pdf'             => 'nullable',
        'estado'          => 'required|boolean',
        'series_id'       => 'nullable|exists:series,id',
        'tipos_id'         => 'required',
        'imagen'          => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        'roles'           => 'nullable|array',
    ];
}

    public function messages(): array
    {
        return [
            'titulo.unique' => 'Ya existe un libro con ese título.',
            'tipos_id' => 'Es necesario seleccionar una colección.',
            'pdf' => 'Es obigatorio subir el PDF del libro.',

        ];
    }
}
