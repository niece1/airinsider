<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use App\Dto\Frontend\Factories\CommentDataFactory;

class CommentRequest extends FormRequest
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
            'body' => 'bail|min:2|max:300',
        ];
    }

    /**
     * Get a valid array of data.
     *
     * @return array
     */
    public function getDto()
    {
        $factory = new CommentDataFactory();
        $dto = $factory->createDto($this);

        return [
            'body' => $dto->getBody(),
            'comment_id' => $dto->getCommentId()
        ];
    }
}
