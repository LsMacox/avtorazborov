<?php

use Illuminate\Database\Seeder;

use App\Models\PushNotificationToken;

class PushNotificationTokensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getTokens = file_get_contents(storage_path('app/json/push_notification_tokens.json'));
        $tokens = json_decode($getTokens);

        foreach($tokens as $token){
            $tokenDb = new PushNotificationToken;
            $tokenDb->user_id = $token->user_id;
            $tokenDb->token = $token->token;
            $tokenDb->created_at = $token->created_at;
            $tokenDb->updated_at = $token->updated_at;
            $tokenDb->save();
        }
    }
}
