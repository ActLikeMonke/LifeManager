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
            'foods' => 'required|array|min:1',
            'foods.*.id' => 'required|exists:food,id',
            'foods.*.quantity' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The meal name is required.',
            'foods.required' => 'The food field is required.',
            'foods.array' => 'The food field must be an array.',
            'foods.*.id.required' => 'Each food item must have an ID.',
            'foods.*.id.exists' => 'Each food ID must exist in the foods table.',
            'foods.*.quantity.required' => 'Each food item must have a quantity.',
            'foods.*.quantity.numeric' => 'Each food quantity must be a number.',
        ];
    }
}
