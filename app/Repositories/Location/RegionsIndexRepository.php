<?php

namespace App\Repositories\Location;

use App\Models\Region as Model;
use App\Repositories\CoreRepository;

/**
 * Class RegionsIndexRepository
 *
 * @package App\Repositories
 */
class RegionsIndexRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить все регионы
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->startConditions()->all();
    }

    /**
     * Получить пагинацию регионов
     *
     * @param int $count
     * @return mixed
     */
    public function getForComboPaginate(int $count)
    {
        return $this->startConditions()->paginate($count);
    }

    /**
     * Сохранить регионы
     *
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->startConditions()->create($data);
    }

    /**
     * Удалить регион по $id
     *
     * @param $id
     */
    public function destroy($id)
    {
        $region = $this->startConditions()->find($id);

        $region->delete();
    }

}