<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Auth;

class Message extends Model
{
    public function sender(){
        return $this->belongsTo(User::class);
    }

    public function receiver(){
        return $this->belongsTo(User::class);
    }

    public function task(){
        return $this->belongsTo(Task::class);
    }

    protected $fillable = [
        'message', 'sender_id', 'receiver_id', 'task_id',
    ];

    /**
     * @param $request
     * @return mixed
     */
    public function store($request){
        return $this->create($request->all());
    }

    /**
     * @param $id
     * @return Message[]|\Illuminate\Database\Eloquent\Collection
     */
    public function fetchMessages($id)
    {
        $messages = $this->all()->where('task_id', $id);
        return $messages;
    }
}
