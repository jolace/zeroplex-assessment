<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function __construct(private TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function index(Request $request)
    {
        return $this->taskService->dataTableOutput($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\TaskStoreRequest $request
     *
     * @return \App\Http\Resources\TaskResource
     */
    public function store(TaskStoreRequest $request): TaskResource
    {
        $task = $this->taskService->insert($request->all());

        return TaskResource::make($task);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Task $task
     *
     * @return \App\Http\Resources\TaskResource
     */
    public function show(Task $task): TaskResource
    {
        return TaskResource::make($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskUpdateRequest $request
     * @param \App\Models\Task $task
     *
     * @return \App\Http\Resources\TaskResource
     */
    public function update(TaskUpdateRequest $request, Task $task): TaskResource
    {
        $task = $this->taskService->update($task, $request->all());

        return TaskResource::make($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Task $task
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task): Response
    {

        if ($this->taskService->delete($task)) {
            return response(null, 204);
        }

        return response(null, 400);
    }
}
