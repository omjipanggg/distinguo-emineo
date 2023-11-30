<?php

namespace App\Models;

use App\Traits\HasUuids;

use Carbon\Carbon;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, HasUuids, Notifiable, SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'snake_name',
        'email',
        'password',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'id' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'hashed'
    ];

    public function roles() {
        return $this->belongsToMany(Role::class, 'pivot_roles_users')->orderBy('roles.name')->withPivot(['expired_at'])->withTimestamps();
    }

    public function hasRole($id) {
        if (!is_array($id)) { $id = [$id]; }
        return $this->roles()->whereIn('role_id', $id)->exists();
    }

    /*
    public function attendance() {
        return $this->hasMany(Attendance::class, 'user_id');
    }

    public function today_attendance() {
        return $this->hasOne(Attendance::class, 'user_id')
            ->whereDate(
                'attendance_date',
                Carbon::now()->format('Y-m-d')
            )->orderByDesc('created_at');
    }
    */
}