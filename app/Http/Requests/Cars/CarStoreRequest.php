<?php

namespace App\Http\Requests\Cars;

use Illuminate\Foundation\Http\FormRequest;

class CarStoreRequest extends FormRequest
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
            'vin'=> 'required',
            'customer_id' => 'required',
            'mark_id' => 'required',
            'mark_model_id' => 'required',
            'transmission_id' => 'required',
            'year_id' => 'required',
        ];
    }
}
