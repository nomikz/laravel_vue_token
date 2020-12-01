<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsurancePolicyCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [ // TODO: duplicate rules from frontend
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'middle_name' => 'string|nullable',
            'iin' => 'required|string|size:12',
            'phone' => 'required|string|size:12',
            'car_number' => 'required|string|min:5|max:7',
            'valid_from' => 'required|string',
            'valid_until' => 'required|string',
            'additionalDrivers' => 'array',
        ];
    }

    // make custom messages for rules
    public function messages()
    {
        return parent::messages(); // TODO: duplicate rules text from the frontend
    }
}
