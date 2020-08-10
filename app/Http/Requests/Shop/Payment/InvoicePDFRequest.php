<?php

namespace App\Http\Requests\Shop\Payment;

use Illuminate\Foundation\Http\FormRequest;

class InvoicePDFRequest extends FormRequest
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
            'email' => 'required|email',
            'name' => 'required|string|min:3|max:255',
            'phone' => 'required|string',
            'address' => 'required|string|min:5|max:255',
            'inn' => 'required|numeric|digits_between:9,12',
            'kpp' => 'required|numeric|digits_between:9,12',
            'ogrn' => 'numeric|digits_between:12,15',
            'tariff_id' => 'required|exists:tariffs,id|numeric|min:1',
            'time_id' => 'required|numeric|min:0|max:3'
        ];
    }
}
