<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterEmployeeRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'phone' => 'required|unique:users|Numeric|max:9999999999999',
            'address' => 'required|string|max:100',
            'gender' => 'required',
            'salary' => 'required|Numeric|max:10000000',
            'email' => 'required|unique:users|email',
        ];
    }
}
