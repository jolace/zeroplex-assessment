<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Comment
 *
 * @property int $id The unique identifier for the comment.
 * @property int $task_id The ID of the task that this comment belongs to.
 * @property int $user_id The ID of the user who created the comment.
 * @property string $comment The content of the comment.
 * @property \Illuminate\Support\Carbon $created_at The timestamp when the comment was created.
 * @property \Illuminate\Support\Carbon $updated_at The timestamp when the comment was last updated.
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo task() Defines the relationship with the Task model.
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo user() Defines the relationship with the User model.
 */
class Comment extends Model
{
    protected static function booted()
    {
        static::creating(function ($task) {
            if (! $task->user_id) {
                $task->user_id = Auth::id();
            }
        });
    }
    
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
