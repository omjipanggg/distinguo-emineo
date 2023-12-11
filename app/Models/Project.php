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

    protected $casts = [
    	'project_number' => 'string'
    ];

    public function tokenisers() {
        return $this->belongsToMany(Tokeniser::class, 'pivot_projects_tokenisers');
    }
}
