<?php

namespace App\Http\Requests\Admin\Synonym;

use App\Http\Requests\Api\FormRequest;

class TransportWordRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:50|unique:synonym_transport_synonyms,name'
        ];
    }
}
