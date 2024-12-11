<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \App\Models\Task $task */
        $task = $this->resource;

        return [
            'id' => $task->id,
            'title' => $task->title,
            'description' => $task->description,
            'due_date' => $task->due_date,
            'status' => $task->status,
        ];
    }
}
