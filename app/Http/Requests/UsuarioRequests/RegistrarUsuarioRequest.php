<?php

namespace App\Http\Requests\UsuarioRequests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrarUsuarioRequest extends FormRequest
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
            'nombre_completo' => 'required',
            'contrasenia' => 'required',
            'nombre_usuario' => 'required|unique:usuario,nombre_usuario',
            'url_foto' => 'required',
            'rol'   => 'required'
        ];
    }
}
