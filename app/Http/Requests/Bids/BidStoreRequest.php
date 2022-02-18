<?php

namespace App\Http\Requests\Bids;

use Illuminate\Foundation\Http\FormRequest;

class BidStoreRequest extends FormRequest
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
            'customer_id' => 'required',
            'executor_id' => 'nullable',
            'car_id' => 'required',
            'status_id' => 'required',
            'city_id' => 'required',
            'category_ids' => 'required',
            'description' => 'required',
            'desired_date' => 'required',
            'type' => 'nullable',
            'file' => 'nullable',
            'sum_repair' => 'nullable',
            'sum_part' => 'nullable',
//            'file' => 'nullable|max:1024|mimes:pdf,png,jpeg,gif,txt',
        ];
    }
}
