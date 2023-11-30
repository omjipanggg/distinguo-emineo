<?php

namespace App\Models;

use App\Traits\HasUuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tokeniser extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'tokenisers';
    protected $guarded = [];

    protected $casts = [];
}
