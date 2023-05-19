<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use App\Dto\Dashboard\Factories\PostDataFactory;

class PostRequest extends FormRequest
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
            'body' => 'required',
            'description' => 'required|max:800',
            'time_to_read' => 'required',
            'photo_source' => 'max:200',
            'published' => '',
            'category_id' => 'required',
            'publish_time' => 'required_if:published,1',
        ] +
        ($this->getMethod() == 'POST' ? $this->store() : $this->update());
    }

    /**
     * Get the validation rules for the POST request.
     *
     * @return array
     */
    public function store()
    {
        return [
            'title' => 'bail|required|min:2|unique:posts,title'
        ];
    }

    /**
     * Get the validation rules for the PUT/PATCH request.
     *
     * @return array
     */
    public function update()
    {
        return [
            'title' => 'required|unique:posts,title,' . request()->route('post')->id
        ];
    }

    /**
     * Get a valid array of data.
     *
     * @return array
     */
    public function getDto()
    {
        $factory = new PostDataFactory();
        $dto = $factory->createDto($this);

        return [
            'title' => $dto->getTitle(),
            'body' => $dto->getBody(),
            'description' => $dto->getDescription(),
            'time_to_read' => $dto->getTimeToRead(),
            'photo_source' => $dto->getPhotoSource(),
            'published' => $dto->getPublished(),
            'category_id' => $dto->getCategoryId(),
            'publish_time' => $dto->getPublishTime(),
        ];
    }
}
