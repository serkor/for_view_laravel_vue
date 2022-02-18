<?php

namespace App\Http\Requests\Appeals;

use Illuminate\Foundation\Http\FormRequest;

class AppealUpdateRequest extends FormRequest
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
            'email' => 'required',
            'description' => 'required',
            'status_id' => 'required',
        ];
    }
}