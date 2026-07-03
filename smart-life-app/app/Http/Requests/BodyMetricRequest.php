<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BodyMetricRequest extends FormRequest
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
            'weight' => ['required', 'numeric', 'min:0.01'],
            'body_fat_percentage' => ['nullable', 'numeric', 'min:0.00', 'max:100.00'],
            'muscle_mass' => ['nullable', 'numeric', 'min:0.00', 'lt:weight'],
            'measured_at' => ['required', 'date'],
        ];
    }
}