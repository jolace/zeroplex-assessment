<?php

namespace App\Console\Commands;

use App\Enums\Task\StatusEnum;
use App\Models\Task;
use App\Notifications\TaskDueNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendTaskDueNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:send-due-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications to users when a task is due';

    /**
     * Get data in chunks.
     *
     * @var string
     */
    private string $batchSize;

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Sending email notifications to users with due tasks.');

        $this->batchSize = config('tasks.command_chunk_batch_size');

        Task::whereDate('due_date', '<=', Carbon::today())
            ->where('status', '!=', StatusEnum::COMPLETED)
            ->with('user')
            ->chunk($this->batchSize, function ($tasks) {
                foreach ($tasks as $task) {
                    $text = $this->prepareEmailText($task);
                    $task->user->notify((new TaskDueNotification($text)));
                }
            });

        $this->info('Email notifications sent successfully.');
    }

    /**
     * @param Task $task
     *
     * @return string
     */
    private function prepareEmailText(Task $task): string
    {
        $dueDate = Carbon::parse($task->due_date);

        return $dueDate->isToday() ? 'Reminder: Your task "'.$task->title.'" is due today. Don\'t forget to complete it!'
                                   : 'Reminder: Your task "'.$task->title.'" was due on '.$task->due_date.'.
                                  Please ensure it\'s completed as soon as possible.';
    }
}
