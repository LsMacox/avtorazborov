<?php

namespace App\Models;

use http\Env\Request;

class Help extends BaseModel
{
    protected $fillable = ['route', 'text', 'role'];

    protected $guarded = [];

    public static function getRoutes($route = null){
        $routes = [
            'user' => [
                'title' => 'Пользователя',
                'routes' => [
                    'user.proposal.index' => 'Заявки на запчасти',
                    'user.proposal.show' => 'Отображение заявки',
                    'user.proposal.edit' => 'Редактирование заявки',
                    'user.proposal.create' => 'Создание заявки',
                    'user.profile.index' => 'Профиль',
                ]
            ],
            'shop' => [
                'title' => 'Авторазборки',
                'routes' => [
                    'shop.proposal.index' => 'Заявки на запчасти',
                    'shop.proposal.answers' => 'Ответы на заявки',
                    'shop.proposal.show' => 'Отображение заявки',
                    'shop.profile.index' => 'Профиль',
                    'shop.profile.transport-in-stock.index' => 'Машины в наличии',
                    'shop.profile.alert.index' => 'Оповещения',
                ]
            ]
        ];

        if($route!=null) return $routes[$route];
            else
            return $routes;
    }
}
