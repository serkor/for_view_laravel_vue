<?php

namespace App\Http\Requests\Offers;

use Illuminate\Foundation\Http\FormRequest;

class OffersStoreRequest extends FormRequest
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
            'executor_id' => 'required',
            'bid_id' => 'required',
            'description' => 'required',
            'sum_repair' => 'required',
            'sum_part' => 'required',
            'number_hours' => 'required',
            'renovation_date' => 'required',
            'select' => 'required',
        ];
    }
}
