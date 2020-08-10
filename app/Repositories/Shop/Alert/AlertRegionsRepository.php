<?php

namespace App\Repositories\Shop\Alert;

use App\Models\Alert\ShopProfileAlertRegion as Model;
use App\Repositories\CoreRepository;

/**
 * Class AlertRegionsRepository
 *
 * @package App\Repositories
 */
class AlertRegionsRepository extends CoreRepository
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

    public function store($data)
    {
        return $this->startConditions()->store($data);
    }

    public function storeCollection($data)
    {
        foreach ($data as $region)
        {
            $this->startConditions()->create([
                'user_id' => auth()->id(),
                'name' => $region
            ]);
        }
    }

}