<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
        //dd(session()->getOldInput());
        //dd(request()->input( 'model_id'));
        return [
            'color'                 => 'required',
            //'available'             => 'required',
            'description'           => 'required|min:10|max:500',
            'purchaseDate'          => 'required|date',
            'model_id'              => 'exists:car_models,id',
            'registration_number'   => 'required',
            'number_places'         => 'required|integer',
            'type_car'              => 'required|in:diesel,gasoline,electric',
            'number_cylinder'       => 'required|integer'
        ];
    }
    public function message(){
        return [
            'color.required'    => trans('translate.required'),
            //'available.required'    => trans('translate.required'),
            'description.required'    => trans('translate.required'),
            'purchaseDate.required'    => trans('translate.required'),
            'model_id.required'    => trans('translate.required'),
            'registration_number.required'    => trans('translate.required'),
            'number_places.required'    => trans('translate.required'),
            'type_car.required'    => trans('translate.required'),
            'number_cylinder.required'    => trans('translate.required'),

            //max
            'description.max'     => trans('translate.max_string'),

            //min
            'description.min'     => trans('translate.min_string'),

            //numeric
            'model_id.integer' => trans('translate.integer'),
            'number_places.integer' => trans('translate.integer'),
            'number_cylinder.integer' => trans('translate.integer'),

            //date
            'purchaseDate.date' => trans('translate.date'),

            //exists
            'model_id.exists' => trans( 'translate.exists'),

            //in
            'type_car.in' => trans('translate.in'),



        ];
    }
}
