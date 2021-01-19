<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class VendorRegisterRequest extends FormRequest
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
            //
            'name' => 'required|string|max:50',
            'phone' => 'required|unique:users|Numeric|max:9999999999999',
            'address' => 'required|string|max:100',
            'gender' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'confirm-password' => 'required',
            'account_number' => 'required',
            'title' => 'required',
            'description' => 'required',
            'charges' => 'required',
            'lat' => 'required',
            'long' => 'required',

        ];
    }

        public function messages()
    {
        return [
            'required' => 'Please enter the :attribute',
            'gender.required' => 'Please select the :attribute',
            
        ];
    }
}
