<?php

namespace App\Http\Controllers\PushNotification;

use Illuminate\Http\Request;
use App\Http\Controllers\PushNotification\BaseController;

use App\Repositories\PushNotification\PushNotificationIndexRepository;

class IndexController extends BaseController
{

    protected $pushNotificationIndexRepository;

    public function __construct()
    {
        parent::__construct();
        $this->pushNotificationIndexRepository = app(PushNotificationIndexRepository::class);
    }

    public function registerPushNotificationToken($token)
    {
        $this->pushNotificationIndexRepository->createToken($token);
    }

}
