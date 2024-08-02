<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Other existing methods and properties

    /**
     * Get the tasks created by the user.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id');
    }

    /**
     * Get the tasks assigned to the user.
     */
    public function assignedTasks()
    {
        return Task::where('assigned_user_id', $this->id);
    }
    
    public function hasPermission($permission)
    {
        if (is_null($this->permissions) || !is_array($this->permissions)) {
            return false;
        }
        return in_array($permission, $this->permissions);
    }
}
