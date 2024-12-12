<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Task $task
     * 
     * @return bool
     */
    public function view(User $user, Task $task): bool
    {
        return $user->id == $task->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Task $task
     * 
     * @return bool
     */
    public function update(User $user, Task $task): bool
    {
        return $user->id == $task->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Task $task
     * 
     * @return bool
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->id == $task->user_id;
    }
}
