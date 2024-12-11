export var taskTable;

export const statusMap = {
    'Completed': 'completed',
    'In Progress': 'in-progress',
    'To do': 'to-do'
};

export function initializeTable() {
    
    taskTable = new JSTable("#basic",
    {
        sortable: false,
        perPage : 5,
        searchable :true,
        layout: {
            top: "{select}{info}",
            bottom: "{pager}"
        },
        serverSide : true,
        ajax : "/task",
        ajaxParams: {
            due_date: document.getElementById('due_date').value,
            status: document.getElementById('status').value
        },
        columns: [
            {   
                select: [0,1],
                render: function (cell, idx) {
                    let data = cell.innerHTML;
                    if(data.length > 20)
                    {
                        return data.split(' ').slice(0, 8).join(' ') + '...';
                    }
                    return data;
                }
            },
            {   
                select: 2,
                render: function (cell, idx) {
                    let data = cell.innerHTML;
                    const date = new Date(data);
                    return date.toLocaleDateString('en-US');
                }
            },
            {   
                select: 3,
                render: function (cell, idx) {
                    let data = cell.innerHTML;
                    let spanClass = statusMap[data];
                
                    return '<span class="badge badge-'+spanClass+'">'+data+'</span>';
                }
            },
            {   
                select: 4,
                render: function (cell, idx) {                
                    let data = cell.innerHTML;

                    let showIcon = '<a title="Show">\
                    <i data-show-id="'+data+'" class="show-task fa-brands fa-readme fa-lg text-dark"></i></a>&nbsp';

                    let editIcon = '<a title="Edit">\
                    <i data-edit-id="'+data+'" class="edit-task far fa-edit fa-lg text-dark"></i></a>&nbsp';

                    let removeIcon = '<a title="Remove">\
                    <i data-remove-id="'+data+'" class="remove-task fas fa-trash-alt fa-lg text-warning"></i></a>';

                    return showIcon+editIcon+removeIcon;
                }
            }
        ],
    });
}
      