<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository 
{

    /**
     * Create a task record.
     * 
     * @param  array $data
     * @return App\Model\Task $task
     */
    public function create(array $data): Task
    {
        return Task::create( $data );
    }
    
    /**
     * Update the given resource.
     * 
     * @param  App\Model\Task $task
     * @param  array $data
     * @return void
     */
    public function update(Task $task, array $data)
    {
       Task::whereId( $task->getKey() )->update( $data );
    }

    public function getPriority(int $projectId): int
    {
        return Task::where(Task::PROJECT_ID_COLUMN, $projectId)->latest(Task::PRIORITY_COLUMN)->first()->getPriority();
    }

    /**
     * Fetch task record by it's ID.
     * 
     * @param  $id
     * @return App\Model\Task $task
     */
    public function getTaskById($id)
    {
        return Task::findOrFail( $id );
    }

    /**
     * Increments the priority value for a range of tasks of a given project.
     * 
     * @param  $projectID
     * @param  $priorityFrom
     * @param  $priorityTo
     * @return void
     */
    public function incrementPriority(int $projectID, int $priorityFrom, int $priorityTo): void
    {
        Task::where( Task::PROJECT_ID_COLUMN, $projectID )->whereBetween( Task::PRIORITY_COLUMN, [ $priorityFrom, $priorityTo ] )->increment( Task::PRIORITY_COLUMN );
    }
    
    /**
     * Decrements the priority value for a range of tasks of a given project.
     * 
     * @param  $projectID
     * @param  $priorityFrom
     * @param  $priorityTo
     * @return void
     */
    public function decrementPriority(int $projectID,int $priorityFrom, int $priorityTo): void
    {
        Task::where( Task::PROJECT_ID_COLUMN, $projectID )->whereBetween( Task::PRIORITY_COLUMN, [ $priorityFrom, $priorityTo ] )->decrement( Task::PRIORITY_COLUMN );
    }

    
    /**
     * Returns the max priority for a given Object.
     * 
     * @param  $projectID
     * @return $priority
     */
    public function getMaxPriority(int $projectID)
    {
        return Task::where( Task::PROJECT_ID_COLUMN, $projectID )->max( Task::PRIORITY_COLUMN );
    }
}