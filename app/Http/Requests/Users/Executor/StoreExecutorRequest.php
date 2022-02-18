<?php


namespace App\Http\Requests\Users\Executor;

use Illuminate\Foundation\Http\FormRequest;

class StoreExecutorRequest extends FormRequest
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
            'name' => 'nullable',
            'phone' => 'nullable',
            'email' => 'nullable',
            'city_id' => 'nullable',
            'image' => 'image',
            'show_map'=> 'nullable',
            'description'=> 'nullable',
            'work_hours'=> 'nullable',
            'year_experience'=> 'nullable',
            'company_type'=> 'nullable',
            'company_name'=> 'nullable',
            'company_address'=> 'nullable',
            'company_requisites'=> 'nullable',
            'company_contact'=> 'nullable',
            'address'=> 'nullable',
            'files'=> 'nullable',
            'verified'=> 'nullable',
        ];
    }

}
