<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class AutorStoreRequest extends FormRequest
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
    //     return [
    //         //
    //     ];
    // }

//     public function rules(): array
// {
//     return [
//         'nombre' => ['required', 'max:100'],
//         'apellido' => [
//             'required',
//             'max:100',
//             Rule::unique('autores')
//                 ->where(fn($query) => $query->where('nombre', $this->nombre))
//                 ->ignore($this->route('autor')), // para update (opcional)
//         ],
//         'estado' => 'required|boolean',
//     ];
// }

public function rules(): array
{
    return [
        'nombre' => ['required', 'max:100'],
        'apellido' => [
            'required',
            'max:100',
            Rule::unique('autores')
                ->where(fn($query) =>
                    $query->where('nombre', $this->nombre)
                          ->whereNull('deleted_at') // 👈 ignora los eliminados
                )
                ->ignore($this->route('autor')), // ignora el actual al editar
        ],
        'estado' => 'required|boolean',
    ];
}

public function messages(): array
{
    return [
        'nombre.required' => 'El nombre es obligatorio.',
        'apellido.required' => 'El apellido es obligatorio.',
        'apellido.unique' => 'Ya existe un autor con ese nombre completo.',
        'estado.boolean' => 'Se debe seleccionar el estado.',
    ];
}
}
