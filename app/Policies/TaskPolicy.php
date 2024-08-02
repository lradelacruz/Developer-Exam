<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;

class TaskPolicy
{
    /**
     * Determine if the user can create tasks.
     */
    public function create(User $user)
    {
        return $user->hasPermission('create-task');
    }

    /**
     * Determine if the user can update the task.
     */
    public function update(User $user, Task $task)
    {
        return $user->hasPermission('update-task') || $task->user_id === $user->id;
    }

    /**
     * Determine if the user can delete the task.
     */
    public function delete(User $user, Task $task)
    {
        return $user->hasPermission('delete-task');
    }

    /**
     * Determine if the user can assign the task.
     */
    public function assign(User $user)
    {
        return $user->hasPermission('assign-task');
    }
}
