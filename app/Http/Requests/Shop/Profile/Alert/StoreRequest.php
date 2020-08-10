<?php

namespace App\Http\Requests\Shop\Profile\Alert;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    public function rules(Request $request)
    {
        $synonyms = [];

        foreach ($request->all()['synonyms'] as $k => $synonym) {
            array_push($synonyms, $k);
        }

        return [
            'email' => 'required|email',
            'regions' => 'required|array|exists:regions,title|tariff_max_region:тестовый 15 дней,5',
            'receive_notification' => 'required|in:'.'right_away,'.'evening',
            'synonyms' => ['required',
                Rule::exists('synonym_transport_names', 'name')
                ->whereIn('name', $synonyms, 'or')
            ]
        ];
    }

    public function messages()
    {
        return [
            'regions.required' => ':attribute: добавьте хоть один регион!',
            'regions.array' => ':attribute: валидация работает! Не дохацкер',
            'regions.exists' => ':attribute: такого района не существует!',
            'synonyms.exists' => ':attribute: такой запчасти не существует!',
            'receive_notification.required' =>  ':attribute: выберите один из вариантов!',
            'receive_notification.in' =>  ':attribute: выбранное значение ошибочно!',
            'regions.tariff_max_region' => ':attribute: для тестового тарифа макс кол-во регионов 5'
        ];
    }

    public function attributes()
    {
        return [
            'regions' => 'Шаг 3',
            'receive_notification' => 'Шаг 2',
            'synonyms' => 'Шаг 4'
        ];
    }
}
