<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'client';
    }

    public function rules(): array
    {
        return [
            'property_id' => 'required|exists:properties,id',
            'agent_id'    => 'required|exists:users,id',
            'date'        => 'required|date|after:today',
            'time'        => 'required|date_format:H:i',
            'message'     => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'date.after'  => 'La date de visite doit être dans le futur.',
            'time.date_format' => 'Format de l\'heure invalide (HH:MM attendu).',
        ];
    }
}
