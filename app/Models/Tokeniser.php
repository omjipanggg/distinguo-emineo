<?php

namespace App\Models;

// use App\Traits\HasUuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tokeniser extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tokenisers';
    protected $guarded = [];

    protected $casts = [
        'is_used' => 'boolean',
        'project_number' => 'string'
    ];

    public function assessments() {
        return $this->belongsToMany(Assessment::class, 'pivot_projects_tokenisers')->orderBy('projects.project_nunmber');
    }

    public function departments() {
        return $this->belongsToMany(Department::class, 'pivot_departments_tokenisers')->orderBy('departments.name')->withPivot(['assessment_id']);
    }

    public function evaluatees() {
        return $this->belongsToMany(Evaluatee::class, 'pivot_evaluatees_tokenisers')->orderBy('evaluatees.name');
    }

    public function evaluator() {
    	return $this->hasOne(Evaluator::class, 'token', 'token');
    }

    public function projects() {
        return $this->belongsToMany(Project::class, 'pivot_projects_tokenisers')->orderBy('projects.project_number')->withPivot(['assessment_id']);
    }

    public function project() {
        return $this->belongsTo(Project::class, 'project_number', 'project_number');
    }
}
