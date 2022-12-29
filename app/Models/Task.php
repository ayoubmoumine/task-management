<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = array( "name", "priority", "project_id" );
    
    const NAME_COLUMN = "name";
    const PRIORITY_COLUMN = "priority";
    const PROJECT_ID_COLUMN = "project_id";

    public function getName()
    {
        return $this->getAttribute( self::NAME_COLUMN );
    }

    public function getPriority()
    {
        return $this->getAttribute(self::PRIORITY_COLUMN);
    }
    
    public function getProjectID()
    {
        return $this->getAttribute( self::PROJECT_ID_COLUMN );
    }

    public function getCreatedAt()
    {
        return $this->getAttribute( self::CREATED_AT );
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
