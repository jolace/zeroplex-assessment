import { taskTable, initializeTable, statusMap } from './taskTable.js';

document.addEventListener("DOMContentLoaded", function()
{
    initializeTable();
    const notyf = new Notyf({position:{x:'right',y:'top'}});
    const taskForm = document.getElementById('taskForm');
    const modal = new bootstrap.Modal(document.getElementById('taskModal'));
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteTaskModal'));
    const showModal = new bootstrap.Modal(document.getElementById('taskDetailsModal'));
    
    // Open new task modal when click on add new task btn
    document.getElementById('add_new_task_btn').addEventListener('click',function(){
        taskForm.setAttribute('data-form-type', 'create');
        document.getElementById('taskModalLabel').textContent = 'Create Task';
        document.getElementById("taskStatusDiv").style.display = "none";
        modal.show();
    });

    // Remove, Edit or Show task modal 
    document.body.addEventListener( 'click', function ( event ) {
        let classes = event.target.className.split(' ');
        if( classes.includes('edit-task') ) {
            getDataAndShowEditModal(event.target.getAttribute('data-edit-id'));
        };

        if( classes.includes('remove-task') ) {
            document.getElementById('confirmDeleteBtn').setAttribute('data-task-id',event.target.getAttribute('data-remove-id'));
            deleteModal.show();
        };

        if( classes.includes('show-task') ) {
            getDataAndShowTaskDetailsModal(event.target.getAttribute('data-show-id'));
        };

    });

    // Create or Edit task 
    taskForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            clearValidationErrors();
            const isEdit = taskForm.dataset.formType;
            
            const formData = new FormData(taskForm);
            const data = Object.fromEntries(formData.entries());
            const url = isEdit == 'edit' ? `/task/${taskForm.dataset.taskId}` : '/task';
            const method = isEdit== 'edit' ? 'PUT' : 'POST';
            
            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Accept' : 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                if (response.ok) {                   
                    taskForm.reset();
                    clearValidationErrors();
                    modal.hide();
                    taskTable.paginate(1);
                    notyf.success('Task saved successfully!');                   
                } else {
                    handleValidationErrors(result.errors);
                }
            } catch (error) {
                console.error('Error submitting form:', error);
                notyf.error('An unexpected error occurred.');
            }
    });

    // Validation errors
    function handleValidationErrors(errors) {
        for (const [field, messages] of Object.entries(errors)) {
            const input = document.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.add('is-invalid');
                const feedback = input.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.textContent = messages[0];
                }
            }
        }
    }
    
    // Clear validation errors
    function clearValidationErrors() {
        const inputs = taskForm.querySelectorAll('.is-invalid');
        inputs.forEach(input => {
            input.classList.remove('is-invalid');
            const feedback = input.nextElementSibling;
            if (feedback && feedback.classList.contains('invalid-feedback')) {
                feedback.textContent = '';
            }
        });
    }
    
    // show modal for edit task
    function getDataAndShowEditModal(id)
    {
        fetch('/task/'+id)
            .then((response) => response.json())
            .then((response) => {
                taskForm.setAttribute('data-form-type', 'edit');
                taskForm.setAttribute('data-task-id', id);
                document.getElementById("taskStatusDiv").style.display = "block";
                let data = response.data;
                document.getElementById('taskModalLabel').textContent = 'Edit Task';
                document.getElementById('taskTitle').value = data.title;
                document.getElementById('taskDescription').value = data.description;
                document.getElementById('taskDueDate').value = data.due_date;
                document.getElementById('taskStatus').value = data.status;
                modal.show();
            })
    }

    // Delete task
    document.getElementById('confirmDeleteBtn').addEventListener('click',function(event){
        let taskId = event.target.dataset.taskId;
        fetch('task/'+taskId, {
            method: 'DELETE',
            headers: {
                'Accept' : 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
        }).then(response => {
            if(response.ok)
            {
                notyf.success('Deleted successfully');
                taskTable.paginate(1);
                deleteModal.hide();
            } else {
                notyf.error('An unexpected error occurred.');
            }
        });
    })

    // show modal for task details
    function getDataAndShowTaskDetailsModal(id)
    {
        fetch('/task/'+id)
            .then((response) => response.json())
            .then((response) => {
                let data = response.data;
                let taskStatus =  document.getElementById("task-status");
                taskStatus.classList = '';
                document.getElementById("taskDetailsModalLabel").textContent = data.title;
                document.getElementById("task-description").textContent = data.description;
                document.getElementById("task-due-date").textContent =  new Date(data.due_date).toLocaleDateString('en-US');
                const statusDisplay = {
                    'to_do' : 'To do',
                    'in_progress' : 'In Progress',
                    'completed' : 'Completed'
                }
                let taskDisplayStatus = statusDisplay[data.status];
                taskStatus.textContent = taskDisplayStatus;
                taskStatus.classList.add('badge');
                taskStatus.classList.add('badge-'+statusMap[taskDisplayStatus]);
                if(data.comments.length < 1)
                {
                    document.getElementById('task-comments-list').textContent = "No comments yet.";
                }
                Object.entries(data.comments).reverse().forEach((entry) => {
                    const [key, value] = entry;
                    let newComment = createComment(value);
                    document.getElementById('task-comments-list').appendChild(newComment);
                });
                document.getElementById('add-comment').setAttribute('data-task-id',id);
                showModal.show();
            })
    }
    
    // reset form when modal is closed
    document.getElementById('taskModal').addEventListener('hidden.bs.modal', function () {
        taskForm.reset(); 
        clearValidationErrors();
    });

    // add due date value in ajax param
    document.getElementById('due_date').addEventListener('change',function(){
        taskTable.config.ajaxParams.due_date = document.getElementById('due_date').value;
        taskTable.paginate(1);
    })
    
    // add status date value in ajax param
    document.getElementById('status').addEventListener('click',function(){
        taskTable.config.ajaxParams.status = document.getElementById('status').value;
        taskTable.paginate(1);
    })

    // add comment
    document.getElementById('add-comment').addEventListener('click', function(event){
        let taskId = event.target.dataset.taskId;
        clearCommentValidation();
        fetch('/task/'+taskId+'/comment', {
                method: 'POST',
                headers: {
                    'Accept' : 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({'comment' : document.getElementById('comment-text').value})
            })
            .then((response) => response.json())
            .then((response) => {
                if (response.data) {
                    let newComment = createComment(response.data);
                    document.getElementById('task-comments-list').prepend(newComment);
                    notyf.success('Your comment has been added successfully!');
                } else {
                    let commentText = document.getElementById('comment-text');
                    if (commentText && !commentText.classList.contains('is-invalid')) {
                        commentText.classList.add('is-invalid');
                        commentText.nextElementSibling.textContent = response.errors.comment[0];
                    }
                }
            })
    });
    // reset validation when show modal is closed
    document.getElementById('taskDetailsModal').addEventListener('hidden.bs.modal', function () {
        clearCommentValidation();
        clearComments();
    });

    function clearComments()
    {
        document.getElementById('task-comments-list').textContent = '';
    }

    function clearCommentValidation()
    {
        let commentText = document.getElementById('comment-text');
        if (commentText && commentText.classList.contains('is-invalid')) {
            commentText.classList.remove('is-invalid');
            commentText.nextElementSibling.textContent = '';
        }
    }

    function createComment(value)
    {
        const commentItem = document.createElement('li');
        commentItem.className = 'list-group-item';

        const strong = document.createElement('strong');
        strong.textContent = value.user.name;
        commentItem.appendChild(strong);

        const small = document.createElement('small');
        small.className = 'text-muted';
        small.textContent = `(${new Date(value.created_at).toLocaleString()})`;
        commentItem.appendChild(small);

        const paragraph = document.createElement('p');
        paragraph.textContent = value.comment;
        commentItem.appendChild(paragraph);

        return commentItem;
    }
});