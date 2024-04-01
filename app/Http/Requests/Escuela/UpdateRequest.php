<?php

namespace App\Http\Requests\Escuela;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class UpdateRequest extends FormRequest
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
            'nombre' => 'required|min:8|max:255',
            'direccion' => 'required|min:8|max:255',
            'logotipo' => 'sometimes|image|max:2048|dimensions:max_width=200,max_height=200',
            'email' => 'sometimes|min:8',
            'telefono' => 'sometimes|integer',
            'web' => 'sometimes|min:5|max:255',
        ];
    }

    /**
     * Get the error messages if a validation fails.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 8 caracteres.',
            'nombre.max' => 'El nombre no debe superar los 255 caracteres.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'direccion.min' => 'La dirección debe tener al menos 8 caracteres.',
            'direccion.max' => 'La dirección no debe superar los 255 caracteres.',
            'logotipo.image' => 'El logotipo debe ser una imagen válida.',
            'logotipo.max' => 'El logotipo no debe exceder los 2MB.',
            'logotipo.dimensions' => 'Las dimensiones del logotipo no son correctas.',
            'email.min' => 'El correo electrónico debe tener al menos 8 caracteres.',
            'telefono.integer' => 'El teléfono debe ser un número entero sin espacios ni caracteres especiales.',
            'web.min' => 'La página web debe tener al menos 5 caracteres.',
            'web.max' => 'La página web no debe superar los 255 caracteres.',
        ];
    }

    public function failedValidation(Validator $validator){
        if($this->expectsJson()){
            $response = new Response($validator->errors(), 422);
            throw new ValidationException($validator, $response);
        }
    }
}
