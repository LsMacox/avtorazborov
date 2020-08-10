<?php

namespace App\Repositories\PushNotification;

use App\Models\PushNotificationToken as Model;
use App\Repositories\CoreRepository;

/**
 * Class PushNotificationIndexRepository
 *
 * @package App\Repositories
 */
class PushNotificationIndexRepository extends CoreRepository
{

    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить токен по $user_id
     *
     * @param $user_id
     * @return mixed
     */
    public function getByUserId($user_id)
    {
        $token = $this->startConditions()->where('user_id', $user_id);

        return $token;
    }

    /**
     * Создать токен
     *
     * @param $token
     */
    public function createToken($token)
    {
        $token = $this->getByUserId(auth()->id());

        if ($token->count() == 0)
        {
            $this->startConditions()->create(['user_id' => auth()->id(), 'token' => $token]);
        }
    }

    /**
     * Отправить уведомление по $user_id
     *
     * @param $user_id
     * @param $proposal
     * @param $proposal_id
     */
    public function sendPushMessage($user_id, $proposal, $proposal_id)
    {
        $token_rows = $this->getByUserId($user_id);

        if( !empty($token_rows) )
        {
            $tokens	= [];

            foreach($token_rows->cursor() as $token_row)
            {
                $tokens[] = $token_row->token;
            }

            $headers =
                [
                    'Content-type: application/json',
                    'Authorization: key=AIzaSyCpDbBinPr5y08ihHYr_CsvO1nETXX_1LU'
                ];

            $user_order	= $proposal;

            $car_full_name = $user_order->mark .' ' .$user_order->model;

            # client/regular user
            if(!empty(auth()->user()->hasRole('shop')))
            {
                $message_body = 'Клиент ответил на ваше предложение по ' .$car_full_name;
            }
            # Manager/admin user
            else
            {
                $message_body = 'По вашей заявке на поиск запчастей для ' .$car_full_name .' получен ответ от "Автодеталька"';
            }

            $parameters	=
                [
                    'registration_ids'	=>$tokens,
                    'notification'		=>
                        [
                            'title'	=>'Cообщение от Авторазборов',
                            'body'	=> $message_body,
                            'icon'	=>  url('logo-big.png'),

                            'redirect_URL'	=> url('cabinet/proposal/') .$proposal_id
                        ],
                    'data'				=>
                        [
                            'redirect_URL'	=> url('cabinet/proposal/') .$proposal_id
                        ]
                ];

            $ch = curl_init('https://fcm.googleapis.com/fcm/send');

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($parameters) );

            $output = curl_exec($ch);
            curl_close($ch);
        }
    }

}