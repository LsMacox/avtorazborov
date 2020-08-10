<?php

namespace App\Http\Controllers\Shop\Profile;

use App\Repositories\Transport\Cars\MarksRepository as TransportCarMarksRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\Profile\BaseController;
use App\Repositories\Shop\Profile\ProfileTransportRepository;
use Illuminate\Http\Response;

class TransportController extends BaseController
{
    protected $profileTransportRepository;
    protected $transportCarMarksRepository;

    public function __construct()
    {
        parent::__construct();
        $this->profileTransportRepository = app(ProfileTransportRepository::class);
        $this->transportCarMarksRepository = app(TransportCarMarksRepository::class);
    }

    public function transportInStock()
    {
        $marks = $this->transportCarMarksRepository->getPublished();

        return view('layouts.shop.additionally.cars_in_stock', compact('marks'));
    }

    public function transportAvailable()
    {
        $transports = $this->profileTransportRepository->transportAvailable();

        return response()->json($transports);
    }

    public function transportInStockStore(Request $request)
    {
        $this->profileTransportRepository->updateTransportInStock($request);
    }

    public function transportAvailableAlert()
    {
        $transports = $this->profileTransportRepository->transportAlertAvailable();

        return response()->json($transports);
    }

    public function transportInStockStoreAlert(Request $request)
    {
        $this->profileTransportRepository->updateTransportInStockAlert($request);
    }


}
