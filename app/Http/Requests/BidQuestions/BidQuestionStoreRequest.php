<?php

namespace App\Http\Requests\BidQuestions;

use Illuminate\Foundation\Http\FormRequest;

class BidQuestionStoreRequest extends FormRequest
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
            'customer_id' => 'nullable',
            'executor_id' => 'nullable',
            'bid_id' => 'nullable',
            'text' => 'nullable',
            'type' => 'nullable',
        ];
    }
}
