<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsertMealSessionRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'meal_id' => [
                'required',
                'integer',
                'exists:meals,id',
            ],
            'eaten_at' => [
                'required',
                'date',
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ];
    }

    /**
     * Get the custom error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'meal_id.required'  => 'An associated meal is required to log an eating session.',
            'meal_id.exists'    => 'The selected meal does not exist in our database.',
            'meal_id.integer'   => 'The meal ID must be a valid integer.',
            'eaten_at.required' => 'The date and time of the eating session is required.',
            'eaten_at.date'     => 'Please provide a valid date or timestamp format for when the meal was eaten.',
            'notes.string'      => 'Timeline and session notes must be valid text.',
        ];
    }
}