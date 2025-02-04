<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('users.{id}', function (User $user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{id}', function(User $user, $id){
    return (int) $user->id === (int) $id;
});

Broadcast::channel('order-dispatch.{id}', function(User $user, $id){
    return (int) $user->id === (int) $id;
});
