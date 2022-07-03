<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'bail|required|min:2|unique:posts,title',
            'body' => 'required',
            'description' => 'required|max:800',
            'time_to_read' => 'required',
            'photo_source' => 'max:200',
            'published' => '',
            'category_id' => 'required',
            'publish_time' => 'required_if:published,1',
            'image' => 'sometimes|file|mimes:jpg,jpeg,png,webp|max:5000',
        ];
    }
}
