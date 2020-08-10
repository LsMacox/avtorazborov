<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    protected $fillable = ['title'];

    public $timestamps = false;

}
