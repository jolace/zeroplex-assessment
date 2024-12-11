<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Collection;

class TaskService
{
    /**
     * @param array $data
     *
     * @return \App\Models\Task
     */
    public function insert(array $data): Task
    {
        $task = new Task;
        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->due_date = $data['due_date'];
        $task->save();

        return $task;
    }

    /**
     * @param \App\Models\Task $task
     * @param array $data
     *
     * @return \App\Models\Task
     */
    public function update(Task $task, array $data): Task
    {
        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->due_date = $data['due_date'];
        $task->status = $data['status'];
        $task->save();

        return $task;
    }

    /**
     * @param \App\Models\Task $task
     *
     * @return bool
     */
    public function delete(Task $task): bool
    {
        return $task->delete();
    }

    /**
     * @param \App\Models\Task $task
     * @param array $data
     *
     * @return \App\Models\Comment
     */
    public function insertComment(Task $task, array $data): Comment
    {
        $comment = new Comment;
        $comment->comment = $data['comment'];
        $comment = $task->comments()->save($comment);

        return $comment;
    }

    /**
     * @param array $parameters
     *
     * @return array
     */
    public function dataTableOutput(array $parameters, User $user): array
    {

        $tasks = Task::query();

        if (! empty($parameters['due_date'])) {
            $tasks = $tasks->where('due_date', $parameters['due_date']);
        }

        if (! empty($parameters['status'])) {
            $tasks = $tasks->where('status', $parameters['status']);
        }

        if(!$user->hasRole('Admin'))
        {
            $tasks = $tasks->where('user_id', $user->id);
        }

        $recordsTotal = $tasks->count();

        $tasks = $tasks->offset($parameters['start'])
            ->limit($parameters['length'])
            ->get();

        return [
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $tasks->count(),
            'data' => $this->mapDataForDataTable($tasks),
        ];
    }

    /**
     * @param \Illuminate\Support\Collection $tasks
     *
     * @return \Illuminate\Support\Collection
     */
    private function mapDataForDataTable(Collection $tasks): Collection
    {
        return $tasks->map(function ($task) {
            return [
                $task->title,
                $task->description,
                $task->due_date,
                $task->status->label(),
                $task->id,
            ];
        });
    }
}
