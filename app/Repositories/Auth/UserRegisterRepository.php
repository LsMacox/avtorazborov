<?php

namespace App\Repositories\Auth;

use App\Models\UserSettings\UserSetting as Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

use Cache;

/**
 * Class ProfileIndexRepository
 *
 * @package App\Repositories
 */
class UserRegisterRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param $request
     */
    public function create($data)
    {

        $this->startConditions()->create(
            array_merge($data, ['user_id' => $data['user_id']])
        );

    }


}