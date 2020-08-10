<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'user_id',
        'designation',
        'name',
        'mime_type',
        'size',
        'created_at',
        'updated_at'
    ];

    public function getNameAttribute($value)
    {
        $val = json_decode($value, true);
        if ($val !== null) return json_decode($value, true);
        return $value;
    }

    public function getSizeAttribute($value)
    {
        $val = json_decode($value, true);
        if ($val !== null) return json_decode($value, true);
        return $value;
    }

    public function getMimeTypeAttribute($value)
    {
        $val = json_decode($value, true);
        if ($val !== null) return json_decode($value, true);
        return $value;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
