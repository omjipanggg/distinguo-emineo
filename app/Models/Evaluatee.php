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

    protected $casts = [];
}