<?php

namespace App\Http\Controllers\Message\File;

use Illuminate\Http\Request;
use App\Http\Controllers\Message\File\BaseController;

// Events
use App\Events\NewMessage;

// Requests
use App\Http\Requests\Message\sendFileRequest;

// Repositories
use App\Repositories\Message\MessageIndexRepository;

class IndexController extends BaseController
{

    protected $messageIndexRepository;
    protected $pushNotificationTokenIndexRepository;

    public function __construct()
    {
        $this->messageIndexRepository = app(MessageIndexRepository::class);
    }


    public function sendFile(sendFileRequest $request) {
            
        $path = $request->file('file_message')->store('messages', 'public');

        $message = $this->messageIndexRepository->createFile($request->to, $path, $request->proposal_id);

        broadcast(new NewMessage($message));
           
        return response()->json($message);
    }
}
