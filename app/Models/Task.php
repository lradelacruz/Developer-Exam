<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'assigned_user_id',
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'archived',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    /**
     * Get the user who created the task.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user to whom the task is assigned.
     */
    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    /**
     * Get the prerequisites for the task.
     */
    public function prerequisites(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_prerequisites', 'task_id', 'prerequisite_task_id');
    }

    /**
     * Get the dependents of the task.
     */
    public function dependents(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_prerequisites', 'prerequisite_task_id', 'task_id');
    }

    /**
     * Get the comments for the task.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
