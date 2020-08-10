<?php

namespace App\Http\Controllers\Message\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Message\BaseController as GuestBaseController;

abstract class BaseController extends GuestBaseController
{
    public function __construct()
    {
        parent::__construct();
    }
}
