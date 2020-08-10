<?php

namespace App\Http\Controllers\Shop\Message;

use App\Http\Controllers\Shop\Message\BaseController;
use Illuminate\Http\Request;

// Repositories
use App\Repositories\Shop\Message\MessageIndexRepository;


class IndexController extends BaseController
{

    protected $messageIndexRepository;

    public function __construct()
    {
        parent::__construct();
        $this->messageIndexRepository = app(MessageIndexRepository::class);
    }

    public function getContact($proposal_id)
    {
        // Получение пользователей ответивших на заявку
        $contact = $this->messageIndexRepository->getUser($proposal_id);

        // Получение ID не просмотренных сообщений и пользователей который отправил это сообщение
        $unreadIds = $this->messageIndexRepository->getUnreadIds($proposal_id);

        // Добавление допольнительных данных (Непрочитанные сообщения, онлайн пользователя)
        $contacts = $this->messageIndexRepository->addUnreadKeyToContacts($contact, $unreadIds);

        // Возвращаем ответ в виде JSON
        return response()->json((object)$contacts->toArray());
    }

    public function getMessages($from_id, $proposal_id)
    {
        // Обновление данных (read = true)
        $this->messageIndexRepository->updateUnread($from_id);

        // Получаем сообщения выбранного пользователя
        $messages = $this->messageIndexRepository->getMessages($from_id, $proposal_id);

        // Возвращаем ответ в виде JSON
        return $messages->toArray();
    }



}
