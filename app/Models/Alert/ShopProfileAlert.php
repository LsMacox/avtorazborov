<?php

namespace App\Models\Alert;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ShopProfileAlert extends Model
{
    protected $fillable = ['user_id', 'email', 'often_receive_notification', 'confirmed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
