<?php

namespace App\Repositories\Transport\Cars;

use App\Models\Transport\TransportCarMark as Model;
use App\Repositories\CoreRepository;

/**
 * Class MarksRepository
 *
 * @package App\Repositories
 */
class MarksRepository extends CoreRepository
{

    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить все марки
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
        $marks = $this->startConditions()->paginate($count);

        return $marks;
    }

    /**
     * Получить марку по $id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Получить марки с логотипом
     *
     * @return mixed
     */
    public function getPublished()
    {
        return $this->startConditions()
            ->where('published', true)
            ->get();
    }

    /**
     * Получить модели машин через отношение hasMany
     *
     * @param $mark_name_or_mark_id
     * @return |null
     */
    public function getMarkModels($mark_name_or_mark_id)
    {
        $mark = $this->startConditions()
                        ->where('title', '=', $mark_name_or_mark_id)
                        ->orWhere('id', $mark_name_or_mark_id)
                        ->first();

        if (!empty($mark) && $mark->count() > 0) return $mark->transport_car_models()->get();

        return null;
    }

    /**
     * Создать марку
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->startConditions()->create($data);
    }

}