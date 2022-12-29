
$(document).ready(function(){
    $(".edit-task").click(function(){
        console.log($(this)[0].dataset.task)
        taskID = $(this)[0].dataset.task
        var $editBtn = $(this);
        $.ajax({
        url: taskID+"/edit",
        type: "get",
        success: function (response) {
            $editBtn.closest("li").html(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
    })
})
