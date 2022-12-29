    <div>
        <div class="rounded-xl">
            <form class="flex space-x-1" action="{{ route( 'tasks.update', $task->getKey() ) }}" method="POST">
                @csrf
                @method("PUT")
                <input type="text" name="name" placeholder="Task name" id="" value="{{ $task->getName() }}" class="py-3 px-4 w-3/4 text-gray-500 bg-gray-100 rounded-xl"> 
                <input type="hidden" name="project_id" value="{{ $task->getProjectID() }}">
                <button class="p-4  w-1/4 bg-green-500 text-white rounded-xl">Save</button>
            </form>
        </div>
    </div>
