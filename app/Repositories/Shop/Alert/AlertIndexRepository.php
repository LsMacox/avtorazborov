<?php

namespace App\Repositories\Shop\Alert;

use App\Models\Alert\ShopProfileAlert as Model;
use App\Repositories\CoreRepository;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

// Events
use App\Events\StoreAlert;

// Mails
use App\Mail\AdminAboutNotDeliveredTestAlertEmail;

// Repository
use App\Repositories\Proposal\ProposalIndexRepository;
use App\Repositories\Shop\Alert\AlertSynonymsRepository;
use App\Repositories\Shop\Alert\AlertRegionsRepository;

/**
 * Class AlertIndexRepository
 *
 * @package App\Repositories
 */
class AlertIndexRepository extends CoreRepository
{

    protected $alertSynonymRepository;
    protected $alertRegionRepository;
    protected $proposalIndexRepository;

    public function __construct()
    {
        parent::__construct();
        $this->alertRegionRepository = app(AlertRegionsRepository::class);
        $this->alertSynonymRepository = app(AlertSynonymsRepository::class);
        $this->proposalIndexRepository = app(ProposalIndexRepository::class);
    }

    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    public function store($request)
    {
        $proposals = $this->proposalIndexRepository->getLatest(5);
        $alert = $this->startConditions()->where('user_id', auth()->id());

        $this->alertRegionRepository->destroyAll();
        $this->alertSynonymRepository->destroyAll();
        $this->alertRegionRepository->storeCollection($request['regions']);
        $this->alertSynonymRepository->storeCollection($request['synonyms']);

        if ($alert->count() > 0)
        {
            $alert->update([
                'email' => $request['email'],
                'often_receive_notification' => $request['receive_notification']
            ]);
        } else
        {
            $alert = $this->startConditions()->create([
                'user_id' => auth()->id(),
                'email' => $request['email'],
                'often_receive_notification' => $request['receive_notification']
            ]);
        }

        $url_confirmed = URL::signedRoute(
            'shop.profile.alert.confirmed', ['user' => auth()->id()]
        );

        $url_unsubscribe = URL::signedRoute(
            'shop.profile.alert.unsubscribe', ['user' => auth()->id()]
        );

        event(new StoreAlert($alert->first()->email, $proposals, ['url_confirmed' => $url_confirmed, 'url_unsubscribe' => $url_unsubscribe]));

        return ['url_confirmed' => $url_confirmed, 'email' => $alert->first()->email];

    }

    public function confirmed($user)
    {
        $alert = auth()->user()->shop_profile_alert;

        if ($user != auth()->id()) return abort(401);
        if ($alert->confirmed) return abort(404);

        $this->startConditions()->where('user_id', $user)->update(['confirmed' => true]);
    }

    public function unsubscribe($user)
    {
        $alert = auth()->user()->shop_profile_alert;

        if ($user != auth()->id()) return abort(401);
        if (!$alert->confirmed) return abort(404);

        $this->startConditions()->where('user_id', $user)->update(['confirmed' => false]);
    }

    public function sendAdminEmailAboutNotDeliveredEmail()
    {
        $user_settings = auth()->user()->shop_setting;

        return $mail = Mail::to('autorazborov@yandex.ru')->send(
            new AdminAboutNotDeliveredTestAlertEmail($user_settings)
        );
    }
}