<?php

namespace App\Http\Requests\Admin\Proposal;

use Carbon\Carbon;
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
            'mark' => 'required|exists:transport_car_marks,title',
            'model' => 'required|exists:transport_car_models,title',
            'year_of_issue' => 'required|integer|y_of_i:1990,'.Carbon::now()->year,
            'engine_number' => 'required|string|min:5|max:40',
            'vin' => 'required|string|min:7|max:25',
            'spares' => 'required|string|min:4|max:70'
        ];
    }
}
