<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


//Models
use App\User;

class RegisterPartnersController extends Controller
{
    public function registerPartners(Request $request)
    {
        $request['phone'] = (integer) preg_replace("/[^0-9]/", "", $request['phone']);

        
        function generatePIN($digits = 6){
            $i = 0; //counter
            $pin = ""; //our default pin is blank.
            while($i < $digits){
                //generate a random number between 0 and 9.
                $pin .= mt_rand(0, 9);
                $i++;
            }
            return $pin;
        }
    
        
        $pass = generatePIN(6);
        
        User::create(
        [
            'phone' => $request->phone,
            'password' => Hash::make($pass),
            'purpose' => 1
        ]);
                
        $client = new \Zelenin\SmsRu\Api(new \Zelenin\SmsRu\Auth\LoginPasswordAuth('89148994146', 'Qazxsw34'));
        $passSendText = new \Zelenin\SmsRu\Entity\Sms($request->phone, 'Авторазборов.рф - Логин: '. $request->phone .' Пароль: '.$pass);
        
        $client->smsSend($passSendText);

    }
}