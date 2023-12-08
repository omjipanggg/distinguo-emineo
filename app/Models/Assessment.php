<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'assessments';
    protected $guarded = [];

    protected $casts = [];

    public function criterias() {
    	return $this->belongsToMany(Criteria::class, 'pivot_assessments_criterias')->orderBy('criterias.criteria_type_id')->orderBy('criterias.name');
    }

    public function tokenisers() {
    	return $this->belongsToMany(Tokeniser::class, 'pivot_projects_tokenisers');
    }
}
