<?php

namespace App\Http\Requests\BidStatuses;

use Illuminate\Foundation\Http\FormRequest;

class BidStatusUpdateRequest extends FormRequest
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
            'bid_id' => 'required',
            'status_id' => 'required',
        ];
    }
}
