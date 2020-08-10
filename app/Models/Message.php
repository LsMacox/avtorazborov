<?php

namespace App\Models;

use App\Models\User;
use Cache;

class Message extends BaseModel
{
    protected $fillable = [
        'from',
        'to',
        'proposal_id',
        'file_status',
        'file_path',
        'read',
        'text',
        'admin'
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected $guarded = [];

    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }
    
    public static function unreadMessage(){
        if (!Cache::has('unreadMessageCount'))
        {
            $unreadCount = Message::where('to', auth()->id())->where('read', 0)->count();
            Cache::forever('unreadMessageCount', $unreadCount);
        }else {
            $unreadCount = Cache::get('unreadMessageCount');
        }
        return $unreadCount;
    }
    
}
