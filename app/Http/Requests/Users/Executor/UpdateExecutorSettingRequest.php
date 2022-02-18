<?php

namespace App\Http\Requests\Users\Executor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExecutorSettingRequest extends FormRequest
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
            'show_profile' => 'nullable',
            'get_email' => 'nullable',
            'password' => 'nullable',
            'password_confirmation' => 'nullable',
        ];
    }
}
