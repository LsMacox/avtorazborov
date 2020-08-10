<?php

namespace App\Repositories\Shop\Alert;

use App\Models\Alert\ShopProfileAlertSynonym as Model;
use App\Repositories\CoreRepository;

/**
 * Class AlertSynonymsRepository
 *
 * @package App\Repositories
 */
class AlertSynonymsRepository extends CoreRepository
{

    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    public function destroyAll()
    {
        return $this->startConditions()->where('user_id', auth()->id())->delete();
    }

    public function storeCollection($data)
    {
        foreach ($data as $synonym => $select)
        {
            $this->startConditions()->create([
                'user_id' => auth()->id(),
                'name' => $synonym,
                'select' => $select
            ]);
        }
    }

}