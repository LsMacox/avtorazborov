<?php

namespace App\Repositories\Payment;

use App\Models\Payment as Model;
use App\Repositories\CoreRepository;

use App\Mail\InvoiceEmail;
use Carbon\Carbon;
use Mail;

// Models
use App\Models\User;

// Sberbank
use Voronkovich\SberbankAcquiring\Client;
use Voronkovich\SberbankAcquiring\Currency;
use Voronkovich\SberbankAcquiring\OrderStatus;

/**
 * Class PaymentIndexRepository
 *
 * @package App\Repositories
 */
class PaymentIndexRepository extends CoreRepository
{

    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить последний платеж пользователя
     *
     * @return mixed
     */
    public function getLatestUserPayment()
    {
        return $this->startConditions()->where('user_id', auth()->id())
                                            ->latest()
                                            ->get();
    }

    /**
     * Получить платеж в ожидании по $order_id
     *
     * @param $order_id
     * @return mixed
     */
    public function getWaitPayment($order_id)
    {
        return $this->startConditions()
                        ->where('order_id', $order_id)
                        ->where('status', 'wait_payment')
                        ->first();
    }

    /**
     * Получить статус платежа
     *
     * @param $order_id
     * @return string
     */
    public function getPaymentStatus($order_id)
    {
        $payment = $this->getWaitPayment($order_id);
        $client = $this->apiClient();
        $result = $client->getOrderStatus($payment->order_id);

        if(!$payment) return 'none_payment';

        if (OrderStatus::isDeposited($result['orderStatus'])) {

            if($result['amount']/100 != $payment->amount){
                return 'error_amount';
            }

            $payment->status = 'success';
            $payment->save();

            $tariff_days = [7, 30, 180, 365];

            $user = User::find(auth()->id());
            $user->tariff_id = $payment->tariff_id;
            $user->tariff_finish = Carbon::now()->addDays($tariff_days[$payment->tariff_period]);
            $user->save();

            return 'success';
        }
        elseif (OrderStatus::isDeclined($result['orderStatus'])) {
            $payment->status = 'error';
            $payment->error = $result['actionCodeDescription'];
            $payment->save();

            return 'error_status';
        }

    }

    /**
     * Сохранить платеж по карте
     *
     * @param array $args
     * @return array|Client
     */
    public function storePaymentBankCard(array $args)
    {
        $payment = $this->startConditions()->create([
            'user_id' => auth()->id(),
            'method' => 'card',
            'tariff_id' => $args['tariff']->id,
            'tariff_period' => $args['time_id'],
            'amount' => $args['amount']
        ]);

        $params['currency'] = Currency::RUB;
        $params['description'] = "Оплата тарифа " . $args['tariff']->title;
        $params['amount'] = $args['amount'] * 100; // Чтобы было в копейках;
        $params['payment_id'] = $payment->id;
        $params['route'] = route('shop.balance.index');

        $order = $this->registerOrder($params);

        $payment->order_id = $order['orderId'];
        $payment->save();

        return $order;

    }

    /**
     * Сохранить платеж по счету
     *
     * @param array $args
     * @return mixed
     */
    public function storePaymentInvoice(array $args)
    {
        $payment = $this->startConditions()->create([
            'method' => 'invoice',
            'user_id' => auth()->id(),
            'tariff_id' => $args['tariff_id'],
            'tariff_period' => $args['time_id'],
            'amount' =>$args['amount'],
            'name' => $args['name'],
            'inn' => $args['inn'],
            'kpp' => $args['kpp'],
        ]);

        return $payment;
    }

    /**
     * Сгенерировать pdf файл счета
     *
     * @param array $args
     */
    public function generateInvoicePDF(array $args)
    {
        $data = [
            'organization' => $args['organization'],
            'title' => $args['title'],
            'address' => $args['address'],
            'phone' => $args['phone'],
            'ogrn' => $args['ogrn'] ?? ' - ',
            'inn' => $args['inn'] ?? ' - ',
            'kpp' => $args['kpp'] ?? ' - ',
            'tariff' => $args['tariff'],
            'price' => $args['price'],
            'price_str' => Model::num2str($args['price']),
            'id' => $args['payment_id'],
            'date' => Model::russian_date()
        ];

        $pdf = \PDF::loadView('layouts.shop.payout.invoicePDF', $data);

        \File::isDirectory(storage_path('app/files/pdf/payment/' . auth()->id())) or \File::makeDirectory(storage_path('app/files/pdf/payment/' . auth()->id()), 0777, true, true);
        $pdf->setWarnings(false)->save(storage_path('app/files/pdf/payment/' . auth()->id() . '/invoice_' . $args['payment_id'] . '.pdf'));
    }

    /**
     * Отправить Счет на почту
     *
     * @param array $args
     */
    public function sendInvoiceOnMail(array $args)
    {
        $objInvoice = new \stdClass();
        $objInvoice->sender = 'Авторазборов.рф';
        $objInvoice->name = $args['user_name'];
        $objInvoice->pdf = storage_path('app/files/pdf/payment/' . auth()->id() . '/invoice_' . $args['payment_id'] . '.pdf');
        Mail::to($args['email'])->send(new InvoiceEmail($objInvoice));
    }

    /**
     * Регистрация платежа
     *
     * @param array $params
     * @return array|Client
     */
    protected function registerOrder(array $params)
    {
        $client = $this->apiClient();

        $client = $client->registerOrder($params['payment_id'] . '-x-' . rand(), $params['amount'], $params['route'], [$params['currency'], $params['description']]);

        return $client;
    }

    /**
     * Api Сберабанка
     *
     * @return Client
     */
    private function apiClient()
    {
        $client = new Client(['userName' => 'avtorazborov-api', 'password' => 'avtorazborov', 'apiUri' => 'https://3dsec.sberbank.ru']);

        return $client;
    }


}