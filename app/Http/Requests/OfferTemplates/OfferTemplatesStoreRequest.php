<?php

namespace App\Http\Requests\OfferTemplates;

use Illuminate\Foundation\Http\FormRequest;

class OfferTemplatesStoreRequest extends FormRequest
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
            'name' => 'required',
            'executor_id' => 'required',
            'description' => 'required',
            'sum_repair' => 'required',
            'sum_part' => 'required',
            'number_hours' => 'required',
        ];
    }
}
