<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'departments';
    protected $guarded = [];

    protected $casts = [];

    public function evaluatees() {
    	return $this->belongsToMany(Department::class, 'pivot_departments_evaluatees')
        ->orderBy('evaluatees.name')
        ->withTimestamps();
    }

    public function tokenisers() {
    	return $this->belongsToMany(Department::class, 'pivot_departments_tokenisers')
            ->orderBy('departments.name')
            ->withPivot(['assessment_id'])
        ->withTimestamps();
    }
}
