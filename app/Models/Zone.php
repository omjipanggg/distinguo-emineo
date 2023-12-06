<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'zones';
    protected $guarded = [];

    protected $casts = [];

    public function region() {
    	return $this->belongsTo(Region::class);
    }
}
