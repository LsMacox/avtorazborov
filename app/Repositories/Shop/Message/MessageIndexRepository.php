<?php

namespace App\Repositories\Shop\Message;

use App\Models\Message as Model;
use App\Repositories\CoreRepository;

// Models
use App\Models\UserSettings\UserSetting;
use App\Models\Proposal;
use App\Models\User;

/**
 * Class MessageIndexRepository
 *
 * @package App\Repositories
 */
class MessageIndexRepository extends CoreRepository
{

    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить пользоватя
     *
     * @param $proposal_id
     * @return mixed
     */
    public function getUser($proposal_id)
    {
        $proposal = Proposal::find($proposal_id);

        $user = User::where('id', $proposal->user_id)->get();

        if (!auth()->user()->checkCompletedProfileAboutShop())
        {
            $user->first()->login = substr($user->first()->login, 0, 9) . '***';
        }else{
            $user->first()->login = phone_number($user->first()->login);
        }

        $shop_settings = UserSetting::where('user_id', $user->first()->id)->first();

        $user = $user->map(function ($user) use ($shop_settings) {
            $user->settings = $shop_settings;
            return $user;
        });

        return $user;
    }

    /**
     * Получить кол-во не прочитанных сообщений
     *
     * @param $proposal_id
     * @return mixed
     */
    public function getUnreadIds($proposal_id)
    {
        $unreadIds = $this->startConditions()
            ->select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', auth()->id())
            ->where('read', false)
            ->where('proposal_id', $proposal_id)
            ->groupBy('from')
            ->get();

        return $unreadIds;
    }

    /**
     * Обновить read
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
     * Получить сообщения
     *
     * @param $from_id
     * @param $proposal_id
     * @return mixed
     */
    public function getMessages($from_id, $proposal_id)
    {
        $messages = $this->startConditions()
            ->where('proposal_id', $proposal_id)
            ->where(function($q) use ($from_id) {
                $q->where('to', auth()->id());
                $q->where('from', $from_id);
            })
            ->orWhere(function ($q) use ($from_id) {
                $q->where('from', auth()->id());
                $q->where('to', $from_id);
            })
            ->get();

        return $messages;
    }

    /**
     * Добавить ключ unread
     *
     * @param $contact
     * @param $unreadIds
     * @return mixed
     */
    public function addUnreadKeyToContacts($contact, $unreadIds)
    {
        $contact = $contact->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();
            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
            return $contact;
        });

        return $contact;
    }

}