<?php

namespace App\Repositories\User\Message;

use App\Models\Message as Model;
use App\Repositories\CoreRepository;

// Models
use App\Models\User;

/**
 * Class MessageIndexRepository
 *
 * @package App\Repositories
 */
class MessageIndexRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получение пользователей ответивших на заявку
     *
     * @param $proposal_id
     * @return mixed
     */
    public function getUsers($proposal_id)
    {
        $messages = $this->startConditions()
                            ->select('from')
                            ->where('to', auth()->id())
                            ->where('proposal_id', $proposal_id)
                            ->get();

        $froms = [];

        foreach ($messages as $message)
        {
            $froms[] = $message->from;
        }

        $users = User::where('id', '!=', auth()->id())
                        ->select('id', 'login')
                        ->get();

        $users = $users->filter(function ($user) use ($froms) {return in_array($user->id, $froms);});

        $users = $users->map(function($user) {
            $shop = User::find($user->id);
            $shop_settings = $shop->shop_setting;
            $shop_media = $shop->media->where('designation', 'avatar');

            $user->settings = $shop_settings;
            $user->avatar = $shop_media;

            return $user;
        });

        return $users;
    }

    /**
     * Обновление поля read (У пользователя)
     *
     * @param $from_id
     * @return mixed
     */
    public function updateUnread($from_id)
    {
        return $this->startConditions()
                        ->where(function ($query) use ($from_id) {
                            $query->where('from', $from_id);
                            $query->where('to', auth()->id());
                        })
                        ->update(['read' => true]);
    }

    /**
     * Получение кол-во не прочитанных Сообщений
     *
     * @param $proposal_id
     * @return mixed
     */
    public function getUnreadIds($proposal_id)
    {
        return $this->startConditions()
                            ->select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
                            ->where('to', auth()->id())
                            ->where('read', false)
                            ->where('proposal_id', $proposal_id)
                            ->groupBy('from')
                            ->get();
    }

    /**
     * Получения сообщений контакта
     *
     * @param $from_id
     * @param $proposal_id
     * @return mixed
     */
    public function getContactMessage($from_id, $proposal_id)
    {
        return $this->startConditions()
                            ->where('proposal_id', $proposal_id)
                            ->where(function ($q) use ($from_id) {
                                $q->where('from', auth()->id());
                                $q->where('to', $from_id);
                            })->orWhere(function ($q) use ($from_id) {
                                $q->where('from', $from_id);
                                $q->where('to', auth()->id());
                            })->get();
    }

    /**
     * Добавляет ключ не прочитанных сообщений
     *
     * @param $contacts
     * @param $unreadIds
     * @return mixed
     */
    public function addUnreadKeyToContacts($contacts, $unreadIds)
    {
        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();
            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
            return $contact;
        });

        return $contacts;
    }

}