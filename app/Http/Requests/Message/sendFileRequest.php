<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class sendFileRequest extends FormRequest
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
            'file_message' => 'required|mimes:jpg,jpeg,png|max:2048',
            'to' => 'required|integer|exists:users,id',
            'proposal_id' => 'required|integer|exists:proposals,id',
        ];
    }
}
