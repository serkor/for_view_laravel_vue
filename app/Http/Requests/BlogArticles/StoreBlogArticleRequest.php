<?php

namespace App\Http\Requests\BlogArticles;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogArticleRequest extends FormRequest
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
            'description' => 'required',
            'blog_category_id' => 'required',
            'image' => 'mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }
}
