<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Command;
use App\Models\Task;
use App\Models\User;

class AssignTask extends Command
{
    private $_task;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign a task to employee';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        parent::__construct();
        $this->_task = $task;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->_task->assignTasks();
    }
}
