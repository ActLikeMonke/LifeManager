<?php 
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsertMealRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // You can add your authorization logic here
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'foods' => 'required|array',
            'foods.*.id' => 'required|exists:foods,id',
            'foods.*.quantity' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The meal name is required.',
            'foods.required' => 'The foods field is required.',
            'foods.array' => 'The foods field must be an array.',
            'foods.*.id.required' => 'Each food item must have an ID.',
            'foods.*.id.exists' => 'Each food ID must exist in the foods table.',
            'foods.*.quantity.required' => 'Each food item must have a quantity.',
            'foods.*.quantity.numeric' => 'Each food quantity must be a number.',
        ];
    }
}