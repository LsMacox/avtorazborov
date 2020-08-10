<?php

namespace App\Repositories\Shop\Profile;

use App\Models\UserSettings\ShopSetting as Model;
use App\Repositories\CoreRepository;

use MediaUploader;
use Cookie;

/**
 * Class ProfileIndexRepository
 *
 * @package App\Repositories
 */
class ProfileIndexRepository extends CoreRepository
{

    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Обновить профиль
     *
     * @param $request
     */
    public function update($request)
    {
        if (isset($request->policy)) {

            # Получение пользователских настроек
            $shop_settings = auth()->user()->shop_setting;

            if ( isset($shop_settings) ) // Если пользовательские настройки существуют
            {

                if (!Cookie::get('policy'))
                {
                    auth()->user()->isPolicy();
                }

                # Обновление таблицы пользовательских настроек
                $shop_settings->update(array_merge( $request->except('_token', '_method'),
                    [
                        'schedule' => $this->jsonEncoderTimeWork($request),
                        'email_notify' => isset($request->email_notify)
                    ]
                ));

            }else{

                # Создания новой таблицы пользовательских настроек
                $this->startConditions()->create(array_merge( $request->except('_token', '_method'),
                    [
                        'user_id' => auth()->id(),
                        'schedule' => $this->jsonEncoderTimeWork($request),
                        'email_notify' => isset($request->email_notify)
                    ]
                ));

            }

            # Сохранения изображений из формы
            $this->saveImages($request);

        }

    }

    /**
     * Преоброзования дней работ в json
     *
     * @param $request
     * @return false|string
     */
    public function jsonEncoderTimeWork($request)
    {
        return $schedule = json_encode(
            [
                'working_days' =>
                    [
                        'Mo' => isset($request->days['Mo']),
                        'Tu' => isset($request->days['Tu']),
                        'We' => isset($request->days['We']),
                        'Th' => isset($request->days['Th']),
                        'Fr' => isset($request->days['Fr']),
                        'Sa' => isset($request->days['Sa']),
                        'Su' => isset($request->days['Su']),
                    ],
                'times_work' =>
                    [
                        'start_weekdays' => $request->start_weekdays,
                        'end_weekdays' => $request->end_weekdays,
                        'start_weekends' => $request->start_weekends,
                        'end_weekends' => $request->end_weekends,
                    ]
            ]
        );
    }

    /**
     * Сохранение изоображений
     *
     * @param $request
     */
    public function saveImages($request)
    {
        if ($request->hasFile('avatar')) {
            MediaUploader::oneImageUpload($request->file('avatar'), 'avatar', auth()->id(), ['resize' => ['width' => 100, 'height' => 100]]);
        }
        if ($request->hasFile('gallery-images')) {
            MediaUploader::multiImageUpload($request->file('gallery-images'), 'gallery', auth()->id(), ['resize' => [ ['width' => 150, 'height' => 150], ['width' => 300, 'height' => 300] ]]);
        }
    }

}