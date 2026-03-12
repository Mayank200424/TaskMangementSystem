<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Jobs\SendPendingTaskEmailJob;

class SendPendingTasksCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-pending-tasks-command';
    protected $description = 'Send emails for pending tasks';

    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::with('user')->where('status', 'pending')->whereHas('user')->get();

        foreach ($tasks as $task) {
            if ($task->user) {
                dispatch(new SendPendingTaskEmailJob($task));
            }
        }

        $this->info('Pending task emails dispatched successfully.');
    }
}
