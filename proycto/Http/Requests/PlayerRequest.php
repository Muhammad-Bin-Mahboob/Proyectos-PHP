<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'twitter' => 'required|string|regex:/^@[A-Za-z0-9_]+$/',
            'instagram' => 'required|string|regex:/^@[A-Za-z0-9_.]+$/',
            'twitch' => 'required|string|regex:/^[A-Za-z0-9_]+$/',
            'avatar' => 'nullable|image',
            'visible' => 'required|boolean',
            'position' => 'required|string|max:100',
            'age' => 'required|integer|min:10|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',

            'twitter.required' => 'El campo Twitter es obligatorio.',
            'twitter.regex' => 'El Twitter debe comenzar con @ y solo contener letras, números y guiones bajos.',

            'instagram.required' => 'El campo Instagram es obligatorio.',
            'instagram.regex' => 'El Instagram debe comenzar con @ y solo contener letras, números, puntos y guiones bajos.',

            'twitch.required' => 'El campo Twitch es obligatorio.',
            'twitch.regex' => 'El nombre de Twitch solo puede contener letras, números y guiones bajos.',

            'avatar.image' => 'El avatar debe ser una imagen.',

            'visible.required' => 'El campo Visible es obligatorio.',
            'visible.boolean' => 'El campo Visible debe ser verdadero o falso.',

            'position.required' => 'El campo Posición es obligatorio.',
            'position.string' => 'La Posición debe ser una cadena de texto.',
            'position.max' => 'La Posición no puede tener más de 100 caracteres.',

            'age.required' => 'El campo Edad es obligatorio.',
            'age.integer' => 'La Edad debe ser un número entero.',
            'age.min' => 'La Edad mínima permitida es 10 años.',
            'age.max' => 'La Edad máxima permitida es 100 años.',
        ];
    }
}
