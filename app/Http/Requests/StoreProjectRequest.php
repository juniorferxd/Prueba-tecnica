<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'name' => 'required|string|unique:projects,name|min:3|max:100',
        'description' => 'nullable|string',
        'status' => 'required|in:active,inactive',
    ];
}

public function messages(): array
{
    return [
        'name.required' => 'El nombre del proyecto es obligatorio.',
        'name.unique' => 'Este nombre ya está en uso.',
        'status.in' => 'El estado debe ser active o inactive.',
    ];
}

}
