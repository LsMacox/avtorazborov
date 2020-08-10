<?php

namespace App\Http\Requests\Admin\Help;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'route' => 'required|unique:helps'
        ];
    }

    public function messages()
    {
        return [
            'route.unique' => 'Для этой страницы уже существует подсказка, вы можете ее изменить!'
        ];
    }
}
