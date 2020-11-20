<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Company;

class CompanyRequest extends FormRequest
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
            'name' =>'bail|required|string|max:40',
            'address'=>'required|string|min:3',
            'email'=>'required|email|max:255',
            'logo' => 'nullable|mimes:jpeg,png,jpg|max:5000',
            'ceo_id'=>'required|exists:c_e_o_s,id',
        ];
    }



    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'email.required' => 'Email is required!',
            'logo.required' => 'logo is required!',
            'ceo_id.exists' => 'Not an existing ID',
            
        ];
    }
}
