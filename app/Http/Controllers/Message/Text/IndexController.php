<?php

namespace App\Http\Controllers\Message\Text;

use Illuminate\Http\Request;
use App\Http\Controllers\Message\Text\BaseController;

// Events
use App\Events\NewMessage;

// Requests
use App\Http\Requests\Message\sendTextRequest;

// Repositories
use App\Repositories\Message\MessageIndexRepository;
use App\Repositories\Proposal\ProposalIndexRepository;
use App\Repositories\PushNotification\PushNotificationIndexRepository;


class IndexController extends BaseController
{

    protected $messageIndexRepository;
    protected $pushNotificationIndexRepository;
    protected $proposalIndexRepository;

    public function __construct()
    {
        $this->messageIndexRepository = app(MessageIndexRepository::class);
        $this->proposalIndexRepository = app(ProposalIndexRepository::class);
        $this->pushNotificationIndexRepository = app(PushNotificationIndexRepository::class);
    }

    public function sendText(sendTextRequest $request)
    {
        $message = $this->messageIndexRepository->createText($request->to, $request->text, $request->proposal_id);
        $user_proposal = $this->proposalIndexRepository->getById($request->proposal_id);

        $this->pushNotificationIndexRepository->sendPushMessage($request->to, $user_proposal, $request->proposal_id);

        broadcast(new NewMessage($message));

        return response()->json($message);
    }
}
