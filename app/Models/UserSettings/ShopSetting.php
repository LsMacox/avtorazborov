<?php

namespace App\Models\UserSettings;

use App\Models\BaseModel;
use App\Models\Tariff;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ShopSetting extends Model
{
    protected $fillable = [
        'user_id',
        'tariff_id',
        'tariff_finish',
        'name',
        'email',
        'email_notify',
        'phone',
        'address',
        'city',
        'description',
        'schedule',
        'transport_in_stock',
    ];

    protected $dates = ['created_at', 'updated_at', 'tariff_finish'];

    public function getScheduleAttribute($value)
    {
        return (object) json_decode($value, true);
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = preg_replace('![^0-9]+!', '', $value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tariff()
    {
        return $this->belongsTo(Tariff::class);
    }

}
