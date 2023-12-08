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
        'is_used' => 'boolean'
    ];

    public function assessment() {
        return $this->belongsTo(Assessment::class);
    }

    public function departments() {
        return $this->belongsToMany(Department::class, 'pivot_departments_tokenisers')->orderBy('departments.name')->withPivot(['assessment_id']);
    }

    public function evaluator() {
    	return $this->hasOne(Evaluator::class, 'token', 'token');
    }

    public function projects() {
        return $this->belongsToMany(Project::class, 'pivot_projects_tokenisers')->orderBy('projects.project_number')->withPivot(['assessment_id']);
    }
}
