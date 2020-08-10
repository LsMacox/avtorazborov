<?php

namespace App\Validations;

use Illuminate\Validation\Validator;

class CustomValidator extends Validator
{
    public function validateYOfI($attribute, $value, $parameters)
    {
        if ( (int) $value <  (int) $parameters[0] || (int) $value > (int) $parameters[1])
        {
            return false;
        }
        return true;
    }

    public function validatePhone($attribute, $value, $parameters)
    {
        $phone = preg_replace("/[+ ()-]/", "", $value);
        if (strlen($phone) == 11){
            $first = substr($phone, "0",1);
            if ( (int) $first == 7 ) return true;
        }elseif (strlen($phone) == 12)
        {
            $first = substr($phone, "0",1);
            if ( (int) $first == 3 ) return true;
        }
        return false;
    }

    public function validateTariffMaxRegion($attribute, $value, $parameters) {
        $shop_setting = auth()->user()->shop_setting;
        $shop_tariff = \DB::table('tariffs')->find($shop_setting->tariff_id);

        if (mb_strtolower($shop_tariff->title) == mb_strtolower($parameters[0]) && count($value) > (int) $parameters[1])
        {
            return false;
        }
        return true;
    }
}
