<?php

namespace App\Models\UserSettings;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AdminSetting extends BaseModel
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'email_notify',
        'city'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setPhoneAttribute($value) {
        $this->attributes['phone'] = preg_replace("/[^0-9]/", "", $value);
    }

}
