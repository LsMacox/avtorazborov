<?php

namespace App\Models\Alert;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ShopProfileAlertSynonym extends Model
{
    protected $fillable = ['user_id', 'name', 'select'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
