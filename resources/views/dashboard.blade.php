@extends('layouts.app')
@section('content')
    <div class="row g-5">
            <div class="col-md-4">
                <label for="status" class="form-label me-2">Status</label>
                <select id="status" class="form-select form-select-sm d-inline-block w-auto">
                    <option value=""></option>
                    @foreach($statusFilter  as $status)
                        <option value="{{$status->name}}">{{$status->label()}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="due_date" class="form-label me-2">Due Date</label>
                <input type="date" id="due_date" class="form-control form-control-sm d-inline-block w-auto" placeholder="Select Due Date">
            </div>

            <div class="col-md-4 right-align">
                <button id="add_new_task_btn" class="btn btn-dark">{{ __('Add Task') }}</button>
            </div>

        <div class="col-md-12">
            <table id="basic">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    @include('task.modals.addEditModal')
    @include('task.modals.deleteTaskModal')
    @include('task.modals.showTaskModal')
@endsection
