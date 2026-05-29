<?php 
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class UpsertFoodRequest extends FormRequest
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
            'calories' => 'required|numeric',
            'protein' => 'required|numeric',
            'carbs' => 'required|numeric',
            'fats' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The food name is required.',
            'calories.required' => 'The calories field is required.',
            'protein.required' => 'The protein field is required.',
            'carbs.required' => 'The carbs field is required.',
            'fats.required' => 'The fats field is required.',
        ];
    }
}