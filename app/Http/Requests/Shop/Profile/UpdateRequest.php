<?php

namespace App\Http\Requests\Shop\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:20',
            'city' => 'required|string',
            'address' => 'required|string|min:6|max:30',
            'email' => 'required|email',
            'phone' => 'required|string|min:11|max:20',
            'avatar' => 'file|image:jpeg,png|max:1000|dimensions:min_width=300,min_height=300,max_width=300,max_height=300',
            'gallery-images[]' => 'image:jpeg,png',
            'description' => 'required|string|min:6,max:130',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Название',
            'avatar' => 'Логотип',
            'gallery-images[]' => 'Галерея',
            'address' => 'Адрес',
            'phone' => 'Городской телефон'
        ];
    }

}
