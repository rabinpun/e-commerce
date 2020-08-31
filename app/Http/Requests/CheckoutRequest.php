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
        $emailValidation = auth()->user() ? 'required|email' : 'required|email|unique:users';//if user is not logged in and tries to checkout as a guest and uses a register email results error(email already exist)//but we change it with custom message to fit the purpose
        return [
            'email'=>$emailValidation,
            'username'=>'required',
            'address'=>'required',
            'province'=>'required',
            'district'=>'required',
            'postalcode'=>'required',
            'phone'=>'required|numeric|digits:10',
        ];
    }
    public function messages()
    {
        return[
            'email.unique'=>'You have already an account with this email.<a class="btn btn-primary" href="/checkout"> Login<a> with your account.',
        ];
    }
}
