<?php

namespace App\Http\Controllers\Transport\Cars;

use Illuminate\Http\Request;
use App\Http\Controllers\Transport\BaseController as GuestBaseController;

abstract class BaseController extends GuestBaseController
{

    public function __construct()
    {
        parent::__construct();

    }

}
