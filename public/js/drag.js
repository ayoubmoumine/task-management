$(document).ready(function(){
    function enableDragSort(listClass) {
        const sortableLists = document.getElementsByClassName(listClass);
        Array.prototype.map.call(sortableLists, (list) => {enableDragList(list)});
    }

    function enableDragList(list) {
        Array.prototype.map.call(list.children, (item) => {enableDragItem(item)});
    }

    function enableDragItem(item) {
        item.setAttribute('draggable', true)
        item.ondrag = handleDrag;
        item.ondragend = handleDrop;
    }
    function handleDrag(item) {
        const selectedItem = item.target,
            list = selectedItem.parentNode,
            x = event.clientX,
            y = event.clientY;
            
            selectedItem.classList.add('drag-sort-active');
            let swapItem = document.elementFromPoint(x, y) === null ? selectedItem : document.elementFromPoint(x, y);
        
        if (list === swapItem.parentNode) {
        swapItem = swapItem !== selectedItem.nextSibling ? swapItem : swapItem.nextSibling;
        list.insertBefore(selectedItem, swapItem);
        }
    }

    function handleDrop(item) {
        isLast = 'false';
        nextTask = null;
        
        item.target.classList.remove('drag-sort-active');
        targetTask = item.target.id;
        projectID = item.target.dataset.project;

        if(item.target.nextSibling.nextSibling == null)
        {
            isLast = 'true';
        }else{
            id = "id" in item.target.nextSibling.nextSibling ? item.target.nextSibling.nextSibling.id : item.target.nextSibling.id;
            nextTask = id;
        }

        switchPriority(targetTask, nextTask, isLast);
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function switchPriority(targetTask, nextTask, isLast)
    {
        $.ajax({
            url: "/switch-priority",
            type: "post",
            data: {
                "targetTask" : targetTask,
                "nextTask" : nextTask,
                "projectID" : projectID,
                "isLast" : isLast
            } ,
            success: function (response) {
                console.log(response);
                location.reload()
            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }
        });
    }


    (()=> {enableDragSort('drag-sort-enable')})();
})
