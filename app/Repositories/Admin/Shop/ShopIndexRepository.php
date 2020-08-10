<?php

namespace App\Repositories\Admin\Shop;

use App\Models\UserSettings\ShopSetting as Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class ProfileIndexRepository
 *
 * @package App\Repositories
 */
class ShopIndexRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getUserById($id)
    {
        $user = User::with('roles')
            ->whereHas('roles', function($query) {
                $query->where('name', 'shop');
            })->find($id);

        return $user;
    }

    public function getUserAll()
    {

        $users = User::with('roles')
                        ->whereHas('roles', function($query) {
                            $query->where('name', 'shop');
                        })->get();

        return $users;
    }


    public function getById($id)
    {
        $user_setting = $this->startConditions()
                                ->where('user_id', $id)
                                ->get();

        $user = $this->getUserById($id);

        if ($user_setting->count() > 0)
        {
            $user_setting = $user_setting->map(function ($user_setting) use ($user) {
                $user_setting->login = $user->login;

                return $user_setting;
            });

            return $user_setting->first();
        }

        return $user;

    }

    public function update($data, $id)
    {
        $user_setting = $this->startConditions()->where('user_id', $id)->get();
        if ($user_setting->count() > 0)
        {
            $user_setting->first()->update($data);
        }
        else
        {
            $this->startConditions()->create(array_merge($data, ['user_id' => $id]));
        }

        return $user_setting->first();
    }

    public function destroy($id)
    {
        $user_settings = $this->startConditions()->where('user_id', $id)->get();
        $user = $this->getUserById($id);

        if ($user_settings->count() > 0)
            $user_settings->first()->delete();

        $user->delete();
    }

    public function getAll()
    {
        $users_settings = $this->startConditions()->all();

        $users = $this->getUserAll();

        if ($users_settings->count() > 0)
        {
            $users_settings = $users_settings->map(function ($users_setting) use ($users) {

                $user = $users->find($users_setting->user_id);

                $users_setting->login = $user->login;

                return $users_setting;
            });

            return $users_settings->all();
        }

        return $users;
    }

    public function getForComboPaginate($count)
    {
        $users_settings = $this->startConditions()->all();
        $users = $this->getUserAll();


        if ($users_settings->count() > 0)
        {
            $users_settings = $users_settings->map(function ($users_setting) use ($users) {

                $user = $users->find($users_setting->user_id);

                $users_setting->login = $user->login;

                return $users_setting;
            });

            return $users_settings->paginate($count);
        }

        return $users->paginate($count);
    }


}