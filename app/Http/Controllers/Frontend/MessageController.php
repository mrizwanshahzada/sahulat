<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Events\SendMessageEvent;
use App\Models\Message;
use App\Models\Task;
use Auth;
class MessageController extends FrontendController
{
    private $_message;
    private $_task;

    /**
     * MessageController constructor.
     * @param Message $message
     */
    public function __construct(Message $message, Task $task)
    {
        $this->_message = $message;
        $this->_task = $task;
    }

    /**
     * @param $taskId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function index($taskId){
        $task = $this->_task->find($taskId);
        $user = Auth::user();

        $receiver_id = $this->authorizeForChat($user, $task);

        if ($receiver_id != Null) {
            $messages = $this->_message->fetchMessages($task->id);
            return view('frontend.pages.chat')->with('data', ['task'=>$task, 'messages'=>$messages, 'receiver_id'=>$receiver_id]);
        }else
        {
            return redirect()->back();
        }

    }

    /**
     * @param Request $request
     */
    public function sendMessage(Request $request){
        $message = $this->_message->store($request);
        broadcast(new SendMessageEvent($message, $message->sender, $message->receiver, $message->task->id));
    }

    /**
     * @param $user
     * @param $task
     * @return |null
     */
    public function authorizeForChat($user, $task)
    {
        $role = $user->role;
        switch ($role) {
            case 'Customer':
                if ($user->id === $task->user->id) {
                    if ($task->vendor_id == Null) {
                        return $task->employee->user->id;
                    }else{
                        return $task->vendor->user->id;
                    }
                }
                break;

            case 'Vendor':
                if ($user->id === $task->vendor->user->id) {
                    return $task->user->id;
                }
                break;

            case 'Employee':
                if ($user->id === $task->employee->user->id) {
                    return $task->user->id;
                }
                break;

            default:
                return Null;
                break;
        }
    }
}
