<?php

namespace App\Models;

use App\Traits\HasUuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'regions';
    protected $guarded = [];

    protected $casts = [
    	'id' => 'string'
    ];

    public function area() {
    	return $this->belongsTo(Area::class);
    }
}
