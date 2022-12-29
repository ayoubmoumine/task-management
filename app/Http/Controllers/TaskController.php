<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Services\ProjectService;
use App\Services\TaskService;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class TaskController extends Controller
{
    protected $taskService, $projectService;

    public function __construct(TaskService $taskService, ProjectService $projectService)
    {
        $this->taskService = $taskService;
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = $this->projectService->getAllWithTasks();
        return $projects->isEmpty() ? 
                view("no_project") : 
                view('index', [ "projects" => $projects ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Task\TaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $data = $request->validated();
        $this->taskService->create( $data );
        return redirect("/")->with("message", "Task was added successfuly !");
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(task $task)
    {
        // return ;
        return view('components.tasks.edit')->with("task", $task)->render();
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Task\TaskRequest $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        $data = $request->validated();

        $this->taskService->update( $data, $task );
        return redirect("/");
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $taskPriority = $task->getPriority();
        $projectID = $task->getProjectID();
        $task->delete();
        $this->taskService->reorderAfterDelete($taskPriority, $projectID);
        return redirect('/');
    }

    
    /**
     * Update the priority after a reorder.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function switchPriority(Request $request)
    {
        $targetTask = $request->targetTask;
        $nextTask =  $request->nextTask;
        $projectID =  $request->projectID;
        $isLast = $request->isLast;
        $this->taskService->switchPriority($targetTask, $nextTask, $projectID, $isLast);
        return redirect('/');
    }
}
