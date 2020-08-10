<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

//Models
use App\Models\User;
use App\Models\Proposal;

class RegisterController extends Controller
{
    public function makeproposal(Request $request)
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
        
        $innings = new Proposal;

        if ( $user = User::wherePhone($request->phone)->first() ):

            $innings->user_id = $user->id;
            $innings->model = $request->model;
            $innings->mark = $request->marka;
            $innings->g_v = $request->god;
            $innings->vin = $request->number_engine;
            $innings->number_engine = $request->vin;
            $innings->spare_parts = $request->spare_parts;
            $innings->phone = $request->phone;
            $innings->city = $request->city;
            $innings->save();
            
            
        else:
            
            $pass = generatePIN(6);
            
            $user = User::create(
                [
                    'phone' => $request->phone,
                    'password' => Hash::make($pass),
                ]
            );
            
            $innings->user_id = $user->id;
            $innings->model = $request->model;
            $innings->mark = $request->marka;
            $innings->g_v = $request->god;
            $innings->vin = $request->vin;
            $innings->number_engine = $request->number_engine;
            $innings->spare_parts = $request->spare_parts;
            $innings->phone = $request->phone;
            $innings->city = $request->city;
            $innings->save();
            
            $client = new \Zelenin\SmsRu\Api(new \Zelenin\SmsRu\Auth\LoginPasswordAuth('89148994146', 'Qazxsw34'));
            $passSendText = new \Zelenin\SmsRu\Entity\Sms($request->phone, 'Авторазборов.рф - Логин: '. $request->phone .' Пароль: '.$pass);
            
            $client->smsSend($passSendText);

        endif;
            
    }
}
