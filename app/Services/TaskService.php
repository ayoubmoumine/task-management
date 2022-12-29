<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskService 
{
    protected $taskRepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Prepare data to create a task record.
     *
     * @param array $data
     * @return App\Model\Task $task
     */
    public function create(array $data): Task
    {
        $data[Task::PRIORITY_COLUMN] = $this->taskRepository->getMaxPriority( $data[ Task::PROJECT_ID_COLUMN ] ) + 1;
        return $this->taskRepository->create( $data );
    }

    /**
     * Prepare data to update a task record.
     *
     * @param array $data
     * @param App\Model\Task $task
     * @return void
     */
    public function update(array $data, Task $task)
    {
        $this->taskRepository->update($task, $data );
    }

    /**
     * Logic to reorder tasks priority depending on the drag.
     *
     * @param int $taskID
     * @param int $nextTaskID
     * @param int $projectID
     * @param boolean $isLast
     * @return void
     */
    public function switchPriority($taskID, $nextTaskID, $projectID, $isLast): void
    {
        $dragged = $this->taskRepository->getTaskById($taskID);

        if( $isLast == 'true' )
        {
            $priorityFrom = $dragged->getPriority() + 1;
            $priorityTo = $this->taskRepository->getMaxPriority($projectID);
            $targetPriority = $priorityTo;
            $this->decrementPriority($projectID, $priorityFrom, $priorityTo);
        }else{
            $nextTask = $this->taskRepository->getTaskById($nextTaskID);

            if ( $dragged->getPriority() < $nextTask->getPriority() )
            {
                $priorityFrom = $dragged->getPriority() + 1;
                $priorityTo = $nextTask->getPriority() -1;
                $targetPriority = $priorityTo;
                $this->decrementPriority($projectID, $priorityFrom, $priorityTo);
            }
            
            if( $dragged->getPriority() > $nextTask->getPriority() )
            {
                $priorityFrom = $nextTask->getPriority();
                $priorityTo = $dragged->getPriority() - 1;
                $targetPriority = $nextTask->getPriority();
                
                $this->incrementPriority($projectID, $priorityFrom, $priorityTo);
            }
        }
        $this->taskRepository->update( $dragged, [ Task::PRIORITY_COLUMN => $targetPriority] );
    }

    /**
     * Call the repository to decrement priority for a range of task ids of a specific project.
     *
     * @param int $projectID
     * @param int $priorityFrom
     * @param int $priorityTo
     * @return void
     */
    public function decrementPriority($projectID, $priorityFrom, $priorityTo)
    {
        $this->taskRepository->decrementPriority($projectID, $priorityFrom, $priorityTo);
    }
    

    /**
     * Call the repository to increment priority for a range of task ids of a specific project.
     *
     * @param int $projectID
     * @param int $priorityFrom
     * @param int $priorityTo
     * @return void
     */
    public function incrementPriority($projectID, $priorityFrom, $priorityTo)
    {
        $this->taskRepository->incrementPriority($projectID, $priorityFrom, $priorityTo);
    }

    /**
     * Call the repository to decrement priority for a range of task ids of a specific project after a deletion.
     *
     * @param int $projectID
     * @param int $priorityFrom
     * @param int $priorityTo
     * @return void
     */
    public function reorderAfterDelete($taskID, $projectID)
    {
        $maxPriority = $this->taskRepository->getMaxPriority($projectID);
        if( $maxPriority == 0)
            return null;
        $this->decrementPriority($projectID, $taskID, $maxPriority);
    }

}