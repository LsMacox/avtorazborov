<?php

namespace App\Repositories\User\Profile;

use App\Models\UserSettings\UserSetting as Model;
use App\Repositories\CoreRepository;

/**
 * Class ProfileIndexRepository
 *
 * @package App\Repositories
 */
class ProfileIndexRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить профиль пользователя
     *
     * @param $user_id
     * @return mixed
     */
    public function getProfile()
    {
        return $this->startConditions()->where('user_id', auth()->id())->first();
    }

    /**
     * Обновить настроки пользователя
     *
     * @param $request
     */
    public function update($request)
    {
        $request['email_notify'] = isset($request->email_notify);

        if (isset($request->policy)) {

            auth()->user()->isPolicy();

            $login_settings_user = $this->startConditions()->where('user_id', auth()->id());

            $request = $request->except('_token', '_method', 'policy', 'phone');

            if ($login_settings_user->count() > 0)
            {
                $login_settings_user->update($request);
            }
            else
            {
                $login_settings_user->create(
                    array_merge($request, ['user_id' => auth()->id()])
                );
            }

        }

    }


}