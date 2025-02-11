<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskType extends Model
{
    /** @use HasFactory<\Database\Factories\TaskTypeFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "task_type_name",
    ];
}
