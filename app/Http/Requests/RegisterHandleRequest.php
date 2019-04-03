<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterHandleRequest extends FormRequest
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
        //dd($this->path());
        $email_rules = $this->path() === 'update' ? 'required|string|email|max:255' : 'required|string|email|max:255|unique:users';
        if( $this->path() === 'change_password'){
            return [
                'password' => 'required|string|min:8|confirmed',
            ];
        }else{
            return [
                        //
                        'email' => $email_rules,
                        'firstname' => 'required|string|max:255',
                        'lastname' => 'required|string|max:255',
                        'password' => 'required|string|min:8|confirmed',
                    ];
        }
    }
    public function messages()
    {
        return [
            //required
            'email.required'    => trans('translate.required'),
            'firstname.required'    => trans('translate.required'),
            'lastname.required'    => trans('translate.required'),
            'password.required'    => trans( 'translate.required'),

            //max
            'firstname.max'     => trans( 'translate.max_string'),
            'lastname.max'     => trans( 'translate.max_string'),
            'email.max'     => trans( 'translate.max_string'),

            //string
            'email.string'    => trans( 'translate.string_value'),
            'firstname.string'    => trans( 'translate.string_value'),
            'lastname.string'    => trans( 'translate.string_value'),
            'password.string'    => trans( 'translate.string_value'),

            //password
            'password.confirmed' => trans('translate.password_valid'),
            'password.string' => trans('translate.password_valid'),
            'password.required' => trans('translate.password_valid'),
            'password.min' => trans( 'translate.password_valid'),

            //email
            'email.email'       => trans( 'translate.email_valid'),
            'email.unique'      => trans('translate.unique')
        ];
    }
}
