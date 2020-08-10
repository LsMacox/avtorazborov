<?php

namespace App\Models;

use App\Models\UserSettings\ShopSetting;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'user_id',
        'city',
        'phone',
        'mark',
        'model',
        'year_of_issue',
        'vin',
        'engine_number',
        'spares',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @param $proposal
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y');
    }

    public function getPhoneAttribute($value)
    {
        $check = auth()->user()->checkCompletedProfileAboutShop();

        if (!$check)
        {
            $value = substr($value, 0, 9);
            $phone = $value . '***';
            return $phone;
        }

        return $value;
    }



}
