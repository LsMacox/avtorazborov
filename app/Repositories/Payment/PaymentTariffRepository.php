<?php

namespace App\Repositories\Payment;

use App\Models\Tariff as Model;
use App\Repositories\CoreRepository;

/**
 * Class PaymentTariffRepository
 *
 * @package App\Repositories
 */
class PaymentTariffRepository extends CoreRepository
{

    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить все тарифы
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->startConditions()->where('id', '!=', 1)->get();
    }

    /**
     * Получить тариф по $id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Получить title тарифа
     *
     * @param array $args
     * @return string
     */
    public function getTitle(array &$args = [])
    {
        $tariff = $this->startConditions()->find($args['tariff_id']);
        $periods = $this->getPeriods();
        $title = $tariff->title . ' (' . $periods[$args['time_id']] . ')';

        return $title;
    }

    /**
     * Получить price тарифа
     *
     * @param $tariff_id
     * @return mixed
     */
    public function getPrice($tariff_id)
    {
        $prices = $this->getById($tariff_id)->prices;
        $prices = json_decode($prices, true);

        return $prices;
    }

    /**
     *  Получить стоимость price тарифа
     *
     * @param $tariff_id
     * @param $time_id
     * @return mixed
     */
    public function getPriceAmount($tariff_id, $time_id)
    {
        $tariff_prices = $this->getPrice($tariff_id);
        $amount = $tariff_prices[$time_id]['discount'] ?? $tariff_prices[$time_id]['price'];

        return $amount;
    }

    /**
     * Получить периоды
     *
     * @return array
     */
    public function getPeriods()
    {
        $periods = ['7 дней','1 месяц','6 месяцев','1 год'];

        return $periods;
    }

    /**
     * Получить остаток тарифа
     *
     * @param $tariff_finish
     * @return string
     */
    public function getPaymentLeft($tariff_finish)
    {
        $startDate = now();
        $endDate = $tariff_finish;

        $days = $startDate->diffInDays(now()->addDays(2)->addHour());
        $hours = $startDate->copy()->addDays($days)->diffInHours(now()->addDays(2));

        if($startDate < $endDate){
            $days = $startDate->diffInDays($endDate);
            $hours = $startDate->copy()->addDays($days)->diffInHours($endDate);

            if ($days > 10 && $days < 20 || ($days % 10 > 4 && $days % 10 < 10) || $days % 10 == 0 ) $days_print = ' дней ';
            elseif ($days % 10 > 1 && $days % 10 < 5 ) $days_print = ' дня ';
            else $days_print = ' день ';

            $left = $days . $days_print . $hours . ' ч.';
        } else
            $left = 'завершен';

        return $left;
    }

}