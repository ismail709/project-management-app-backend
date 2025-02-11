<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'parent_task_id',
        'sprint_id',
        'project_id',
        'task_title',
        'task_description',
        'task_type_id',
        'task_status',
        'task_priority',
        'estimated_days',
        'actual_days',
    ];

    public function sprint(){
        return $this->belongsTo(Sprint::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }
    public function parentTask(){
        return $this->belongsTo(Task::class,'parent_task_id');
    }
    public function taskType(){
        return $this->belongsTo(TaskType::class);
    }
    public function subTasks(){
        return $this->hasMany(Task::class,'parent_task_id');
    }
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }
}
