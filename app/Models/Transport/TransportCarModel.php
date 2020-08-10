<?php

namespace App\Models\Transport;

use App\Models\BaseModel;

class TransportCarModel extends BaseModel
{
     protected $fillable = ['title', 'transport_car_mark_id'];

    public $timestamps = false;

    public function transport_car_mark () {
        return $this->belongsTo(TransportCarMark::class, 'transport_car_mark_id', 'id');
    }
}
