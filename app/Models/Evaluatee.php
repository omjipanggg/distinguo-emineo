<?php

namespace App\Models;

use App\Traits\HasUuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluatee extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'evaluatees';
    protected $guarded = [];

    protected $casts = [
    	'id' => 'string',
        'project_number' => 'string'
    ];

    public function departments() {
    	return $this->belongsToMany(Department::class, 'pivot_departments_evaluatees')->orderBy('departments.name');
    }

    public function evaluations() {
    	return $this->hasMany(Evaluation::class);
    }

    public function project() {
        return $this->belongsTo(Project::class, 'project_number', 'project_number');
    }
}