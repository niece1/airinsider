<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use App\Dto\Dashboard\Factories\RoleDataFactory;

class RoleRequest extends FormRequest
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
            'title' => 'bail|required|min:2|max:30',
        ];
    }

    /**
     * Get a valid array of data.
     *
     * @return array
     */
    public function getDto(): array
    {
        $factory = new RoleDataFactory();
        $dto = $factory->createDto($this);

        return [
            'title' => $dto->getTitle()
        ];
    }
}
