<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'npm',
        'no_hp',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'npm' => 'encrypted',
        'no_hp' => 'encrypted',
    ];

    public function kegiatans()
    {
        return $this->belongsToMany(Kegiatan::class, 'panitia_kegiatan')
            ->withPivot(['id', 'jabatan', 'catatan'])
            ->withTimestamps();
    }

    public function isAdmin(): bool
    {
        return $this->role === 'ADMIN';
    }
}
