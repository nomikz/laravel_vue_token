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
        return [
            'first_name' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'not_regex:/[0-9]+/',
            ],
            'last_name' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'not_regex:/[0-9]+/',
            ],
            'middle_name' => [
                'string',
                'nullable',
                'min:2',
                'min:255',
                'regex:/[0-9]+/',
            ],
            'iin' => [
                'required',
                'string',
                'size:12',
                'regex:/^\d+$/'
            ],
            'phone' => [
                'required',
                'string',
                'size:12',
                'regex:/^\+7\d+$/'
            ],
            'car_number' => [
                'required',
                'string',
                'min:5',
                'max:7'
            ],
            'valid_from' => [
                'required',
                'string',
                'after:yesterday',
                'date',
            ],
            'valid_until' => [
                'required',
                'string',
                'date',
                'after:valid_from',
            ],
            'additionalDrivers' => [
                'sometimes',
                'array',
            ],
            'additionalDrivers.*.first_name' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'not_regex:/[0-9]+/',
            ],
            'additionalDrivers.*.last_name' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'not_regex:/[0-9]+/',
            ],
            'additionalDrivers.*.middle_name' => [
                'string',
                'nullable',
                'min:2',
                'min:255',
                'regex:/[0-9]+/',
            ],
            'additionalDrivers.*.iin' => [
                'required',
                'string',
                'size:12',
                'regex:/^\d+$/'
            ],
        ];
    }

    // make custom messages for rules
    public function messages()
    {
        return parent::messages(); // TODO: duplicate rules text from the frontend
    }
}
