<?php

namespace App\Repositories\Admin\Message;

use App\Models\Message as Model;
use App\Models\User;
use App\Models\UserSettings\UserSetting;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;
use Illuminate\Support\Carbon;

/**
 * Class ProposalIndexRepository
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

    public function getUsers($proposal_id, $user_id)
    {
        $messages = $this->startConditions()
                            ->select('from')
                            ->where('to', $user_id)
                            ->where('proposal_id', $proposal_id)
                            ->get();

        $froms = [];

        foreach ($messages as $message)
        {
            $froms[] = $message->from;
        }

        $users = \App\Models\User::where('id', '!=', $user_id)
            ->select('id', 'login')
            ->get();

        $users = $users->filter(function ($user) use ($froms) {

            return in_array($user->id, $froms);

        });

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

    public function updateUnread($from_id, $user_id)
    {
        return $this->startConditions()
            ->where(function ($query) use ($from_id, $user_id) {
                $query->where('from', $from_id);
                $query->where('to', $user_id);
            })
            ->update(['read' => true]);
    }

    public function getUnreadIds($proposal_id, $user_id)
    {
        $unreadIds = $this->startConditions()
            ->select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', $user_id)
            ->where('read', false)
            ->where('proposal_id', $proposal_id)
            ->groupBy('from')
            ->get();

        return $unreadIds;
    }

    public function getContactMessage($proposal_id, $user_id)
    {
        $messages = $this->startConditions()
            ->where('to', $user_id)
            ->where('proposal_id', $proposal_id)
            ->get();

        $messages = $messages->map(function ($contact) use ($messages) {

            $sender = $messages->where('from', $contact->id)->first();

            if ($sender->count() > 0) {
                return $messages;
            }

        });

        return $messages;
    }

    public function getSelectedUserMessages($from_id, $proposal_id, $user_id)
    {
        $messages = $this->startConditions()->where(function ($q) use ($from_id, $user_id) {
            $q->where('from', $user_id);
            $q->where('to', $from_id);
            })->orWhere(function ($q) use ($from_id, $user_id) {
                $q->where('from', $from_id);
                $q->where('to', $user_id);
            })->get();

        $messages = $messages->filter(function ($message) use ($proposal_id) {
            return (int) $message->proposal_id == (int) $proposal_id;
        });

        return $messages;
    }

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