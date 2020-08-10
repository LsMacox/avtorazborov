<?php


namespace App\Repositories;

/**
 * Class CoreRepository
 *
 * @package App\Repositories
 *
 * Репозиторий работы с сущностью.
 * Может выдавать наборы данных.
 * Не может создовать/изменять сущности.
 */
abstract class CoreRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * CoreRepository constructor
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @returm Model\Illuminate\Foundation\Application\mixed
     */
    protected function startConditions()
    {
        return clone $this->model;
    }


}