<?php

namespace App\Http\Requests\Admin\Synonym;

use App\Http\Requests\Api\FormRequest;

class TransportSynonymRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:50',
            'synonym_transport_name_id' => 'required|exists:synonym_transport_names,id'
        ];
    }

    public function messages()
    {
        return [
            'synonym_transport_name_id' => 'Группа слов'
        ];
    }
}
