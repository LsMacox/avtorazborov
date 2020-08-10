<?php

namespace App\Repositories\Proposal;

use App\Models\Proposal as Model;
use App\Repositories\CoreRepository;

// Models
use App\Models\Message;

/**
 * Class ProposalIndexRepository
 *
 * @package App\Repositories
 */
class ProposalIndexRepository extends CoreRepository
{

    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить все поданные заявки
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->startConditions()->all();
    }

    /**
     * Получить все поданные заявки для пользователя с пагинацией
     *
     * @param int $count
     * @return mixed
     */
    public function getForComboPaginate(int $count)
    {
        return $this->startConditions()->paginate($count);
    }

    /**
     * Получить поданные заявки для пользователя по $id
     *
     * @param int $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Получить Отвеченные заявки
     *
     * @return mixed
     */
    public function getAnsweredProposals()
    {
        $messages = Message::where('from', auth()->id())->get();

        $proposals = $this->startConditions()->get();

        $proposals = $proposals
                            ->filter(function($proposal) use ($messages) {
                                 foreach ($messages as $message)
                                 {
                                     return $proposal->id === $message->proposal_id;
                                 }
                            });

        return $proposals;

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
                                        ->where('user_id', auth()->id())
                                        ->update($data);
    }

    public function getLatest($count)
    {
        return $this->startConditions()->take($count)->latest()->get();
    }


}