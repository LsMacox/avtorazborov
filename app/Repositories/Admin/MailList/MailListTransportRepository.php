<?php

namespace App\Repositories\Admin\MailList;

use App\Models\ShopTransportInStock as Model;
use App\Repositories\CoreRepository;

/**
 * Class MailListTransportRepository
 *
 * @package App\Repositories
 */
class MailListTransportRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getById($id)
    {
        return $this->startConditions()->find($id);
    }

    public function available($user_id)
    {
        return $this->startConditions()
                    ->where('user_id', $user_id)
                    ->where('alert', 1)
                    ->get();
    }

    public function store($data)
    {
        $transports = [];

        foreach ($data['transport']['add'] as $key => $transport)
        {
            foreach ($transport as $tr) {
                $tr = (object) $tr;
                $transport_in_stock = $this->startConditions()
                    ->where('user_id', $data['user_id'])
                    ->where('transport', $key)
                    ->where('model', $tr->model)
                    ->where('alert', 1);


                if ($transport_in_stock->count() == 0) {
                    $tr = $this->startConditions()->create([
                        'user_id' => $data['user_id'],
                        'transport' => $key,
                        'mark' => $tr->mark,
                        'model' => $tr->model,
                        'year_from' => $tr->year_from,
                        'year_before' => $tr->year_before,
                        'alert' => true,
                    ]);
                    array_push($transports, $tr);
                } else {
                    $tr = $transport_in_stock->update([
                        'year_from' => $tr->year_from,
                        'year_before' => $tr->year_before,
                        'alert' => true,
                    ]);

                    array_push($transports, $tr);
                }
            }
        }
        return $transports;
    }

    public function update($data, $id)
    {
        $transport = $this->getById($id);
        $transport->update($data);
        return $transport;
    }

}