/*(function($) {
    'use strict';
    $(function() {

        var todoListItem = $('.todo-list');

        todoListItem.on('change', '.checkbox', function() {
            if ($(this).attr('checked')) {
                $(this).removeAttr('checked');
            } else {
                $(this).attr('checked', 'checked');
            }
            
            $(this).closest("li").toggleClass('completed');
        
        });
        
        todoListItem.on('click', '.remove', function() {
            $(this).parent().remove();
        });
        
    });

})(jQuery);*/

function toggleCheckboxDB(task_id) {
    let completed;
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4){
            console.log(this.response);
        }
    };

    var taskCheckbox = document.getElementById('task-checkbox' + task_id);

    if(taskCheckbox.checked) {
        console.log('task-checkbox' + task_id + " is checked");
        document.getElementById(task_id).classList.add("completed");
        completed = 1;
    } else {
        console.log('task-checkbox' + task_id + " is unchecked");
        document.getElementById(task_id).classList.remove("completed");
        completed = 0;
    }
            
    xmlhttp.open("GET", "updateStatus.php?id="+task_id+"&completed="+completed,true);
    xmlhttp.send()
}

function removeTaskDB(task_id) {
    document.getElementById(task_id).remove();

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4){
            console.log(this.response);
        }
    };

    xmlhttp.open("GET", "deleteTask.php?id="+task_id,true);
    xmlhttp.send()
}