<?php

namespace App\Http\Requests\Admin\MailList\Transport;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

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
            'mark' => 'required|string|exists:transport_car_marks,title',
            'model' => 'required|string|exists:transport_car_models,title',
            'year_from' => 'required|integer|y_of_i:1990,'.Carbon::now()->year,
            'year_before' => 'required|integer|y_of_i:1990,'.Carbon::now()->year
        ];
    }
}
