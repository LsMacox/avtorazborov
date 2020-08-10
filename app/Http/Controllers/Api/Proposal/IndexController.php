<?php

namespace App\Http\Controllers\Api\Proposal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\Innings\IndexRequest;

//Models
use App\Models\User;

class IndexController extends Controller
{
    public function store(IndexRequest $request)
    {
        $request['phone'] = (integer) preg_replace("/[^0-9]/", "", $request['phone']);
        
        if ($user = User::wherePhone($request->phone)->first())
        {
           return response()->json($request);
        }else{
            return response()->json($request);
            // function generatePIN($digits = 6){
            // $i = 0; //counter
            // $pin = ""; //our default pin is blank.
            // while($i < $digits){
            //     //generate a random number between 0 and 9.
            //     $pin .= mt_rand(0, 9);
            //     $i++;
            // }
            // return $pin;
            // }
        
            
            // $pass = generatePIN(6);
            
            // $user = User::create(
            // [
            //     'phone' => $request->phone,
            //     'password' => Hash::make($pass),
            //     'purpose' => 1
            // ]);
                    
            // $client = new \Zelenin\SmsRu\Api(new \Zelenin\SmsRu\Auth\LoginPasswordAuth('89148994146', 'Qazxsw34'));
            // $passSendText = new \Zelenin\SmsRu\Entity\Sms($request->phone, 'Авторазборов.рф - Логин: '. $request->phone .' Пароль: '.$pass);
            
            // $client->smsSend($passSendText); 
        }
        
        

    }
}