<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'title' => 'required|max:80',
            'frequency' => 'nullable|Numeric|max:365',
            'charges' => 'required|Numeric|max:10000000',
            'service_image' => 'nullable|image',
            'description' => 'required|max:255',
            'requirements' => 'nullable|max:100',
        ];
    }
}
