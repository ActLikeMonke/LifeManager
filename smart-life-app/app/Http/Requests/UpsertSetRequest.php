<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsertSetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $required = $this->isMethod('patch')
            ? ['sometimes', 'required']
            : ['required'];

        return [
            'workout_session_id' => [...$required, 'integer', 'exists:workout_sessions,id'],
            'exercise_id' => [...$required, 'integer', 'exists:exercises,id'],
            'weight' => [...$required, 'numeric', 'min:0.00'],
            'reps' => [...$required, 'integer', 'min:1'],
            'rpe' => ['nullable', 'integer', 'min:1', 'max:10'],
            'pr' => ['nullable', 'numeric', 'min:0.00'],
            'is_warmup' => ['sometimes', 'boolean'],
        ];
    }
}