<?php

namespace App\Http\Controllers\Shop\Profile;

use App\Http\Controllers\Shop\Profile\BaseController;
use Illuminate\Http\Request;

// Requests
use App\Http\Requests\Shop\Profile\Alert\StoreRequest;

// Repositories
use App\Repositories\Location\RegionsIndexRepository;
use App\Repositories\Admin\Synonym\SynonymTransportNameRepository;
use App\Repositories\Shop\Alert\AlertIndexRepository;
use App\Repositories\Payment\PaymentTariffRepository;

class AlertController extends BaseController
{
    protected $regionsIndexRepository;
    protected $synonymTransportWordRepository;
    protected $profileAlertRepository;
    protected $paymentTariffRepository;

    public function __construct()
    {
        parent::__construct();
        $this->regionsIndexRepository = app(RegionsIndexRepository::class);
        $this->synonymTransportWordRepository = app(SynonymTransportNameRepository::class);
        $this->profileAlertRepository = app(AlertIndexRepository::class);
        $this->paymentTariffRepository = app(PaymentTariffRepository::class);
    }

    public function index()
    {
        $shop_setting = auth()->user()->shop_setting;
        $regions = $this->regionsIndexRepository->getAll();
        $synonyms = $this->synonymTransportWordRepository->getAll();
        $alert = auth()->user()->shop_profile_alert;
        $alert_regions = auth()->user()->shop_profile_alert_regions;
        $alert_synonyms = auth()->user()->shop_profile_alert_synonyms;
        $shop_tariff = $this->paymentTariffRepository->getById($shop_setting->tariff_id);

        return view('layouts.shop.profile.alert', compact('shop_setting', 'regions', 'synonyms', 'alert', 'alert_regions', 'alert_synonyms', 'shop_tariff'));
    }

    public function store(StoreRequest $request)
    {
        $alert = $this->profileAlertRepository->store($request);

        return response()->json($alert);
    }

    public function confirmed($user)
    {
        $this->profileAlertRepository->confirmed($user);

        return view('layouts.shop.alert.confirmed');
    }

    public function unsubscribe($user)
    {
        $this->profileAlertRepository->unsubscribe($user);

        return view('layouts.shop.alert.unsubscribe');
    }

    public function testEmailNotDelivered(Request $request)
    {
        $mail = $this->profileAlertRepository->sendAdminEmailAboutNotDeliveredEmail();

        return response()->json($mail);
    }



}
