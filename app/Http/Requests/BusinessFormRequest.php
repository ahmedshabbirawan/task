<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessFormRequest extends FormRequest
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
    public function rules(){
        
        $rules['name']        =  'required';
        $rules['address']    =  'required';
        $rules['lat']    =  'required';
        $rules['lng']    =  'required';

        return $rules;
    }
}
