<?php

namespace App\Repositories\Admin\Proposal;

use App\Models\Proposal as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;
use Illuminate\Support\Carbon;

/**
 * Class ProposalIndexRepository
 *
 * @package App\Repositories
 */
class ProposalIndexRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить все поданные заявки для пользователя с пагинацией
     *
     * @return Collection
     */
    public function getForComboPaginate(int $count)
    {

       return $this->startConditions()->paginate($count);

    }

    /**
     * Получить поданные заявки для пользователя по Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {

        return $this->startConditions()->findOrFail($id);

    }

    /**
     * Создание заявки
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->startConditions()->create( array_merge($data, ['user_id' => auth()->id(), 'city' => 'Иркутск', 'phone' => auth()->user()->login]));
    }

    /**
     * Обновление заявки
     *
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, int $id)
    {
        return $this->startConditions()->find($id)
                                        ->update($data);
    }

}