<?php

namespace App\Http\Controllers\Admin\MailList;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\MailList\BaseController;

// Repositories
use App\Repositories\Admin\MailList\MailListIndexRepository;
use App\Repositories\Payment\PaymentTariffRepository;
use App\Repositories\Location\RegionsIndexRepository;
use App\Repositories\Admin\Synonym\SynonymTransportNameRepository;

class IndexController extends BaseController
{

    protected $mailListIndexRepository;
    protected $paymentTariffRepository;
    protected $regionsIndexRepository;
    protected $synonymTransportNameRepository;

    public function __construct()
    {
        parent::__construct();
        $this->mailListIndexRepository = app(MailListIndexRepository::class);
        $this->paymentTariffRepository = app(PaymentTariffRepository::class);
        $this->regionsIndexRepository = app(RegionsIndexRepository::class);
        $this->synonymTransportNameRepository = app(SynonymTransportNameRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shop_profiles = $this->mailListIndexRepository->collectShopProfile()->paginate(5);
        $regions = $this->regionsIndexRepository->getAll();
        $synonyms = $this->synonymTransportNameRepository->getAll();

        return view('layouts.admin.mail_list.index', compact('shop_profiles', 'regions', 'synonyms'));
    }


    public function getPaginateFetchData(Request $request)
    {
        if ($request->ajax())
        {
            $shop_profiles = $this->mailListIndexRepository->collectShopProfile()->paginate(5);
            return view('components.admin.pagination.mail_list', compact('shop_profiles'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->mailListIndexRepository->getUsersWithoutSubscription();
        $regions = $this->regionsIndexRepository->getAll();
        $synonyms = $this->synonymTransportNameRepository->getAll();

        return view('layouts.admin.mail_list.create', compact('synonyms', 'regions', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $alert = $this->mailListIndexRepository->store($request->except('_token'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeOftenReceiveNotification(Request $request)
    {
        $alert = $this->mailListIndexRepository->changeOftenReceiveNotification($request->except('_token'));
    }
}
