<?php

namespace App\Http\Requests\Api\Innings;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mark' => 'required|string',
            'model' => 'required|string',
            'g_v' => 'required',
            'phone' => 'required|string',
            'images' => 'image|mimes:jpeg,png,jpg|max:5048',
        ];
    }
}
