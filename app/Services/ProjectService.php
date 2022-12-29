<?php

namespace App\Services;

use App\Models\Project;
use App\Repositories\ProjectRepository;

class ProjectService 
{
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function getAllWithTasks()
    {
        return $this->projectRepository->getAllWithTasks();
    }
}