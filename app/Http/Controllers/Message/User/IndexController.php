<?php

namespace App\Http\Controllers\Message\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Message\User\BaseController;
use App\Mail\UserChatOfflineMail;
use Mail;

// Requests
use App\Http\Requests\Message\SendMailOnOfflineUserRequest;

class IndexController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Отправка email
     *
     * @param SendMailOnOfflineUserRequest $request
     */
    public function sendMessageOnEmail(SendMailOnOfflineUserRequest $request)
    {
        $msg = $request->msg;
        $user = $request->user_name;
        $toEmail = $request->to_email;
        Mail::to($toEmail)->send(new UserChatOfflineMail($user, $msg));
    }

}
