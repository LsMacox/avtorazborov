<?php

namespace App\Http\Requests\Shop\Payment;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'tariff_id' => 'required|exists:tariffs,id',
            'time_id' => 'required|numeric|min:0|max:3'
        ];
    }
}
