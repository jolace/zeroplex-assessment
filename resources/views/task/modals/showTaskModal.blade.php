<!-- Task Details Modal -->
<div class="modal fade" id="taskDetailsModal" tabindex="-1" aria-labelledby="taskDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskDetailsModalLabel">Task Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="task-details">
                    <h4 id="task-title"></h4>
                    <p><strong>Description:</strong> <span id="task-description"></span></p>
                    <p>
                        <span class=""><strong>Due Date:</strong>&nbsp;<span id="task-due-date"></span></span>
                        <span class="margin-left-20"><strong>Status:</strong>&nbsp;<span id="task-status"></span></span>
                    </p>
                </div>
                <hr>
                <h5>Task Comments</h5>
                <hr>
                <ul id="task-comments-list" class="list-group mb-3 scrollable-list"></ul>
                <div class="mb-3">
                    <label for="comment-text" class="form-label">Add a Comment</label>
                    <textarea class="form-control" id="comment-text" rows="3" required></textarea>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="add-comment">Add Comment</button>
                </div>
            </div>
        </div>
    </div>
</div>
