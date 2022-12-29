<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    
    const PROJECT_NAME_COLUMN = "name";
    const TABLE_NAME = "projects";
    const PRIMARY_KEY = "id";

    public function getName()
    {
        return $this->getAttribute( self::PROJECT_NAME_COLUMN );
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
