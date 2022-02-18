<?php

namespace App\Http\Requests\Users\Executor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExecutorAccountRequest extends FormRequest
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
            'phone' => 'required',
            'email' => 'required',
            'city_id' => 'required',
            'image' => 'image',
            'show_map'=> 'nullable',
            'description'=> 'nullable',
            'work_hours'=> 'nullable',
            'year_experience'=> 'nullable',
            'company_type'=> 'required',
            'company_name'=> 'required',
            'company_address'=> 'required',
            'company_requisites'=> 'required',
            'company_contact'=> 'nullable',
            'address'=> 'nullable',
            'files'=> 'nullable',
            'category_ids'=> 'nullable',
            'payment_type_ids'=> 'nullable',
            'additional_service_ids'=> 'nullable',
        ];
    }
}
