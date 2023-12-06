<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CriteriaType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'criteria_types';
    protected $guarded = [];

    protected $casts = [];
}
