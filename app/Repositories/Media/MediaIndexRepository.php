<?php

namespace App\Repositories\Media;

use App\Models\Media as Model;
use App\Repositories\CoreRepository;

/**
 * Class MediaIndexRepository
 *
 * @package App\Repositories
 */
class MediaIndexRepository extends CoreRepository
{

    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить media по $user_id
     *
     * @param $user_id
     * @return mixed
     */
    public function getImagesByUserId($user_id)
    {
        return $this->startConditions()->where('user_id', $user_id)->get();
    }

    /**
     * Получить media по $user_id и названию
     *
     * @param $designation
     * @param $user_id
     * @return mixed
     */
    public function getImageByDesignation($designation, $user_id)
    {
        return $this->startConditions()
                        ->where('user_id', $user_id)
                        ->where('designation', $designation)
                        ->first();
    }

}