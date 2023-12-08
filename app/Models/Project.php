<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'projects';
    protected $guarded = [];

    protected $casts = [];

    public function tokenisers() {
        return $this->belongsToMany(Project::class, 'pivot_projects_tokenisers')->orderBy('projects.project_number');
    }
}
