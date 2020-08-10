<?php

namespace App\Repositories\Transport\Cars;

use App\Models\Transport\TransportCarModel as Model;
use App\Repositories\CoreRepository;

/**
 * Class ModelsRepository
 *
 * @package App\Repositories
 */
class ModelsRepository extends CoreRepository
{
    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить все модели
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->startConditions()->all();
    }

    /**
     * Получить пагинацию в $count кол-ве
     *
     * @param $count
     * @return mixed
     */
    public function getForComboPaginate($count)
    {
        return $this->startConditions()->paginate($count);
    }

    /**
     * Получить модель по $id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Создание модели
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->startConditions()->create($data);
    }

}