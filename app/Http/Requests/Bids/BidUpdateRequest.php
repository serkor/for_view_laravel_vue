<?php

namespace App\Http\Requests\Bids;

use Illuminate\Foundation\Http\FormRequest;

class BidUpdateRequest extends FormRequest
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
            'id' => 'nullable',
            'text' => 'nullable',
            'customer_id' => 'nullable',
            'car_id' => 'nullable',
            'status_id' => 'nullable',
            'city_id' => 'nullable',
            'category_ids' => 'nullable',
            'description' => 'nullable',
            'desired_date' => 'nullable',
            'type' => 'nullable',
            'file' => 'nullable',
            'sum_repair' => 'nullable',
            'sum_part' => 'nullable',
//            'file' => 'nullable|max:1024|mimes:pdf,png,jpeg,gif,txt',
        ];
    }
}
