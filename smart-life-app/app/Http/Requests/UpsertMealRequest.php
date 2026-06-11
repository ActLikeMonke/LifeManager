<?php 
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsertMealRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'food' => 'required|array|min:1',
            'food.*.id' => 'required|exists:food,id',
            'food.*.quantity' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The meal name is required.',
            'food.required' => 'The foods field is required.',
            'food.array' => 'The foods field must be an array.',
            'food.*.id.required' => 'Each food item must have an ID.',
            'food.*.id.exists' => 'Each food ID must exist in the foods table.',
            'food.*.quantity.required' => 'Each food item must have a quantity.',
            'food.*.quantity.numeric' => 'Each food quantity must be a number.',
        ];
    }
}
