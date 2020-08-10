<?php

namespace App\Models\Alert;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ShopProfileAlertRegion extends Model
{
    protected $fillable = ['user_id', 'name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
