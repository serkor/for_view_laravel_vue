<?php

namespace App\Http\Requests\MarkModels;

use Illuminate\Foundation\Http\FormRequest;

class MarkModelStoreRequest extends FormRequest
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
            'mark_id' => 'required',
        ];
    }
}
