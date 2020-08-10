<?php

namespace App\Http\Controllers\Admin\Message;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Message\BaseController;
use App\Events\NewMessage;
use App\Events\NewAdminMessage;

// Requests
use App\Http\Requests\Message\sendTextRequest;
use App\Http\Requests\Message\sendFileRequest;

// Repositories
use App\Repositories\Message\MessageIndexRepository;
use App\Repositories\Proposal\ProposalIndexRepository;
use App\Repositories\PushNotification\PushNotificationIndexRepository;


class SendController extends BaseController
{

    protected $messageIndexRepository;
    protected $pushNotificationIndexRepository;
    protected $proposalIndexRepository;

    public function __construct()
    {
        parent::__construct();
        $this->messageIndexRepository = app(MessageIndexRepository::class);
        $this->proposalIndexRepository = app(ProposalIndexRepository::class);
        $this->pushNotificationIndexRepository = app(PushNotificationIndexRepository::class);
    }

    public function sendText(sendTextRequest $request)
    {
        $message = $this->messageIndexRepository->createText($request->to, $request->text, $request->proposal_id, true, $request->admin_id, $request->from);

        $user_proposal = $this->proposalIndexRepository->getById($request->proposal_id);

        broadcast(new NewMessage($message));

        return response()->json($message);
    }

    public function sendFile(sendFileRequest $request) {

        $path = $request->file('file_message')->store('messages', 'public');

        $message = $this->messageIndexRepository->createFile($request->to, $path, $request->proposal_id, true, $request->admin_id, $request->from);

        broadcast(new NewMessage($message));

        return response()->json($message);
    }
}
