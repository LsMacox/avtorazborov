<?php

namespace App\Repositories\Shop\Profile;

use App\Models\ShopTransportInStock as Model;
use App\Repositories\CoreRepository;

/**
 * Class ProfileTransportRepository
 *
 * @package App\Repositories
 */
class ProfileTransportRepository extends CoreRepository
{

    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Обновление транспорта в наличии
     *
     * @param $request
     */
    public function updateTransportInStockAlert($request)
    {

        foreach ($request['clear'] as $key => $transport)
        {
            $transport_in_stock = $this->startConditions()
                                        ->where('user_id', auth()->id())
                                        ->where('transport', $key)
                                        ->where('alert', 1);

            foreach ($transport as $tr)
            {
                $transport_in_stock->where('mark',  $tr['mark'])->delete();
            }

        }

        $this->createOrUpdateAlert($request['add']);

    }

    /**
     * Обновление транспорта в наличии
     *
     * @param $request
     */
    public function updateTransportInStock($request)
    {
        foreach ($request['clear'] as $key => $transport)
        {
            $transport_in_stock = $this->startConditions()
                                        ->where('user_id', auth()->id())
                                        ->where('transport', $key);

            foreach ($transport as $tr)
            {
                $transport_in_stock->where('mark',  $tr['mark'])->delete();
            }

        }

        $this->createOrUpdate($request['add']);
    }

    public function createOrUpdate($arr) {
        foreach ($arr as $key => $transport)
        {
            foreach ($transport as $tr) {
                $tr = (object) $tr;

                $transport_in_stock = $this->startConditions()
                    ->where('user_id', auth()->id())
                    ->where('transport', $key)
                    ->where('model', $tr->model);


                if ($transport_in_stock->count() == 0) {
                    $this->startConditions()->create([
                        'user_id' => auth()->id(),
                        'transport' => $key,
                        'mark' => $tr->mark,
                        'model' => $tr->model,
                        'year_from' => $tr->year_from,
                        'year_before' => $tr->year_before,
                    ]);
                } else {
                    $transport_in_stock->update([
                        'year_from' => $tr->year_from,
                        'year_before' => $tr->year_before
                    ]);
                }
            }
        }
    }
    public function createOrUpdateAlert($arr) {
        foreach ($arr as $key => $transport)
        {
            foreach ($transport as $tr) {
                $tr = (object) $tr;

                $transport_in_stock = $this->startConditions()
                    ->where('user_id', auth()->id())
                    ->where('transport', $key)
                    ->where('model', $tr->model)
                    ->where('alert', 1);


                if ($transport_in_stock->count() == 0) {
                    $this->startConditions()->create([
                        'user_id' => auth()->id(),
                        'transport' => $key,
                        'mark' => $tr->mark,
                        'model' => $tr->model,
                        'year_from' => $tr->year_from,
                        'year_before' => $tr->year_before,
                        'alert' => true,
                    ]);
                } else {
                    $transport_in_stock->update([
                        'year_from' => $tr->year_from,
                        'year_before' => $tr->year_before,
                        'alert' => true,
                    ]);
                }
            }
        }
    }

    public function transportAvailable() {
        return $this->startConditions()
                    ->where('user_id', auth()->id())
                    ->where('alert', 0)->get();
    }

    public function transportAlertAvailable() {
        return $this->startConditions()
                    ->where('user_id', auth()->id())
                    ->where('alert', 1)->get();
    }
}