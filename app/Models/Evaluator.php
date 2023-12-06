<?php

namespace App\Models;

use App\Traits\HasUuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluator extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'evaluators';
    protected $guarded = [];

    protected $casts = [
    	'id' => 'string'
    ];

    public function evaluations() {
        return $this->hasMany(Evaluation::class);
    }

    public function tokeniser() {
    	return $this->belongsTo(Tokeniser::class, 'token', 'token');
    }
}
