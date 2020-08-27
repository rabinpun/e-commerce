<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//default is false
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()//server side validation 
    {
        return [
            'email'=>'required|email',
            'name'=>'required',
            'address'=>'required',
            'province'=>'required',
            'district'=>'required',
            'postalcode'=>'required',
            'phone'=>'required|numeric|digits:10',
        ];
    }
}
