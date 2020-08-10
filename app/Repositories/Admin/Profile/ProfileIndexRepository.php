<?php

namespace App\Repositories\Admin\Profile;

use App\Models\UserSettings\AdminSetting as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

use Cache;

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

    public function getByUserId($user_id)
    {
        $settings = $this->startConditions()->where('user_id', $user_id)->first();

        return $settings;
    }

    /**
     * @param $request
     */
    public function update($request)
    {

        if (isset($request->policy)) {

            auth()->user()->isPolicy();

            $login_settings_user = $this->startConditions()->where('user_id', auth()->id());

            $request = $request->except('_token', '_method', 'policy', 'phone');

            if ($login_settings_user->count() > 0)
            {
                $login_settings_user->update($request);
            }else
            {
                $login_settings_user->create(
                    array_merge($request, ['user_id' => auth()->id()])
                );
            }


        }

    }


}