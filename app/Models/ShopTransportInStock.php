<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopTransportInStock extends Model
{
    protected $fillable = [
        'user_id',
        'transport',
        'mark',
        'model',
        'year_from',
        'year_before',
        'alert'
    ];
}
