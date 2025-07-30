<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'service_id' => 'required|exists:services,id',
            'date' => [
                'required',
                'date', //format Y-m-d
                'after_or_equal:today', 
            ],
            'time' => 'required|date_format:H:i', //format H:i
        ];
    }
    public function messages()
    {
        return [
            'service_id.required' => 'The service ID is required.',
            'service_id.exists' => 'The selected service does not exist.',
            'date.required' => 'The booking date is required.',
            'date.date' => 'The booking date must be a valid date.',
            'date.after_or_equal' => 'The booking date must be today or in the future.',
            'time.required' => 'The booking time is required.',
            'time.date_format' => 'The booking time must be in the format HH:MM.',

        ];
    }
}
