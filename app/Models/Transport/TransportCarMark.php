<?php

namespace App\Models\Transport;

use App\Models\BaseModel;

class TransportCarMark extends BaseModel
{
     protected $fillable = ['title', 'logo', 'published'];

    public $timestamps = false;

    public function transport_car_models () {
        return $this->hasMany(TransportCarModel::class);
    }
}
