<?php

namespace App\Http\Requests;

use App\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
            'title' => [
                'required',
                Rule::unique('posts', 'title')->ignore($post->id),
            ],
            'body' => 'required',
            'time_to_read' => 'required',
            'photo_source' => 'max:200',
            'published' => '',
            'category_id' => 'required',
            'image' => 'sometimes|file|mimes:jpeg,png|max:5000',
        ];
    }
}
