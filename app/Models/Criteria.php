<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Criteria extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'criterias';
    protected $guarded = [];

    protected $casts = [];

    public function assessments() {
    	return $this->belongsToMany(Assessment::class, 'pivot_assessments_criterias');
    }

    public function type() {
    	return $this->belongsTo(CriteriaType::class, 'criteria_type_id');
    }
}
