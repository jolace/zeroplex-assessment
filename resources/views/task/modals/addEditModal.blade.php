<!-- Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="taskForm" data-form-type="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="taskTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" 
                               id="taskTitle" name="title" value="" requiredsdf>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="taskDescription" class="form-label">Description</label>
                        <textarea class="form-control" 
                                  id="taskDescription" name="description" rows="3" requiredsdf></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="taskDueDate" class="form-label">Due Date</label>
                        <input type="date" class="form-control" 
                               id="taskDueDate" name="due_date" value="" requiredsdf>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div id="taskStatusDiv" class="mb-3">
                        <label for="taskStatus" class="form-label">Status</label>
                        <select class="form-select" 
                                id="taskStatus" name="status" requiredsdf>
                            <option value="">Select Status</option>
                            @foreach($statusFilter  as $status)
                                <option value="{{$status->value}}">{{$status->label()}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
