<?php

namespace App\Http\Controllers\User\Message;

use App\Http\Controllers\User\Message\BaseController;
use Illuminate\Http\Request;

// Repositories
use App\Repositories\User\Message\MessageIndexRepository;


class IndexController extends BaseController
{

    protected $messageIndexRepository;

    public function __construct()
    {
        parent::__construct();
        $this->messageIndexRepository = app(MessageIndexRepository::class);
    }

    public function getContacts($proposal_id)
    {
        // Получение пользователей ответивших на заявку
        $contacts = $this->messageIndexRepository->getUsers($proposal_id);

        // Получение ID не просмотренных сообщений и пользователей который отправил это сообщение
        $unreadIds = $this->messageIndexRepository->getUnreadIds($proposal_id);

        // Добавление допольнительных данных (Непрочитанные сообщения, онлайн пользователя)
        $contacts = $this->messageIndexRepository->addUnreadKeyToContacts($contacts, $unreadIds);

        $contacts = array_values($contacts->toArray());
        // Возвращаем ответ в виде JSON
        return response()->json($contacts);

    }

    public function getMessages($from_id, $proposal_id)
    {
        // Обновление данных (read = true)
        $this->messageIndexRepository->updateUnread($from_id);

        // Получаем сообщения выбранного пользователя
        $messages = $this->messageIndexRepository->getContactMessage($from_id, $proposal_id);

        $messages= array_values($messages->toArray());
        // Возвращаем ответ в виде JSON
        return response()->json($messages);
    }

}
