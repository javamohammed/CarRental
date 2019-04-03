<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactHandleRequest extends FormRequest
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
            'subject' => 'required|max:255',
            'content'    => 'required|max:800',
        ];
    }
    public function messages()
    {
        return [
            'subject.required'    => trans('translate.required'),
            'content.required'    => trans('translate.required'),

            'subject.max'     => trans('translate.max_string'),
            'content.max'     => trans('translate.max_string'),
        ];

    }
}
