<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
            'files' => 'required|image|mimes:jpeg,jpg,png,gif'
        ];
    }
    public function messages()
    {

        return [
                'file.required'    => 'mmmmmmm', //trans('translate.required'),
            'file.image'    => 'ssss', //trans('translate.required'),
            'file.mimes'    => 'ededededed',//trans('translate.required'),
            ];
    }
}
