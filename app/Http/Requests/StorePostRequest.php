<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'name' => 'required|string|max:255', // Name is required, should be a string, and max length of 255
            'price' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/', // Price should be a valid number and greater than or equal to 0
            'details' => 'required|string|mac:1000', // Details should be a string with max character 1000 and is required
            'publish' => 'required|boolean', // Publish should be either true or false (boolean)
        ];
    }
     /**
     * Get custom error messages for validation.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'price.numeric' => 'The price must be a valid number.',
            'price.min' => 'The price must be a positive number or zero.',
            'price.regex' => 'The price must be a valid number with up to two decimal places.',
            'name.required' => 'The name is required and cannot be empty.',
            'details.required' => 'Please provide details for the post.',
            'details.max' => 'Details must not exceed 1000 characters.',
        ];
    }
}
