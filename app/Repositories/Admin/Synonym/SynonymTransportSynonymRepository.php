<?php

namespace App\Repositories\Admin\Synonym;

use App\Models\Synonym\SynonymTransportSynonym as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class SynonymTransportSynonymRepository
 *
 * @package App\Repositories
 */
class SynonymTransportSynonymRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить все синонимы с пагинацией
     *
     * @return Collection
     */
    public function getForComboPaginate(int $count)
    {
        return $this->startConditions()->paginate($count);
    }

    /**
     * Получить синоним по Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->startConditions()->findOrFail($id);
    }

    /**
     * Создание синонима
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->startConditions()->create($data);
    }


    /**
     * Обновление синонима
     *
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, int $id)
    {
        //
    }

}