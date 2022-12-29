<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use PhpParser\ErrorHandler\Collecting;

class ProjectRepository 
{

    
    /**
     * Retreive all the projects with the tasks nested.
     * 
     * @return Collection
     */
    public function getAllWithTasks(): Collection
    {
        return Project::with( [ "tasks" => function ($q) {
            $q->orderBy(Task::PRIORITY_COLUMN, 'asc');
        }] )->orderBy(Project::PRIMARY_KEY, 'asc')->get();
    }
}