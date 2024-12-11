<?php

namespace App\Enums\Task;

enum StatusEnum: String
{
    case TO_DO = 'to_do';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::TO_DO => 'To do',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETED => 'Completed',
        };
    }
}
