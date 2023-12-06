<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'evaluations';
    protected $guarded = [];

    protected $casts = [];

    public function evaluator() {
    	return $this->belongsTo(Evaluator::class);
    }

    public function evaluatee() {
    	return $this->belongsTo(Evaluatee::class);
    }

    public function criteria() {
        return $this->belongsTo(Criteria::class);
    }
}
