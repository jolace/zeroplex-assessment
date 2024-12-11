<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Task;
use App\Services\TaskService;

class CommentController extends Controller
{
    public function __construct(private TaskService $taskService)
    {
        
    }
    
    /**
     * @param \App\Models\Task $task 
     * @param \App\Http\Requests\CommentRequest $request
     *  
     * @return CommentResource 
     */
    public function store(Task $task, CommentRequest $request): CommentResource
    {
        $comment = $this->taskService->insertComment($task, $request->all());
        $comment->load('user');

        return CommentResource::make($comment);
    }
}
