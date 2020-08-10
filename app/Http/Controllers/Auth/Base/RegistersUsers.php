<?php

namespace App\Http\Controllers\Auth\Base;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

trait RegistersUsers 
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request['login'] = (int) preg_replace('/\D/', '', $request->login);

        $this->validator($request->all())->validate();

        $user_password = str_random(8);
        $user = $this->create($request->all(), $user_password);

        # Событие при регистрации
        //event(new Registered($user = $this->create($request->all(), $user_password)));

        # Автовход после регистрации
        // $this->guard()->login($user);

        # Отправка sms на моб. телефон
        $sms_response = $this->sendSms($request->login, 'Ваш пароль: '.$user_password);

        # Редирект после регистрации
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    public function registerPartners(Request $request){
        
        // $this->validatorPartners($request->all())->validate();
        
        $data_phone = $request->input('tel');
        $regexp='@(\d)(\s*)\((\d{3})\)(\s*)(\d{3})\-(\d{2})\-(\d{2})@';
        if(preg_match($regexp,$data_phone,$matches)==1){
            $phone_res = sprintf("%s%s%s%s%s\n",$matches[1], $matches[3],$matches[5],$matches[6],$matches[7]);
        }

        $client = new \Zelenin\SmsRu\Api(new \Zelenin\SmsRu\Auth\LoginPasswordAuth('89148994146', 'Qazxsw34'));
        $passw = str_random(8);
        $passSendText = new \Zelenin\SmsRu\Entity\Sms( $phone_res, 'Ваш пароль: '.$passw);
        event(new Registered($user = $this->createPartners($request->all(), $passw)));
        
        $client->smsSend($passSendText);

       return $this->registered($request, $user);
    }

    public function sendSms($phone, $text)
    {
        $client = new \Zelenin\SmsRu\Api(new \Zelenin\SmsRu\Auth\LoginPasswordAuth(env('ZELENIN_SMS_LOGIN'), env('ZELENIN_SMS_PASSWORD')));
        $passSendText = new \Zelenin\SmsRu\Entity\Sms($phone, $text);

        $sms_response = $client->smsSend($passSendText);

        return $sms_response;
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
