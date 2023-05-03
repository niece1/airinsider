<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use App\Dto\Frontend\Factories\ContactFormDataFactory;

class ContactFormRequest extends FormRequest
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
            'name' => 'bail|required|min:2',
            'email' => 'bail|required|email',
            'message' => 'required|max:500',
        ];
    }

    /**
     * Get a valid array of data.
     *
     * @return array
     */
    public function getDto()
    {
        $factory = new ContactFormDataFactory();
        $dto = $factory->createDto($this);

        return [
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'message' => $dto->getMessage()
        ];
    }
}
