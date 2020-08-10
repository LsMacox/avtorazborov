<?php

namespace App\Models;

class City extends BaseModel
{
    protected $fillable = ['title', 'region_id'];

    public $timestamps = false;
}
