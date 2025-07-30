<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required',
            'status' => 'sometimes|boolean', // Optional field with specific values
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The service name is required.',
            'name.string' => 'The service name must be a string.',
            'name.max' => 'The service name may not be greater than 255 characters.',
            
            'description.required' => 'The service description is required.',
            'price.required' => 'The service price is required.',
            'status.in' => 'The status must be either 1 or 0.',
        ];
    }
}
