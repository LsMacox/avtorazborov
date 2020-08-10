<?php

use Illuminate\Database\Seeder;

use App\Models\PushNotificationToken;

class PushNotificationTokensDbToJson extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $token = PushNotificationToken::all();

        $tokens = json_encode($token);

        Storage::put('json/push_notification_tokens.json', $tokens);
    }
}
