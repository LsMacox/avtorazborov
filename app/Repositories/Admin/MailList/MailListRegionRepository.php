<?php

namespace App\Repositories\Admin\MailList;

use App\Models\Alert\ShopProfileAlertRegion as Model;
use App\Repositories\CoreRepository;

/**
 * Class MailListRegionRepository
 *
 * @package App\Repositories
 */
class MailListRegionRepository extends CoreRepository
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

    public function store($data)
    {
        return $this->startConditions()->create($data);
    }

    public function destroyAll()
    {
        return $this->startConditions()->where('user_id', auth()->id())->delete();
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