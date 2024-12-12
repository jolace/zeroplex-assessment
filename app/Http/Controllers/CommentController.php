<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Task;
use App\Notifications\TaskCommentAdded;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct(private TaskService $taskService) {}

    /**
     * @param \App\Models\Task $task
     * @param \App\Http\Requests\CommentRequest $request
     *
     * @return \App\Http\Resources\CommentResource
     */
    public function store(Task $task, CommentRequest $request): CommentResource
    {
        $comment = $this->taskService->insertComment($task, $request->all());
        $comment->load('user');
        if (Auth::user()->id != $task->user->id) {
            $task->user->notify(new TaskCommentAdded($comment));
        }

        return CommentResource::make($comment);
    }
}
