<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MediaUploaderService extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'mediaUploader';
    }
}