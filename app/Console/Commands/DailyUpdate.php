<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Models\Task;
use App\Models\User;
use Illuminate\Console\Command;

class DailyUpdate extends Command
{
    private $_task;
    private $_user;
    private $_subscription;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command performs daily based jobs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Task $task, User $user, Subscription $subscription)
    {
        parent::__construct();
        $this->_task = $task;
        $this->_user = $user;
        $this->_subscription = $subscription;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->_subscription->expireSubscription();
        $this->_task->createSubscriptionTasks();
        $this->_user->notifyForSubscriptionRenew();
    }
}
