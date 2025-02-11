<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'role_name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class,'team_members')->withPivot('team_id');
    }
    public function teams()
    {
        return $this->belongsToMany(Team::class,'team_members')->withPivot('user_id');
    }
}
