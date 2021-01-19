<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    private $_task;

    /**
     * TasksController constructor.
     * @param Task $task
     */
    public function __construct(Task $task){
        $this->_task = $task;
    }

    /**
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewTasks($type){
        $tasks = $this->_task->getTasks($type);
        return view('backend.task.view-tasks')->with('data', ['tasks' => $tasks, 'type' => $type]);
    }
}
