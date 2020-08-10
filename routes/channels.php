<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('messages.{user_id}.{proposal_id}', function ($user, $user_id, $proposal_id) {
    if (auth()->user()->hasRole('admin')) return true;
    return $user->id === (int)$user_id;
});
