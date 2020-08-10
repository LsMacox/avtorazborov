<?php

namespace App\Models;

class PushNotificationToken extends BaseModel
{
    protected $table = 'push_notification_tokens';
    
    protected $fillable = ['user_id', 'token'];
    
}
