<?php

namespace App\Repositories\Location;

use App\Models\City as Model;
use App\Repositories\CoreRepository;

/**
 * Class CitiesIndexRepository
 *
 * @package App\Repositories
 */
class CitiesIndexRepository extends CoreRepository
{

    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить все города
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->startConditions()->all();
    }

    /**
     * Получить пагинацию городов
     *
     * @param int $count
     * @return mixed
     */
    public function getForComboPaginate(int $count)
    {
        return $this->startConditions()->paginate($count);
    }

    /**
     * Сохранить город
     *
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->startConditions()->create($data);
    }

    /**
     * Удалить город по $id
     *
     * @param $id
     */
    public function destroy($id)
    {
        $city = $this->startConditions()->find($id);
        $city->delete();
    }

}