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
}
