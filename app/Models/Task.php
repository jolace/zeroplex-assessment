<?php

namespace App\Models;

use App\Enums\Task\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Task
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property \Illuminate\Support\Carbon $due_date
 * @property \App\Enums\Task\StatusEnum $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo user()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany comments()
 */
class Task extends Model
{
    protected $casts = [
        'status' => StatusEnum::class,
    ];

    protected static function booted()
    {
        static::creating(function ($task) {
            if (! $task->user_id) {
                $task->user_id = Auth::id();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
