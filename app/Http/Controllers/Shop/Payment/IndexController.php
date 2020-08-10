<?php

namespace App\Http\Controllers\Shop\Payment;

use App\Http\Controllers\Shop\Payment\BaseController;

use Illuminate\Http\Request;

// Requests
use App\Http\Requests\Shop\Payment\InvoiceRequest;
use App\Http\Requests\Shop\Payment\InvoicePDFRequest;
use App\Models\Payment;

// Repositories
use App\Repositories\Payment\PaymentIndexRepository;
use App\Repositories\Payment\PaymentTariffRepository;
use App\Repositories\Shop\Profile\ProfileIndexRepository;

class IndexController extends BaseController
{

    protected $paymentIndexRepository;
    protected $paymentTariffRepository;
    protected $profileIndexRepository;

    public function __construct()
    {
        parent::__construct();
        $this->paymentIndexRepository = app(PaymentIndexRepository::class);
        $this->paymentTariffRepository = app(PaymentTariffRepository::class);
        $this->profileIndexRepository = app(ProfileIndexRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tariff = $this->paymentTariffRepository->getById($request->tariff_id);
        $tariff_prices = $this->paymentTariffRepository->getPrice($request->tariff_id);
        $tariff_prices_amount = $this->paymentTariffRepository->getPriceAmount($request->tariff_id, $request->time_id);

        if($tariff_prices_amount == null) return redirect()->back()->withErrors(['tarif'=>'Неверный тариф!']);

        $data =
            [
                'tariff' => $tariff,
                'time_id' => $request->time_id,
                'amount' => $tariff_prices_amount
            ];
        $order = $this->paymentIndexRepository->storePaymentBankCard($data);

        return redirect($order['formUrl']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = auth()->user()->shop_setting;
        $current_tariff = $this->paymentTariffRepository->getById($user->tariff_id);

        $tariffs = $this->paymentTariffRepository->getAll();
        $history = $this->paymentIndexRepository->getLatestUserPayment();
        $left = $this->paymentTariffRepository->getPaymentLeft($user->tariff_finish);

        return view('layouts.shop.payout.index', compact('current_tariff', 'tariffs', 'history', 'left'));
    }

    public function invoice(InvoiceRequest $request){
        $user = auth()->user()->shop_setting;

        $data = ['tariff_id' => $request->tariff_id, 'time_id' => $request->time_id];
        $title = $this->paymentTariffRepository->getTitle($data);

        $amount = $this->paymentTariffRepository->getPriceAmount($request->tariff_id, $request->time_id);
        $tariff_id = $request->tariff_id;
        $time_id = $request->time_id;

        return view('layouts.shop.payout.invoice', compact('title', 'amount', 'tariff_id', 'time_id', 'user'));
    }

    public function invoicePDF(InvoicePDFRequest $request) {

        $user = auth()->user()->shop_setting;
        $tariff = $this->paymentTariffRepository->getById($request->tariff_id);

        if(!$tariff) return redirect()->route('shop.balance.index')->withErrors(['error' => 'Неверный тариф!']);

        $amount = $this->paymentTariffRepository->getPriceAmount($tariff->id, $request->time_id);

        $data = ['tariff_id' => $tariff->id, 'time_id' => $request->time_id];
        $title = $this->paymentTariffRepository->getTitle($data);

        $data =
            [
                'tariff_id'=>$tariff->id,
                'time_id' => $request->time_id,
                'amount' => $amount,
                'name' => $request->name,
                'inn' => $request->inn,
                'kpp' => $request->kpp
            ];
        $payment = $this->paymentIndexRepository->storePaymentInvoice($data);

        $data = [
            'organization' => $request->organization,
            'title' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'ogrn' => $request->ogrn,
            'inn' => $request->inn,
            'kpp' => $request->kpp,
            'tariff' => $title,
            'price' => $amount,
            'payment_id' => $payment->id,
        ];
        $this->paymentIndexRepository->generateInvoicePDF($data);

        $data = [
            'email' => $request->email,
            'user_name' => $user->name,
            'payment_id' => $payment->id
        ];
        $this->paymentIndexRepository->sendInvoiceOnMail($data);

        return redirect()->route('shop.balance.index')->with(['message' => 'Счет успешно выставлен и отправлен вам на почту ' . $request->email]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        if($payment->user_id == auth()->id() && $payment->status === 'wait_payment'){
            $numInvoice = $payment->method === 'card' ? $payment->id : 'АР-'.$payment->id;
            $payment->delete();
            return redirect()->back()->with(['message' => 'Счет №'.$numInvoice.' успешно удален!']);
        } else
            return redirect()->back()->withErrors(['При удалении счета произошла ошибка!']);
    }

    public function paymentStatus(Request $request){

        $status = $this->profileIndexRepository->getPaymentStatus($request->get('orderId'));

        if ($status === 'none_payment'
            || $status === 'error_status'
            || $status === 'error_amount') return redirect()
                                                    ->route('shop.balance.index')
                                                    ->withErrors(['payment' => 'При оплате произошла ошибка.']);

        if ($status === 'success')
        {
            return redirect()->route('inning.balance')->with(['message' => 'Тариф успешно активирован']);
        }

    }
}
