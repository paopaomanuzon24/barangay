<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermitTypeStoreRequest extends FormRequest
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
            'permit_name' => 'required|string'
        ];
    }

   /*  public function messages(){
        return [
            'permit_name.required' => 'Permit Name field is required'
        ];
    } */
}
