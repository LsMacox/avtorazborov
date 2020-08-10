<?php

namespace App\Repositories\Admin\MailList;

use App\Models\Alert\ShopProfileAlert as Model;
use App\Repositories\CoreRepository;

// Models
use App\Models\User;
use App\Repositories\Admin\MailList\MailListSynonymRepository;
use App\Repositories\Admin\MailList\MailListRegionRepository;

/**
 * Class MailListIndexRepository
 *
 * @package App\Repositories
 */
class MailListIndexRepository extends CoreRepository
{

    protected $mailListSynonymRepository;
    protected $mailListRegionRepository;

    public function __construct()
    {
        parent::__construct();
        $this->mailListSynonymRepository = app(MailListSynonymRepository::class);
        $this->mailListRegionRepository = app(MailListRegionRepository::class);
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getByUserId($id)
    {
        return $this->startConditions()->where('user_id', $id)->first();
    }

    public function collectShopProfile()
    {
        $this->builder = User::whereHas('roles', function($query) {
            $query->where('name', 'shop');
        })
        ->whereHas('shop_profile_alert', function($query) {
            $query->where('confirmed', 1);
        })
        ->with('shop_setting')
        ->with('shop_profile_alert')
        ->with('shop_profile_alert_regions')
        ->with('shop_profile_alert_synonyms')
        ->with('shop_transport_in_stocks');

        return $this->builder;
    }

    public function getUsersWithoutSubscription()
    {
        $users = User::whereHas('roles', function($query) {
            $query->where('name', 'shop');
        })
        ->doesnthave('shop_profile_alert')
        ->with('shop_setting')
        ->get();

        return $users;
    }

    public function store($request)
    {
        $alert = $this->startConditions()->where('user_id', $request['user_id']);

        $this->mailListSynonymRepository->destroyAll();
        $this->mailListSynonymRepository->destroyAll();
        $this->mailListRegionRepository->storeCollection($request['regions']);
        $this->mailListRegionRepository->storeCollection($request['synonyms']);

        if ($alert->count() > 0)
        {
            $alert->update([
                'email' => $request['email'],
                'often_receive_notification' => $request['receive_notification'],
                'confirmed' => 1
            ]);
        } else
        {
            $alert = $this->startConditions()->create([
                'user_id' => $request['user_id'],
                'email' => $request['email'],
                'often_receive_notification' => $request['receive_notification'],
                'confirmed' => 1
            ]);
        }

    }

    public function changeOftenReceiveNotification($data)
    {
        $alert = $this->getByUserId($data['user_id']);
        $alert->often_receive_notification = $data['name'];
        $alert->save();
    }

}