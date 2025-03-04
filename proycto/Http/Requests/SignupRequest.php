<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class SignupRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'min:10', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'birthday' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'El usuario ya existe en el sistema.',
            'name.required' => 'El nombre de usuario es obligatorio.',
            'name.min' => 'El nombre de usuario debe tener como mínimo 3 caracteres.',
            'name.max' => 'El nombre de usuario debe tener como máximo 255 caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.unique' => 'El email ya existe en el sistema.',
            'email.min' => 'El email debe tener como mínimo 10 caracteres.',
            'email.max' => 'El email debe tener como máximo 255 caracteres.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener como mínimo 8 caracteres.',
            'birthday.required' => 'El birthday es obligatorio.',
        ];
    }
}
