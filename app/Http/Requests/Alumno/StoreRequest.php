<?php

namespace App\Http\Requests\Alumno;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class StoreRequest extends FormRequest
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
            'nombre' => 'required|min:2',
            'apellidos' => 'required|min:2',
            'fecha_nacimiento' => 'required|date|size:10',
            'ciudad_natal' => 'sometimes|min:2',
            'escuela_id' => 'required|integer',
        ];
    }

    /**
     * Get the error messages if a validation fails.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 2 caracteres.',

            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'apellidos.min' => 'Los apellidos deben tener al menos 2 caracteres.',

            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'fecha_nacimiento.size' => 'La fecha de nacimiento debe tener un formato válido de 10 caracteres (por ejemplo, AAAA-MM-DD).',

            'ciudad_natal.required' => 'El campo ciudad es obligatorio.',
            'ciudad_natal.min' => 'La ciudad debe tener al menos 2 caracteres.', // Asegúrate de especificar un valor mínimo en tu validación, por ejemplo, 'min:2'.

            'escuela_id.required' => 'El campo identificador de la escuela es obligatorio.',
            'escuela_id.integer' => 'El identificador de la escuela debe ser un número entero.',
        ];
    }

    public function failedValidation(Validator $validator){
        if($this->expectsJson()){
            $response = new Response($validator->errors(), 422);
            throw new ValidationException($validator, $response);
        }
    }
}
