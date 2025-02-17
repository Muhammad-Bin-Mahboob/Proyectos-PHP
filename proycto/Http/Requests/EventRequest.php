<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'name' => 'required|max:30',
            'description' => 'required',
            'location' => 'required',
            'date' => 'required|date',
            'hour' => 'required',
            'type' => 'required|in:official,exhibition,charity',
            'tags' => 'required|string',
            'visible' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del evento es obligatorio.',
            'name.max' => 'El nombre del evento no puede superar los 30 caracteres.',

            'description.required' => 'La descripción del evento es obligatoria.',
            'location.required' => 'La ubicación del evento es obligatoria.',

            'date.required' => 'La fecha del evento es obligatoria.',
            'date.date' => 'La fecha debe ser una fecha válida.',

            'hour.required' => 'La hora del evento es obligatoria.',

            'type.required' => 'El tipo de evento es obligatorio.',
            'type.in' => 'El tipo de evento debe ser uno de los siguientes: oficial, exhibición, caridad.',

            'tags.required' => 'Las etiquetas son obligatorios.',
            'tags.string' => 'Las etiquetas deben ser una cadena de texto.',

            'visible.required' => 'La visibilidad del evento es obligatoria.',
            'visible.boolean' => 'La visibilidad debe ser un valor booleano (true o false).',
        ];
    }
}
