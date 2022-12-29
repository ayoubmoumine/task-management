@foreach ($projects as $project)
    <div class="flex flex-col w-80 bg-transparent rounded-md">
        <h3 class="px-3 pt-3 pb-1 min-h-15 text-md font-medium text-gray-700 leading-tight font-mono">
            {{ $project->getName() }}
        </h3>

        <div class="flex-1 min-h-0 ">
            <ul class="pt-1 pb-3 px-3 drag-sort-enable">
                <x-task :project="$project" />
            </ul>
            <div class="mb-4">
                <div class="m-2 mt-0 p-2 bg-white rounded-xl">
                    <form class="flex space-x-1" action="" method="POST">
                        @csrf
                        <input type="text" name="name" placeholder="Task name" id="" class="py-3 px-4 mx-0 w-5/8 bg-gray-100 rounded-xl"> 
                        <input type="hidden" name="project_id" value="{{ $project->getKey() }}" placeholder="Project" id="" class="py-3 px-4  w-2/6 bg-gray-100 rounded-xl">
                        <button class="p-4  w-3/8 bg-green-500 text-white rounded-xl">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach