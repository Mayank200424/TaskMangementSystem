<?php

namespace App\Jobs;

use App\Models\Task;
use App\Mail\PendingTaskMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;

class SendPendingTaskEmailJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;
    protected $task;

    /**
     * Create a new job instance.
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            if (!$this->task->relationLoaded('user') || !$this->task->user) {
                Log::error('Task user not found: ' . $this->task->id);
                return;
            }

            Mail::to($this->task->user->email)->send(new PendingTaskMail($this->task));
        } catch (\Exception $e) {
            Log::error('Email job failed: ' . $e->getMessage());
            $this->fail($e);
        }
        //Mail::to($this->task->user->email)->send(new PendingTaskMail($this->task));
    }
}
