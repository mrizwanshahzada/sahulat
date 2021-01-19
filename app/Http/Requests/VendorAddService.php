<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorAddService extends FormRequest
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
            'title' => 'required|string|max:50',
            'charges' => 'required|string|max:50',
            'description' => 'required|string|max:50',
            

        ];
    }


       public function messages() 
    {
        return [
            'required' => 'Please enter the :attribute',
        ];
    }

}
