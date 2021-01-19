<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Task;
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
Broadcast::channel('user.{toUser}', function ($user, $toUser) {
    return $user->id === $toUser;
});

Broadcast::channel('chat.{id}', function ($user, $id) {
	$task = Task::find($id);
	$checkAuth = false;
    if ($user->id === $task->user_id) {
        $checkAuth = true;
    }
    if ($task->vendor != Null){
        if ($user->id === $task->vendor->user_id) {
            $checkAuth = true;
        }
    }
    if ($task->employee != Null){
        if ($user->id === $task->employee->user_id) {
            $checkAuth = true;
        }
    }

    return $checkAuth;
});
